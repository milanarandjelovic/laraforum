<?php

namespace App\Http\Controllers\Forum;

use Auth;
use Validator;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVoteRequest;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->only('comment'), [
            'comment' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Comment::create([
            'description'   => $request->input('comment'),
            'user_id'       => Auth::user()->id,
            'discussion_id' => $request->input('discussion_id'),
        ]);

        return redirect()->back();

    }

    /**
     * Show vote up/down for comment.
     *
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Comment $comment)
    {
        $response['up'] = $comment->upVotes()->count();
        $response['down'] = $comment->downVotes()->count();

        // Check user vote
        if ($request->user()) {
            $voteFromUser = $comment->voteFromUser($request->user())->first();
            $response['user_vote'] = $voteFromUser ? $voteFromUser->type : null;
        }

        return response()->json([
            'data' => $response,
        ], 200);
    }

    /**
     * Create new vote up/down for comment.
     *
     * @param CreateVoteRequest $request
     * @param Comment           $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateVoteRequest $request, Comment $comment)
    {
        $comment->voteFromUser($request->user())->delete();

        $comment->votes()->create([
            'type'    => $request->type,
            'user_id' => $request->user()->id,
        ]);

        return response()->json(null, 200);
    }

    /**
     * Delete vote for comment.
     *
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(Request $request, Comment $comment)
    {
        $comment->voteFromUser($request->user())->delete();

        return response()->json(null, 200);
    }
}

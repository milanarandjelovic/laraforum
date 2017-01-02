<?php

namespace App\Http\Controllers\Forum;

use Auth;
use Validator;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * Show Like / Dislike for comment.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showLikeDislike($id)
    {
        $comment = Comment::where('id', $id)->first();

        return response()->json([
            'comment' => $comment,
        ]);
    }

    /**
     * Add like for comment.
     *
     * @param $id
     */
    public function postLike($id)
    {
        $comment = Comment::where('id', $id)->first();
        $like = $comment->like + 1;

        Comment::where('id', $id)->update([
            'like' => $like,
        ]);
    }

    /**
     * Add dislike for comment.
     *
     * @param $id
     */
    public function postDislike($id)
    {
        $comment = Comment::where('id', $id)->first();
        $dislike = $comment->dislike + 1;

        Comment::where('id', $id)->update([
            'dislike' => $dislike,
        ]);
    }
}

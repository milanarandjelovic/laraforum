<?php

namespace App\Http\Controllers\Forum;

use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LaraForum\Transformers\CommentTransformer;
use App\Http\Requests\CreateDiscussionCommentRequest;

class DiscussionCommentController extends Controller
{

    /**
     * @param Discussion $discussion
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Discussion $discussion)
    {
        return response()->json(
            fractal()->collection($discussion->comments()->get())
                ->parseIncludes(['user', 'replies', 'replies.user'])
                ->transformWith(new CommentTransformer)
                ->toArray()
        );
    }

    /**
     * @param CreateDiscussionCommentRequest $request
     * @param Discussion                     $discussion
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateDiscussionCommentRequest $request, Discussion $discussion)
    {
        $comment = $discussion->comments()->create([
            'description' => $request->input('description'),
            'reply_id'    => $request->get('reply_id', null),
            'user_id'     => $request->user()->id,
        ]);

        return response()->json(
            fractal()->item($comment)
                ->parseIncludes(['user'])
                ->transformWith(new CommentTransformer())
                ->toArray()
        );

    }
}

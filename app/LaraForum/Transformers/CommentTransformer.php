<?php

namespace App\LaraForum\Transformers;

use Carbon\Carbon;
use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'user', 'replies',
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Comment $comment
     * @return array
     */
    public function transform(Comment $comment)
    {
        return [
            'id'          => $comment->id,
            'user_id'     => $comment->user_id,
            'description' => $comment->description,
            'created_at'  => Carbon::createFromTimestamp(strtotime($comment->created_at))->diffForHumans(),
        ];
    }

    /**
     * Include user
     *
     * @param Comment $comment
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Comment $comment)
    {
        return $this->item($comment->user, new UserTransformer);
    }

    /**
     * Include replies
     *
     * @param Comment $comment
     * @return \League\Fractal\Resource\Collection
     */
    public function includeReplies(Comment $comment)
    {
        return $this->collection($comment->replies, new CommentTransformer);
    }
}
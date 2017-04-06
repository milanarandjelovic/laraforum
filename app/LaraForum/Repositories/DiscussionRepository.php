<?php

namespace App\LaraForum\Repositories;

use App\Models\Discussion;
use App\LaraForum\Repositories\Eloquent\Repository;

class DiscussionRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Discussion::class;
    }

    public function getDiscussionWithAll($perPage = 20, $channelId = 'all')
    {
        if ($channelId == 'all') {
            return $this->model
                ->join('channels', 'discussions.channel_id', '=', 'channels.id')
                ->join('users', 'discussions.user_id', '=', 'users.id')
                ->select(
                    'users.username as user_username', 'users.email as user_email',
                    'channels.channel_url as channel_channel_url', 'channels.name as channel_name',
                    'discussions.*'
                )
                ->orderBy('updated_at', 'desc')
                ->paginate($perPage);
        } else {
            return $this->model
                ->where('channel_id', $channelId)
                ->join('channels', 'discussions.channel_id', '=', 'channels.id')
                ->join('users', 'discussions.user_id', '=', 'users.id')
                ->select(
                    'users.username as user_username', 'users.email as user_email',
                    'channels.channel_url as channel_channel_url', 'channels.name as channel_name',
                    'discussions.*'
                )
                ->orderBy('updated_at', 'desc')
                ->paginate($perPage);
        }
    }
}

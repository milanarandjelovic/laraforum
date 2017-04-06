<?php

namespace App\LaraForum\Repositories;

use DB;
use App\Models\Channel;
use App\LaraForum\Repositories\Eloquent\Repository;

class ChannelRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Channel::class;
    }

    /**
     * Return all channels with discussion count.
     *
     * @return mixed
     */
    public function getAllChannelsWithDiscussions()
    {
        return $this->model
            ->orderBy('name', 'asc')
            ->join('discussions', 'channels.id', '=', 'discussions.channel_id')
            ->select(
                'channels.id as id', 'channels.name as name', 'channels.description as description',
                'channels.channel_icon as channel_icon', 'channels.channel_url as channel_url',
                DB::raw("count(discussions.channel_id) as discussion_count")
            )
            ->groupBy('channels.id')
            ->get();
    }
}

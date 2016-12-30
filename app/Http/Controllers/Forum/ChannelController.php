<?php

namespace App\Http\Controllers\Forum;

use App\Models\Channel;
use App\Models\Discussion;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{

    public function getChannelPosts($channelName)
    {
        $channel = Channel::where('channel_url', $channelName)->select('id', 'name')->first();

        if ($channelName === 'all') {
            $discussions = Discussion::orderBy('created_at', 'desc')
                ->with('channel')
                ->with('user')
                ->paginate(20);
        } else {
            $discussions = Discussion::where('channel_id', $channel->id)
                ->orderBy('created_at', 'desc')
                ->with('channel')
                ->with('user')
                ->paginate(20);
        }

        return view('forum.channels.index')
            ->with('channel', $channel)
            ->with('discussions', $discussions);
    }
}

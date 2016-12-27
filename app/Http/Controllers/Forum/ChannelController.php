<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{

    public function getChannelPosts($channelName)
    {
        $channel = DB::table('channels')->select('id', 'name')->where('channel_url', $channelName)->first();

        if ($channelName === 'all') {
            $discussions = DB::table('discussions')
                ->leftJoin('channels', 'channel_id', '=', 'channels.id')
                ->leftJoin('users', 'user_id', '=', 'users.id')
                ->orderBy('discussions.created_at', 'desc')
                ->select('discussions.*', 'channels.*', 'users.*')
                ->paginate(20);

        } else {
            $discussions = DB::table('discussions')
                ->leftJoin('channels', 'channel_id', '=', 'channels.id')
                ->leftJoin('users', 'user_id', '=', 'users.id')
                ->where('channel_id', $channel->id)
                ->orderBy('discussions.created_at', 'desc')
                ->select('discussions.*', 'channels.*', 'users.*')
                ->paginate(20);
        }
//        dd($discussions);
        return view('forum.channels.index')
            ->with('channel', $channel)
            ->with('discussions', $discussions);
    }
}

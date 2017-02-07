<?php

namespace App\Http\Controllers\Forum;

use App\Models\Channel;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscussionRequest;

class DiscussionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $channels = Channel::orderBy('name', 'asc')->with('discussions')->get();
        $allDiscussions = Discussion::all()->count();

        return view('forum.discussion.index')
            ->with('allDiscussions', $allDiscussions)
            ->with('channels', $channels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $channels = Channel::orderBy('name', 'asc')->select('id', 'name')->get();

        return view('forum.discussion.create')
            ->with('channels', $channels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DiscussionRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscussionRequest $request)
    {
        $discussion = Discussion::create([
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'channel_id'  => $request->input('channel_id'),
            'user_id'     => $request->input('user_id'),
        ]);

        $channel = Channel::where('id', $discussion->channel_id)->first();

        activity()->by($request->input('user_id'))
            ->performedOn($channel)
            ->withProperties([
                'type' => 'discussion',
                'title' => $discussion->title,
                'link'  => 'discuss/channels/' . $channel->channel_url . '/' . $discussion->slug,
            ])
            ->log('Create discussion');

        return redirect('discuss/channels/' . $channel->channel_url . '/' . $discussion->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param $channelSlug
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($channelSlug, $slug)
    {
        $discussion = Discussion::where('slug', $slug)
            ->with('channel')
            ->with('user')
            ->with('comments')
            ->first();

        return view('forum.channels.show')
            ->with('discussion', $discussion);
    }
}

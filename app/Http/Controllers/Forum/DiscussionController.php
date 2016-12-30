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
        $channels = Channel::orderBy('name', 'asc')->get();

        return view('forum.discussion.index')
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
        Discussion::create([
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'channel_id'  => $request->input('channel_id'),
            'user_id'     => $request->input('user_id'),
        ]);

        return redirect()->route('discussion.index');
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

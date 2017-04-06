<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscussionRequest;
use App\LaraForum\Repositories\ChannelRepository;
use App\LaraForum\Repositories\DiscussionRepository;

class DiscussionController extends Controller
{

    /**
     * @var ChannelRepository
     */
    private $channelRepository;

    /**
     * @var DiscussionRepository
     */
    private $discussionRepository;

    /**
     * DiscussionController constructor.
     *
     * @param ChannelRepository    $channelRepository
     * @param DiscussionRepository $discussionRepository
     */
    public function __construct(ChannelRepository $channelRepository, DiscussionRepository $discussionRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->discussionRepository = $discussionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $channels = $this->channelRepository->getAllChannelsWithDiscussions();
        $allDiscussions = $this->discussionRepository->all()->count();

        return view('forum.discussion.index')
            ->with('allDiscussions', $allDiscussions)
            ->with('channels', $channels);
    }

    /**
     *  Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $channels = $this->channelRepository->all(['id', 'name']);

        return view('forum.discussion.create')
            ->with('channels', $channels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\DiscussionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(DiscussionRequest $request)
    {
        $discussion = $this->discussionRepository->create($request->all());
        $channel = $this->channelRepository->findBy('id', $discussion->channel_id);

        activity()->by($request->input('user_id'))
            ->performedOn($channel)
            ->withProperties([
                'type'  => 'discussion',
                'title' => $discussion->title,
                'link'  => '/discuss/channels/' . $channel->channel_url . '/' . $discussion->slug,
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
        $discussion = $this->discussionRepository->getDiscussionBySlug($slug);

        return view('forum.channels.show')
            ->with('discussion', $discussion);
    }
}

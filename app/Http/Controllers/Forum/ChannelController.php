<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\LaraForum\Repositories\ChannelRepository;
use App\LaraForum\Repositories\DiscussionRepository;

class ChannelController extends Controller
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
     * ChannelController constructor.
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
     * Return all post for given channel.
     *
     * @param $channelName
     * @return \Illuminate\View\View
     */
    public function getChannelPosts($channelName)
    {
        $channel = $this->channelRepository->findBy('channel_url', $channelName, ['id', 'name']);

        if ($channelName === 'all') {
            $discussions = $this->discussionRepository->getDiscussionWithAll(20, 'all');
        } else {
            $discussions = $this->discussionRepository->getDiscussionWithAll(20, $channel->id);
        }

        return view('forum.channels.index')
            ->with('channel', $channel)
            ->with('discussions', $discussions);
    }
}

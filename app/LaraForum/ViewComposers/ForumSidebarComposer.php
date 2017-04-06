<?php

namespace App\LaraForum\ViewComposers;

use Illuminate\View\View;
use App\LaraForum\Repositories\ChannelRepository;
use App\LaraForum\Repositories\DiscussionRepository;

class ForumSidebarComposer
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
     * ForumSidebarComposer constructor.
     *
     * @param ChannelRepository    $channelRepository
     * @param DiscussionRepository $discussionRepository
     */
    function __construct(ChannelRepository $channelRepository, DiscussionRepository $discussionRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->discussionRepository = $discussionRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $forumChannels = $this->channelRepository->all();
        $allDiscussions = $this->discussionRepository->all()->count();

        $view->with('forumChannels', $forumChannels);
        $view->with('allDiscussions', $allDiscussions);
    }
}

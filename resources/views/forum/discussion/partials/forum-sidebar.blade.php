<div class="forum-sidebar">

    @if(Auth::user())
        <a href="{{ route('discussion.create') }}" class="btn btn-block btn-outline btn-primary button mb-1">
            New Discussion
        </a>
    @else
        <a href="{{ route('auth.register') }}" class="btn btn-block btn-outline btn-primary button mb-1">Create
            Account
        </a>
    @endif

    <div class="sidebar-filter mt-4">
        <p class="sidebar-label">Choose a Filter</p>
        <ul class="menu-list">
            <li>
                <a href="{{ route('discussion.index') }}" class="{{ HelpMenu::activeForumMenu('discuss') }}">
                    <i class="fa fa-globe fa-lg filter-ico" aria-hidden="true"></i>All Threads
                </a>
            </li>
            <li>
                <a href="{{ route('discussion.index') . '?trending=1' }}"
                   class="{{ HelpMenu::activeForumMenu('discuss?trending=1') }}">
                    <i class="fa fa-line-chart fa-lg filter-ico" aria-hidden="true"></i>Popular This Week
                </a>
            </li>
            <li>
                <a href="{{ route('discussion.index') . '?popular=1' }}">
                    <i class="fa fa-line-chart fa-lg filter-ico" aria-hidden="true"></i>Popular All Time
                </a>
            </li>
            <li>
                <a href="{{ route('discussion.index') . '?answered=1' }}">
                    <i class="fa fa-thumbs-o-up fa-lg filter-ico" aria-hidden="true"></i>Answered Questions
                </a>
            </li>
            <li>
                <a href="{{ route('discussion.index') . '?answered=0' }}">
                    <i class="fa fa-lightbulb-o fa-lg filter-ico" aria-hidden="true"></i>Unanswered Question
                </a>
            </li>
            <li>
                <a href="{{ route('discussion.leaderboard') }}">
                    <i class="fa fa-bars fa-lg filter-ico" aria-hidden="true"></i>Leaderboard
                </a>
            </li>
        </ul> {{-- /.menu-list --}}
    </div> {{-- /.sidebar-filter --}}

    <div class="sidebar-channel mt-4">
        <p class="sidebar-label">Or Pick a Channel</p>
        <ul class="menu-list">
            @foreach($forumChannels as $channel)
                <li>
                    @if($channel->channel_url == '')
                        <a href="/discuss/{{ $channel->channel_url }}">
                            <i class="fa fa-circle-o fa-lg" aria-hidden="true" style="color: {{ $channel->color }}"></i>
                            {{ $channel->name }}
                        </a>
                    @else
                        <a href="/discuss/channels/{{ $channel->channel_url }}">
                            <i class="fa fa-circle-o fa-lg" aria-hidden="true" style="color: {{ $channel->color }}"></i>
                            {{ $channel->name }}
                        </a>
                </li>
                @endif
            @endforeach
        </ul> {{-- /.menu-list --}}
    </div> {{-- /.sidebar-channel --}}

</div> {{-- /.forum-sidebar --}}
<div class="ibox float-e-margins forum-sidebar">
    <div class="ibox-title text-center">
        @if(!Auth::user())
            <a href="{{ route('auth.register') }}" class="btn btn-primary">Create Account</a>
        @else
            <a href="{{ route('discussion.create') }}" class="btn btn-primary">New Discussion</a>
        @endif
    </div> {{-- /.ibox-title --}}
</div> {{-- /.ibox --}}

<div class="ibox float-e-margins forum-sidebar">
    <div class="ibox-title">
        <h5>Forum Channels</h5>
    </div> {{-- /.ibox-title --}}
    <div class="ibox-content">
        <ul class="menu-list">
            @foreach($forumChannels as $channel)
                <li>
                    <a href="/discuss/channels/{{ $channel->channel_url }}">
                        {{ $channel->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div> {{-- /.ibox-content --}}
</div> {{-- /.ibox --}}
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
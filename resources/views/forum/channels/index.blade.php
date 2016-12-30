@extends('forum.layouts.app')

@section('title', '| Discussion')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content forum-discuss-container">

                <div class="forum-post-info">
                    <h4>
                        <span class="text-navy">
                            @include('forum.channels.partials.page-heading')
                        </span>
                    </h4>
                </div> {{-- /.forum-post-info --}}

                @if(!($discussions->isEmpty()))

                    @foreach($discussions as $discussion)
                        <div class="forum-item">
                            <div class="row">
                                <div class="col-md-1 col-sm-1 col-xs-1 forum-channel-creator-avatar">
                                    <a href="/{{ '@' . $discussion->user->username }}">
                                        <img src="{{ Gravatar::src($discussion->user->email, 38) }}"
                                             class="img img-circle">
                                    </a>
                                </div> {{-- /.col-md-1 --}}
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <div class="forum-discuss-links">
                                        <a href="{{ '/discuss/channels/' . $discussion->channel->channel_url . '/'. $discussion->slug }}"
                                           class="forum-item-title"
                                        >
                                            {{ $discussion->title }}
                                        </a>
                                        <a href="{{ $discussion->channel->channel_url }}" class="forum-channel-name">
                                            {{ strtoupper($discussion->channel->name) }}
                                        </a>
                                        <a href="{{ $discussion->channel_url }}" class="forum-channel-date">
                                            <span>•</span> {{ strtoupper($discussion->created_at) }}
                                            BY
                                        </a>
                                        <a href="/{{ '@' . $discussion->user->username }}"
                                           class="forum-channel-creator">
                                            {{ strtoupper($discussion->user->username) }}
                                        </a>
                                    </div> {{-- /.forum-discuss-links --}}
                                    <div class="forum-discuss-description">
                                        {{ substr($discussion->description, 0, 160) . '...' }}
                                    </div> {{-- /.forum-discuss-description --}}
                                </div> {{-- /.col-md-10 --}}
                                <div class="col-md-1 col-sm-1 col-xs-1 forum-info pull-right mr-25">
                                    <span class="views-number">
                                        {{ $discussion->comments->count() }}
                                    </span>
                                    <div class="text-center">
                                        <small class="comment-num">
                                            {{ str_plural('Comment', $discussion->comments->count()) }}
                                        </small>
                                    </div>
                                </div> {{-- /.col-md-1 --}}
                            </div> {{-- /.row --}}
                        </div> {{-- /.forum-item --}}
                    @endforeach
                    <div class="pagination-holder">
                        {{ $discussions->links() }}
                    </div>
                @else
                    <div class="alert alert-info mt-15">
                        <strong>No discussion for this channel.</strong>
                    </div>
                @endif

            </div> {{-- /.ibox-content --}}
        </div> {{-- /.row --}}
    </div> {{-- /.row --}}
@endsection
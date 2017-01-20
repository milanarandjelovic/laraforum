@extends('forum.layouts.app')

@section('title', '| Discussion')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="social-feed-box">

                    <div class="social-avatar">
                        <div class="media-body">
                            <h5>
                                <a class="forum-item-title">{{ $discussion->title }}</a>
                            </h5>
                            <div class="forum-discuss-links">
                                <a class="forum-channel-date pull-left mr-5">
                                    PUBLISHED {{ strtoupper($discussion->created_at) }} BY
                                </a>
                                <a href="/{{ '@' . $discussion->user->username }}" class="forum-channel-creator">
                                    {{ strtoupper($discussion->user->username) }}
                                </a>
                            </div>
                        </div> {{-- /.media-body --}}
                    </div> {{-- /.social-avatar --}}

                    <div class="social-body">
                        <p class="forum-discuss-description">{{ $discussion->description }}</p>
                    </div> {{-- /.social-body --}}

                    <div class="social-footer">

                        @if($discussion->comments->count() == 0)
                            <div class="alert alert-info mt-15">
                                <strong>No comment for this discussion.</strong>
                            </div>
                        @endif

                        <discussion-comments discussion-id="{{ $discussion->id }}"></discussion-comments>

                    </div> {{-- /.social-footer --}}

                </div> {{-- /.social-feed-box --}}

                @if(!Auth::user())
                    <p class="text-center">
                        <a href="{{ route('auth.login') }}">Sign in</a> or
                        <a href="{{ route('auth.register') }}">create a forum account to participate in this
                            discussion.</a>
                    </p>
                @endif

            </div> {{-- /.ibox --}}
        </div> {{-- /.col-lg-12 --}}
    </div> {{-- /.row --}}
@endsection
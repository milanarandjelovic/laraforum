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
                                <a class="forum-channel-date pull-left mr-10">
                                    PUBLISHED
                                    {{ strtoupper(\Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans()) }}
                                    BY
                                </a>
                                <a href="/{{ '@' .$discussion->username }}" class="forum-channel-creator">
                                    {{ strtoupper($discussion->username) }}
                                </a>
                            </div>
                        </div> {{-- /.media-body --}}
                    </div> {{-- /.social-avatar --}}

                    <div class="social-body">
                        <p class="forum-discuss-description">{{ $discussion->description }}</p>
                    </div> {{-- /.social-body --}}

                    <div class="social-footer">
                        Comments for this discussion ... <br>
                        @if(Auth::user())
                            <div class="social-comment">
                                <a href="/{{ '@' . Auth::user()->username }}" class="pull-left">
                                    <img alt="image" src="{{ Gravatar::src(Auth::user()->email, 60) }}" class="img-circle">
                                </a>
                                <div class="media-body">
                                    <textarea class="form-control" placeholder="Write comment..."></textarea>
                                </div>
                            </div>
                        @endif
                    </div> {{-- /.social-footer --}}

                </div> {{-- /.social-feed-box --}}

            </div> {{-- /.ibox --}}
        </div> {{-- /.col-lg-12 --}}
    </div> {{-- /.row --}}
@endsection
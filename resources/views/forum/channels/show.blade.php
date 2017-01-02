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

                        @foreach($discussion->comments as $comment)
                            <div class="social-comment">
                                <a href="/{{ '@' . $comment->user->username }}" class="pull-left">
                                    <img src="{{ Gravatar::src($comment->user->email, 60) }}"
                                         alt="{{ $comment->user->username }}"
                                         class="img-reponsive"
                                    >
                                </a>
                                <div class="media-body">
                                    <a href="/{{ '@' . $comment->user->username }}" class="discussion-comment-creator">
                                        {{ $comment->user->username }}
                                    </a>
                                    <span class="discussion-created-at">{{ $comment->created_at }}</span>
                                    <div>{{$comment->description}}</div>
                                    @if(Auth::user())
                                        @if(Auth::id() != $comment->user->id)
                                            <like-dislike
                                                    :id="{{ $comment->id }}"
                                                    :type="'like'"
                                                    :icon="'fa fa-thumbs-up'"
                                                    :url="'/api/forum/postLike/'"
                                                    :get-url="'/api/forum/likeDislike/'"
                                            >
                                            </like-dislike>
                                            <like-dislike
                                                    :id="{{ $comment->id }}"
                                                    :type="'dislike'"
                                                    :icon="'fa fa-thumbs-down'"
                                                    :url="'/api/forum/postDislike/'"
                                                    :get-url="'/api/forum/likeDislike/'"
                                            >
                                            </like-dislike>
                                        @endif
                                    @endif
                                </div> {{-- /.media-body --}}
                            </div> {{-- /.social-comment --}}
                        @endforeach

                        @if(Auth::user())
                            <div class="social-comment">
                                <a href="/{{ '@' . Auth::user()->username }}" class="pull-left">
                                    <img alt="image" src="{{ Gravatar::src(Auth::user()->email, 60) }}"
                                         class="img-responsive"
                                    >
                                </a>
                                {!! Form::open(['route' => 'comments.store', 'method' => 'post']) !!}
                                <div class="media-body">
                                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                        {!! Form::hidden('discussion_id', $discussion->id, ['id' => 'discussion_id']) !!}
                                        {!! Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Write comment...']) !!}
                                        @if($errors->has('comment'))
                                            <span class="text-danger">{{ $errors->first('comment') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary pull-right">Post Your Reply</button>
                                    </div>
                                </div> {{-- /.media-body --}}
                                {!! Form::close() !!}
                            </div> {{-- /.social-comment --}}

                        @endif
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
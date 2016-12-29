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
                                <a href="/{{ '@' . $discussion->user->username }}" class="forum-channel-creator">
                                    {{ strtoupper($discussion->user->username) }}
                                </a>
                            </div>
                        </div> {{-- /.media-body --}}
                    </div> {{-- /.social-avatar --}}

                    <div class="social-body">
                        <p class="forum-discuss-description">{{ $discussion->description }}</p>
                    </div> {{-- /.social-body --}}

                    @if($discussion->comments->count() > 0)
                        <div class="social-footer">
                            @foreach($discussion->comments as $comment)
                                <div class="social-comment">
                                    <a href="/{{ '@' . $comment->user->username }}" class="pull-left">
                                        <img src="{{ Gravatar::src($comment->user->email, 60) }}"
                                             alt="{{ $comment->user->getNameOrUsername() }}"
                                             class="img-reponsive"
                                        >
                                    </a>
                                    <div class="media-body">
                                        <a href="/{{ '@' . $comment->user->username }}">{{ $comment->user->getNameOrUsername() }}</a>
                                        <p>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}</p>
                                        <div>{{$comment->description}}</div>
                                        @if(Auth::user())
                                            <a href="#" class=""><i class="fa fa-thumbs-up"></i> 11</a>
                                            <a href="#" class=""><i class="fa fa-thumbs-down"></i> 15 </a>  
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

                    @endif

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
@extends('forum.layouts.main')

@section('title', '| Discussion')

@section('content')
    <div class="container">

        <div class="ibox-content m-b-sm border-bottom clearfix">
            <div class="p-xs">
                <div class="pull-left m-r-md">
                    <i class="fa fa-globe text-navy mid-icon"></i>
                </div>
                <div class="pull-left">
                    <h2>Welcome in {{ config('app.name', 'LaraForum') }}</h2>
                    <span>Feel free to choose topic you're interested in.</span>
                </div>
                <div class="pull-right mt-15">
                    @if(!Auth::user())
                        <a href="{{ route('auth.register') }}" class="btn btn-primary">Create Account</a>
                    @else
                        <a href="{{ route('discussion.create') }}" class="btn btn-primary new-discussions">
                            New Discussion
                        </a>
                    @endif
                </div>
            </div> {{-- /.p-xs --}}
        </div> {{-- /.ibox-content --}}

        <div class="ibox-content forum-container">
            @if($channels->count() > 0)

                <div class="forum-item">
                    <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <div class="forum-icon">
                                <i class="fa fa-bolt"></i>
                            </div> {{-- /.forum-icon --}}
                            <a href="/discuss/channels/all"
                               class="forum-item-title">All</a>
                            <div class="forum-sub-title">
                                Discussions for all channels.
                            </div> {{-- /.forum-sub-title --}}
                        </div> {{-- /.col-md-10 --}}
                        <div class="col-md-2 col-sm-2 col-xs-2 forum-info">
                            <span class="views-number">
                                {{ $allDiscussions }}
                            </span>
                            <div>
                                <small class="comment-num">
                                    {{ str_plural('Post', $allDiscussions) }}
                                </small>
                            </div>
                        </div> {{-- /.col-md-2 --}}
                    </div> {{-- /.row --}}
                </div> {{-- /.forum-item --}}

                @foreach($channels as $channel)
                    <div class="forum-item">
                        <div class="row">
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="forum-icon">
                                    <i class="{{ $channel->channel_icon }}"></i>
                                </div> {{-- /.forum-icon --}}
                                <a href="/discuss/channels/{{ $channel->channel_url }}"
                                   class="forum-item-title">{{ $channel->name }}</a>
                                @if($channel->description)
                                    <div class="forum-sub-title">
                                        {{ $channel->description }}
                                    </div> {{-- /.forum-sub-title --}}
                                @endif
                            </div> {{-- /.col-md-10 --}}
                            <div class="col-md-2 col-sm-2 col-xs-2 forum-info">
                            <span class="views-number">
                                {{ $channel->discussions->count() }}
                            </span>
                                <div>
                                    <small class="comment-num">
                                        {{ str_plural('Post', $channel->discussions->count()) }}
                                    </small>
                                </div>
                            </div> {{-- /.col-md-2 --}}
                        </div> {{-- /.row --}}
                    </div> {{-- /.forum-item --}}
                @endforeach
            @else
                <div class="alert alert-info">
                    <strong>No channels for this forum.</strong>
                </div>
            @endif
        </div> {{-- /.ibox-content --}}

    </div> {{-- /.row --}}
@endsection
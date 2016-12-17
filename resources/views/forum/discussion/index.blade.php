@extends('forum.layouts.main')

@section('title', '| Discussion')

@section('content')
    <div class="container">

        <div class="ibox-content m-b-sm border-bottom">
            <div class="p-xs">
                <div class="pull-left m-r-md">
                    <i class="fa fa-globe text-navy mid-icon"></i>
                </div>
                <h2>Welcome in {{ config('app.name', 'LaraForum') }}</h2>
                <span>Feel free to choose topic you're interested in.</span>
            </div> {{-- /.p-xs --}}
        </div> {{-- /.ibox-content --}}

        <div class="ibox-content forum-container">
            @foreach($channels as $channel)
                <div class="forum-item">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-bolt"></i>
                            </div> {{-- /.forum-icon --}}
                            <a href="discuss/channels/{{ $channel->channel_url }}" class="forum-item-title">{{ $channel->name }}</a>
                            <div class="forum-sub-title">
                                New to the community? Please stop by, say hi and tell us a bit about yourself.
                            </div> {{-- /.forum-sub-title --}}
                        </div> {{-- /.col-md-9 --}}
                        <div class="col-md-1 forum-info">
                            <span class="views-number">1216</span>
                            <div>
                                <small>Views</small>
                            </div>
                        </div> {{-- /.col-md-1 --}}
                        <div class="col-md-1 forum-info">
                            <span class="views-number">368</span>
                            <div>
                                <small>Topics</small>
                            </div>
                        </div> {{-- /.col-md-1 --}}
                        <div class="col-md-1 forum-info">
                            <span class="views-number">140</span>
                            <div>
                                <small>Posts</small>
                            </div>
                        </div> {{-- /.col-md-1 --}}
                    </div> {{-- /.row --}}
                </div> {{-- /.forum-item --}}
            @endforeach
        </div> {{-- /.ibox-content --}}

    </div> {{-- /.row --}}
@endsection
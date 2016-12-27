@extends('forum.layouts.main')

@section('title', '| Discussion')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content forum-discuss-container">

                <div class="forum-post-info">
                    <h4>
                        <span class="text-navy">
                            {{ $channel->name }}
                        </span>
                    </h4>
                </div> {{-- /.forum-post-info --}}

                @if(!($discussions->isEmpty()))

                    @foreach($discussions as $discussion)
                        <div class="forum-item">
                            <div class="row">
                                <div class="col-md-1 col-sm-1 col-xs-1 forum-info">
                                    <a href="/{{ '@' .$discussion->username }}">
                                        <img src="{{ Gravatar::src($discussion->email, 38) }}" class="img img-circle">
                                    </a>
                                </div> {{-- /.col-md-1 --}}
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <div class="form-discuss-links">
                                        <a href="/discuss/channels/" class="forum-item-title">{{ $discussion->title }}</a>
                                        <a href="{{ $discussion->channel_url }}">{{ strtoupper($discussion->name) }}</a>
                                        <a href="{{ $discussion->channel_url }}">
                                            {{ strtoupper(\Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans()) }}
                                        </a>
                                        BY <a href="">{{ strtoupper($discussion->username) }}</a>
                                    </div> {{-- /.forum-discuss-links --}}
                                    <div class="forum-discuss-description">
                                        {{ substr($discussion->description, 0, 160) . '...'}}
                                    </div> {{-- /.forum-discuss-description --}}
                                </div> {{-- /.col-md-10 --}}
                                <div class="col-md-1 col-sm-1 col-xs-1 forum-info">
                                    <span class="views-number">368</span>
                                    <div>
                                        <small>Comments</small>
                                    </div>
                                </div> {{-- /.col-md-1 --}}
                            </div> {{-- /.row --}}
                        </div> {{-- /.forum-item --}}
                    @endforeach
                    {{ $discussions->links() }}
                @else
                    <div class="alert alert-info mt-15">
                        <strong>No discussion for this channel.</strong>
                    </div>
                @endif

            </div> {{-- /.ibox-content --}}
        </div> {{-- /.row --}}
    </div> {{-- /.row --}}
@endsection
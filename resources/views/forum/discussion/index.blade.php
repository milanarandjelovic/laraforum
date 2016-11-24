@extends('layouts.app')

@section('title', '| Discussion')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('forum.discussion.partials.forum-sidebar')
        </div> {{-- /.col-md-3 --}}
        <div class="col-md-9">
            DISCUSSIONS
        </div> {{-- /.col-md-9 --}}
    </div> {{-- /.row --}}
@endsection
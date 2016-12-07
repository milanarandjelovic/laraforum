@extends('layouts.app-blank')

@section('title', '404')

@section('content')
    <div class="middle-box text-center" style="padding-top: 80px;">
        <h1>404</h1>
        <h3 class="font-bold">Page Not Found</h3>
        <div class="error-desc">
            Sorry, but the page you are looking for has note been found. Try checking the URL for error, then hit the
            refresh button on your browser or try found something else in our app.
        </div> {{-- /.error-desc --}}
    </div> {{-- /.middle-box --}}
@endsection
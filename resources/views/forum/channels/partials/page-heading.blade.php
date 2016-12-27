<?php $num_segment = count(Request::segments()) ?>
<ol class="breadcrumb">
    @foreach(\Request::segments() as $key => $segment)
        @if($key === 0 || $key === 1)
            <li>
                <a href="/discuss/">{{ ucwords($segment) }}</a>
            </li>
        @else
            <li>
                <a href="/discuss/channels/{{ $segment }}">{{ ucwords($segment) }}</a>
            </li>
        @endif
    @endforeach
</ol> {{-- /.breadcrumb --}}
<?php $num_segment = count(Request::segments()) ?>
<ol class="breadcrumb" style="background-color: #F9F9F9">
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
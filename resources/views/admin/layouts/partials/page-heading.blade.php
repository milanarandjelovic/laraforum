<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ ucwords(Request::segment(2)) }}</h2>
        <ol class="breadcrumb">
            @foreach(\Request::segments() as $key => $segment)
                @if($key === 0)
                    <li>
                        <a>{{ ucwords($segment) }}</a>
                    </li>
                @else
                    <li>
                        <a href="{{ $segment }}">{{ ucwords($segment) }}</a>
                    </li>
                @endif
            @endforeach
        </ol> {{-- /.breadcrumb --}}
    </div> {{-- /.col-lg-10 --}}
</div> {{-- /.page-heading --}}
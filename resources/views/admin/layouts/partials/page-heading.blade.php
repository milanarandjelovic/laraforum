<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <?php $num_segment = count(Request::segments()) ?>
        {{--{{ dd(Request::segments()) }}--}}
        <h2>{{ ucwords(Request::segment($num_segment)) }}</h2>
        <ol class="breadcrumb">
            @foreach(\Request::segments() as $key => $segment)
                @if($key === 0)
                    <li>
                        <a>{{ ucwords($segment) }}</a>
                    </li>
                @else
                    <li>
                        <a href="/admin/{{ $segment }}">{{ ucwords($segment) }}</a>
                    </li>
                @endif
            @endforeach
        </ol> {{-- /.breadcrumb --}}
    </div> {{-- /.col-lg-10 --}}
</div> {{-- /.page-heading --}}
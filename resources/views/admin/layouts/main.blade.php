<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LaraForum') }} @yield('title')</title>

        {{-- Styles --}}
        <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

        {{-- Scripts --}}
        <script>
          window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body class="pace-done">

        <div id="app">
            <div id="wrapper">
                @include('admin.layouts.partials.sidebar')

                <div id="page-wrapper" class="gray-bg">

                    @include('admin.layouts.partials.navigation')
                    @include('admin.layouts.partials.page-heading')

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="row">
                                    @yield('content')
                                </div> {{-- /.row --}}
                            </div> {{-- /.wrapper --}}
                            @include('admin.layouts.partials.footer')
                        </div> {{-- /.col-lg-12 --}}
                    </div> {{-- /.row --}}

                </div> {{-- /#page-wrapper --}}
            </div> {{-- /.wrapper --}}
        </div> {{-- /#app --}}

        {{-- Scripts --}}
        <script src="{{ elixir('js/app.js') }}"></script>
    </body>
</html>

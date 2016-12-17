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
    <body class="top-navigation pace-done gray-bg">

    <div id="app">

        <vue-toastr ref="toastr"></vue-toastr>

        <div id="wrapper">
            @include('layouts.partials.navigation')
            <div class="wrapper wrapper-content">
                <div class="container user-content">
                    @yield('content')
                </div> {{-- /.container --}}
            </div> {{-- /.wrapper --}}
        </div> {{-- /#wrapper --}}
    </div> {{-- /#app --}}

    {{-- Scripts --}}
    <script src="{{ elixir('js/app.js') }}"></script>
    </body>
</html>

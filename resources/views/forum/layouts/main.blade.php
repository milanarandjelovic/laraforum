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
            ]); ?>;
          window.LaraForum = <?php echo json_encode([
              'id' => Auth::check() ? Auth::user()->id : 'null',
              'authenticated' => Auth::check() ? 'true' : 'false',
              'username' => Auth::check() ? Auth::user()->username : 'null',
              'avatar' => Auth::check() ? Gravatar::src(Auth::user()->email, 60) : 'null'
          ]); ?>;
        </script>
    </head>
    <body class="top-navigation pace-done gray-bg">

        <div id="app" class="gray-bg">

            <vue-toastr ref="toastr"></vue-toastr>

            <div id="wrapper">
                @include('layouts.partials.navigation')
                <div class="container forum-content">
                    <div class="row">
                        @yield('content')
                    </div> {{-- /.row --}}
                </div> {{-- /.container --}}
                @include('layouts.partials.footer')
            </div> {{-- /#wrapper --}}
        </div> {{-- /#app --}}

        {{-- Scripts --}}
        <script src="{{ elixir('js/app.js') }}"></script>
    </body>
</html>

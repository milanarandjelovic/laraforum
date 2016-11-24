@extends('layouts.app-blank')

@section('title', '| Login')

@section('content')
    <div class="container">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div class="col-md-12 login">

                <div>
                    <h1 class="logo-name text-center">LF</h1>
                </div>

                <div>
                    <h3 class="text-center">Welcome to Laravel Forum</h3>
                </div>

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               placeholder="E-Mail Address" autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div> {{-- /.form-group --}}

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password"
                               placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div> {{-- /.form-group --}}

                    <div class="form-group">
                        <div class="checkbox i-checks pull-left">
                            <input type="checkbox" name="remember" id="remember" class="filled-in">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div> {{-- /.form-group --}}

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                    </div> {{-- /.form-group --}}

                    <div class="text-center">
                        <div class="forgot-password">
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                        </div>
                    </div>

                    <div>
                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                    </div>

                    <div class="form-group m-b-0">
                        <a href="{{ url('/register') }}" class="btn btn-sm btn-white btn-block">Create an account</a>
                    </div> {{-- /.form-group --}}

                </form>

            </div> {{-- /.login --}}
        </div> {{-- /.middle-box --}}
    </div> {{-- /.container --}}
@endsection

@extends('layouts.app-blank')

@section('title', '| Register')

@section('content')
    <div class="container">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div class="col-md-12 register">

                <div>
                    <h1 class="logo-name text-center">LF</h1>
                </div>

                <div>
                    <h3 class="text-center">Register to Laravel Forum</h3>
                </div>

                <div class="text-center">
                    <p>Create account to see it in action.</p>
                </div>

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                               placeholder="Name" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div> {{-- /.form-group --}}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               placeholder="E-Mail Address">
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

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input id="password-confirm" type="password" class="form-control"
                               placeholder="Confirm Password" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div> {{-- /.form-group --}}

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary block full-width m-b">Register</button>
                    </div> {{-- /.form-group --}}

                    <div>
                        <p class="text-muted text-center">
                            <small>Already have an account?</small>
                        </p>
                    </div>

                    <div class="form-group m-b-0">
                        <a href="{{ url('/login') }}" class="btn btn-sm btn-white btn-block">Login</a>
                    </div> {{-- /.form-group --}}

                </form>

            </div> {{-- /.register --}}
        </div> {{-- /.middle-box --}}
    </div> {{-- /.container --}}
@endsection

@extends('layouts.app-blank')

@section('content')
    <div class="middle-box text-center animated fadeInDown">
        <div class="col-md-8 col-md-offset-2">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ $email or old('email') }}" placeholder="E-Mail Address" autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div> {{-- /.form-group --}}

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                </div> {{-- /.form-group --}}

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           placeholder="Confirm Password">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div> {{-- /.form-group --}}

                <div class="form-group">
                    <button type="submit" class="btn btn-primary block full-width m-b">Reset Password</button>
                </div> {{-- /.form-group --}}

            </form>

        </div> {{-- /.col-md-8 --}}
    </div> {{-- /.middle-box --}}
@endsection

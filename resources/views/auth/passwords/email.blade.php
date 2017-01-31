@extends('layouts.app-blank')

@section('title', '| Reset')

<!-- Main Content -->
@section('content')
    <div class="middle-box text-center">

        <div>
            <h1 class="logo-name text-center">LF</h1>
        </div>

        <div>
            <h3 class="text-center">Welcome to Laravel Forum</h3>
        </div>

        <div class="text-center">
            <p>Please enter your email to reset password.</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                       placeholder="E-Mail Address">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div> {{-- /.form-group --}}

            <div class="form-group">
                <button type="submit" class="btn btn-primary block full-width m-b">Send Password Reset Link</button>
            </div> {{-- /.form-group --}}

        </form>

    </div> {{-- /.middle-box --}}
@endsection

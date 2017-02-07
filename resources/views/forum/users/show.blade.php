@extends('forum.layouts.main-blank')

@section('title', '| ' . $user->getNameOrUsername())

@section('content')
    <div class="row user-profile">

        <div class="col-lg-4">

            <div class="ibox">
                <div class="ibox-title">
                    <h3 class="pull-left">Profile Detail</h3>
                    @if(Auth::user())
                        @if(Auth::user()->username === $user->username)
                            <div class="pull-right">
                                <a href="#edit-user" data-toggle="modal" class="btn btn-xs btn-primary">Edit Profile</a>
                            </div>
                        @endif
                    @endif
                </div> {{-- /.ibox-title --}}
                <div class="ibox-content user-avatar">
                    <img src="{{ Gravatar::src($user->email, 360) }}"
                         class="img-responsive center-block" alt="profile">
                </div>
                <div class="ibox-content profile-content">
                    <div class="clearfix user-username">
                        <h4 class="pull-left">
                            <strong>{{ $user->getNameOrUsername() }}</strong>
                        </h4>
                        <div class="user-social-icon btn-group pull-right clearfix">
                            @if($user->twitter_username)
                                <a href="https://twitter.com/{{ $user->twitter_username }}"
                                   class="btn btn-sm btn-default">
                                    <i class="fa fa fa-twitter fa-lg"></i>
                                </a>
                            @endif
                            @if($user->github_username)
                                <a href="https://github.com/{{ $user->github_username }}"
                                   class="btn btn-sm btn-default">
                                    <i class="fa fa-github fa-lg"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    @if($country)
                        <p><i class="fa fa-map-marker"></i>
                            {{ $country->capital }}, {{ $country->name }}
                            @if($country->flag)
                                <img src="{{ url('img/countries/flags/' . $country->flag) }}"
                                     alt="{{ $country->name }}" style="width: 20px;"
                                >
                            @endif
                        </p>
                    @endif
                    @if($user->job_title || $user->place_of_employment)
                        <p style="text-transform: uppercase;">
                            <strong>{{ $user->job_title }} at, {{ $user->place_of_employment }}</strong>
                        </p>
                    @endif
                    @if($user->profile_description)
                        <h5>About me</h5>
                        <p class="small">{{ $user->profile_description }}</p>
                    @endif
                    <div class="user-button">
                        <div class="row mb-5">
                            <div class="col-md-6 col-sm-6">
                                <button type="button" class="btn btn-primary btn-sm btn-block">
                                    <i class="fa fa-envelope"></i> Send Message
                                </button>
                            </div> {{-- /.col-md-6 --}}
                            <div class="col-md-6 col-sm-6">
                                <button type="button" class="btn btn-default btn-sm btn-block">
                                    <i class="fa fa-coffee"></i> Buy a coffee
                                </button>
                            </div> {{-- /.col-md-6 --}}
                        </div> {{-- /.row --}}
                    </div> {{-- /.user-button --}}
                </div> {{-- /.ibox-content --}}
            </div> {{-- /.ibox --}}

            <div class="ibox">
                <div class="ibox-title">
                    <h3>Followers and friends</h3>
                </div> {{-- /.ibox-title --}}
                <div class="ibox-content">
                    <div class="user-friends">
                        Add Followers and friends
                    </div>
                </div> {{-- /.ibox-content --}}
            </div> {{-- /.ibox --}}

        </div> {{-- /.col-lg-4 --}}

        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Activites</h5>
                </div> {{-- /.ibox-title --}}
                <div class="ibox-content">
                    @include('forum.users.partials.activity')
                </div> {{-- /.ibox-content --}}
            </div> {{-- /.ibox --}}
        </div> {{-- /.col-lg-8 --}}

    </div> {{-- /.row --}}
    @if(Auth::user())
        <edit-user :username="'{{ $user->username }}'"></edit-user>
    @endif
@endsection
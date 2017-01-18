<div class="row border-bottom white-bg">
    <nav class="navbar navbar-static-top main-navigation forum-navigation" role="navigation">
        <div class="container">
            <div class="navbar-header">

                {{-- Collapsed Hamburger --}}
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse"
                        class="navbar-toggle collapsed" type="button">
                    <i class="fa fa-reorder"></i>
                </button>

                {{-- Branding Image --}}
                <div class="brand-holder">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'LaraForum') }}
                    </a>
                </div>
            </div>

            <div class="navbar-collapse collapse" id="navbar">
                {{-- Left Side Of Navbar --}}
                <ul class="nav navbar-nav">
                </ul>

                <forum-search></forum-search>

                {{-- Right Side Of Navbar --}}
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{ route('discussion.index') }}">Forum</a>
                    </li>
                    {{-- Authentication Links --}}
                    @if (Auth::guest())
                        <li>
                            <a href="{{ route('auth.login') }}">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('auth.register') }}">Register</a>
                        </li>
                    @else
                        <li class="dropdown profile-img-holder">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                <img src="{{ Gravatar::src(Auth::user()->email, 38) }}" class="img-circle"
                                     alt="profile">
                                {{ Auth::user()->getNameOrUsername() }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu profile-dropdown-menu" role="menu">
                                @if(Auth::user()->isAdmin())
                                    <li>
                                        <a href="{{ route('admin.dashboard')  }}">
                                            <i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ '/@' . Auth::user()->username }}">
                                        <i class="fa fa-user" aria-hidden="true"></i>Profile
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('auth.logout') }}">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div> {{-- /.container --}}
    </nav>
</div>
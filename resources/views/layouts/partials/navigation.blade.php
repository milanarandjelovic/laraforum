<div class="row border-bottom white-bg">
    <nav class="navbar navbar-static-top main-navigation" role="navigation">

        <div class="navbar-header">

            {{-- Collapsed Hamburger --}}
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse"
                    class="navbar-toggle collapsed" type="button">
                <i class="fa fa-reorder"></i>
            </button>

            {{-- Branding Image --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'LaraForum') }}
            </a>
        </div>

        <div class="navbar-collapse collapse" id="navbar">
            {{-- Left Side Of Navbar --}}
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            {{-- Right Side Of Navbar --}}
            <ul class="nav navbar-top-links navbar-right">
                {{-- Authentication Links --}}
                @if (Auth::guest())
                    <li><a href="{{ route('auth.login') }}">Login</a></li>
                    <li><a href="{{ route('auth.register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('auth.logout') }}">Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>

    </nav>
</div>
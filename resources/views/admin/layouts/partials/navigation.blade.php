<div class="row border-bottom">

    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

        {{-- Brand and toggle get grouped for better mobile display --}}
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary">
                <i class="fa fa-bars"></i>
            </a>
        </div>

        {{-- Collect the nav links, forms, and other content for toggling --}}
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">

            </ul>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to LaraForum Admin.</span>
                </li>
                <li>
                    <a href="{{ route('auth.logout') }}">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>Logout
                    </a>
                </li>
            </ul>
        </div> {{-- /.navbar-collapse --}}

    </nav>

</div>
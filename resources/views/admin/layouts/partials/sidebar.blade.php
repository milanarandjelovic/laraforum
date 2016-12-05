<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">


                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle"
                             src="https://placeholdit.imgix.net/~text?txtsize=33&txt=profile%20image&w=48&h=48">
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ (Auth::user()->getNameOrUsername()) }}</strong>
                                <b class="caret"></b>
                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs profile-element-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-user" aria-hidden="true"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-users" aria-hidden="true"></i>Contacts
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-envelope"></i>Mailbox
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('auth.logout') }}">
                                <i aria-hidden="true" class="fa fa-sign-out"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">LF</div>
            </li>

            <li class="{{ HelpMenu::activeAdminMenu('admin/dashboard') }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li> {{-- /dashboard --}}

            <li class="{{ HelpMenu::activeAdminMenu('admin/channels') }}">
                <a href="{{ route('channel.index') }}"><i class="fa fa-list-alt"></i>
                    <span class="nav-label">Channels</span>
                </a>
            </li> {{-- /channels --}}

            <li class="{{ HelpMenu::activeAdminMenu('admin/passport') }}">
                <a href="{{ route('passport.index') }}"><i class="fa  fa-cog"></i>
                    <span class="nav-label">Passport</span>
                </a>
            </li> {{-- /passport --}}

            {{--<li>--}}
            {{--<a href="#"><i class="fa fa-envelope"></i>--}}
            {{--<span class="nav-label">Mailbox</span>--}}
            {{--</a>--}}
            {{--</li>--}}
        </ul>
    </div> {{-- /.sidebar-collapse --}}
</nav> {{-- /.sidebar-menu --}}
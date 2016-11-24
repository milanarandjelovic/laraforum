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
                                </span>
                                <span class="text-muted text-xs block">
                                    Art Director <b class="caret"></b>
                                </span>
                            </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">LF</div>
            </li>
            <li class="{{ \App\LaraForum\Helpers\Menu::activeMenu('admin/dashboard') }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            {{--<li>--}}
                {{--<a href="#"><i class="fa fa-envelope"></i>--}}
                    {{--<span class="nav-label">Mailbox</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </div> {{-- /.sidebar-collapse --}}
</nav> {{-- /.sidebar-menu --}}
<div class="forum-sidebar">

    @if(Auth::user())
        <a href="{{ route('discussion.create') }}" class="btn btn-block btn-outline btn-primary button mb-1">New Discussion</a>
    @else
        <a href="{{ route('auth.register') }}" class="btn btn-block btn-outline btn-primary button mb-1">Create Account</a>
    @endif

    <div class="sidebar-filter">
        <p class="sidebar-label">Choose a Filter</p>
    </div> {{-- /.sidebar-filter --}}

    <div class="sidebar-channel">
        <p class="sidebar-label">Or Pick a Channel</p>
    </div> {{-- /.sidebar-channel --}}

</div> {{-- /.forum-sidebar --}}
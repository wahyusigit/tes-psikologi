<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- Sidebar user panel (optional) -->
    @if (! Auth::guest())
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset(Auth::user()->avatar)}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
            </div>
        </div>
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="{{ url(route('testerProfile')) }}"><i class="fa fa-user"></i> <span>Edit Profile</span></a></li>
            </ul><!-- /.sidebar-menu -->
        </section>
    @endif

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::is('tester') ? 'active' : '' }}"><a href="{{ route('testerIndex') }}"><i class='fa fa-home'></i> <span>Home</span></a></li>
            <li class="{{ Request::is('tester/tes*') ? 'active' : '' }}"><a href="{{ route('testerForm') }}"><i class='fa fa-calendar'></i> <span>Tes</span></a></li>
            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::is('admin') ? 'active' : '' }}"><a href="{{ route('adminIndex') }}"><i class='fa fa-home'></i> <span>Home</span></a></li>
            <li class="{{ Request::is('admin/jadwal*') ? 'active' : '' }}"><a href="{{ route('adminJadwalIndex') }}"><i class='fa fa-calendar'></i> <span>Jadwal</span></a></li>
            <li class="{{ Request::is('admin/sekolah*') ? 'active' : '' }}"><a href="{{ route('adminSekolahIndex') }}"><i class='fa fa-building'></i> <span>Sekolah</span></a></li>
            <li class="{{ Request::is('admin/tester') || Request::is('admin/tester/*') ? 'active' : '' }}"><a href="{{ route('adminTesterIndex') }}"><i class='fa fa-users'></i> <span>Tester</span></a></li>
            <li class="{{ Request::is('admin/tes') || Request::is('admin/tes/*') ? 'active' : '' }}"><a href="{{ route('adminTesIndex') }}"><i class='fa fa-clock-o'></i> <span>Tes</span></a></li>
            <li class="{{ Request::is('admin/laporan*') ? 'active' : '' }}"><a href="{{ route('adminLaporanIndex') }}"><i class="fa fa-archive"></i> <span>Laporan</span></a></li>
            <li class="{{ Request::is('admin/profile*') ? 'active' : '' }}"><a href="{{ route('adminProfile') }}"><i class="fa fa-user"></i> <span>Profile</span></a></li>
            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

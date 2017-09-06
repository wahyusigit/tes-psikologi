<!DOCTYPE html>

<html lang="en">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body class="skin-blue sidebar-mini">
<div id="app">
    <div class="wrapper">

    @include('layouts.partials.mainheader')

    @include('layouts.partials.sidebartester')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('main-content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('layouts.partials.controlsidebar')

    @include('layouts.partials.footer')

</div>
</div>
@section('scripts')
    @include('layouts.partials.scripts')
@show
@stack('script')
</body>
</html>

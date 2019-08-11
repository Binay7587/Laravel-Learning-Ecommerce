@include('admin.layouts.section.header')

<div class="page-wrapper">

    @include('admin.layouts.section.navigation')
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            @include('admin.layouts.section.notification')
            @yield('main-content')
        </div>
        <!-- END PAGE CONTENT-->
        <footer class="page-footer">
            <div class="font-13">{{ date('Y') }} © <b>Nayabazar Admin</b> - All rights reserved.</div>
            <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
        </footer>
    </div>
</div>

<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>

@include('admin.layouts.section.footer')

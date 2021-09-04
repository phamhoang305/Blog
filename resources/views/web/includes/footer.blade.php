<div class="container ">
    <footer class="main-footer ">
        @include('web.includes.footer-mobile')
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.1.0
        </div>
        <!-- Default to the left -->
        <div class="d-none d-sm-inline-block center">
            Bản quyền &copy; 2019-{{ date('Y') }} <a href="{{ route('web.home.index') }}">{{ setting()->name }}</a> . đã đăng ký Bản quyền.
        </div>
    </footer>
</div>


<div class="container ">
    <footer class="main-footer ">
        @include('web.includes.footer-mobile')
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0
        </div>
        <!-- Default to the left -->
        <div class="d-none d-sm-inline-block">
            <strong>Copyright &copy; 2020-{{ date('Y') }} <a href="{{ route('web.home.index') }}">{{ setting()->name }}</a>.</strong> All rights reserved.
        </div>
    </footer>
</div>

</div>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate() !!}
    @include('includes.icon')
    @include('admin.includes.css')
    @yield('runCSS')
</head>
<body class="hold-transition  layout-fixed layout-navbar-fixed    layout-footer-fixed text-sm ">
    <div class="">
    <div class="wrapper ">
        @include('includes.loading')
        @include('admin.includes.header')
        @include('admin.includes.sidebar')
        <div class="content-wrapper">
            @include('includes.alertSession')
            @yield('admin')
        </div>
        @include('admin.includes.footer')
    </div>
    </div>
     @include('admin.formControl.modalDelete')
      @include('admin.includes.script')
      @yield('runJS')
</body>
</html>

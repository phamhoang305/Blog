<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate() !!}
    <link rel="stylesheet" href="{{asset('assets/themes/plugins/fontawesome-free/css/all.min.css')}}?v={{ uniqid() }}">
    @include('includes.icon')
    @include('web.includes.css')
    @yield('runCSS')
</head>
@php $hiddenSidbar = false;@endphp
@if (isset($typePage))@php $hiddenSidbar = true;@endphp
@else @php $hiddenSidbar = false;@endphp @endif
<body class="hold-transition  layout-fixed layout-navbar-fixed   layout-footer-fixed text-sm ">
    <div class="">
        <div class="wrapper ">
            @include('includes.loading')
            <nav class="main-header navbar navbar-expand navbar-dark navbar-light dropdown-legacy border-bottom-0 text-sm">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                  </li>
                  <li class="nav-item d-none d-sm-inline-block">
                    <a target="_blank" href="{{ route('web.home.index') }}" class=""><button class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Xem website</button></a>
                  </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                  @if (Auth::check())
                  <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                        <i class="fa fa-user-circle"></i> <span class="d-none d-sm-inline-block">&nbsp; {{ Auth::user()->full_name }}</span>
                    </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                      <li><a href="{{ route('web.user.index',Auth::user()->username)  }}" class="dropdown-item"><i class="fas fa-user"></i> Hô sơ cá nhân </a></li>
                      <li><a href="{{route('web.me.public')}}" class="dropdown-item"><i class="fas fa-rss"></i> Nội dung của tôi </a></li>
                      <li><a href="{{route('admin.dashboard.view')}}" class="dropdown-item"><i class="fas fa-tachometer-alt"></i> Bản điều khiển </a></li>
                      <li class="dropdown-divider"></li>
                      <li><a href="{{ route('web.auth.logout') }}"  class="button-logout dropdown-item"><i class="fas fa-sign-out-alt"></i> Đăng xuất </a></li>
                    </ul>
                  </li>
                  @else
                    <li class="nav-item">
                      <a class="nav-link"  href="{{ route('web.auth.login') }}" role="button">
                        <i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                    </li>
                  @endif
                </ul>
            </nav>
            @include('web.includes.sidebarMyContent')
            <div class="content-wrapper">
                <div class="container">
                    @include('includes.alertSession')
                </div>
                @yield('web')
            </div>
            @include('web.includes.footer')
        </div>
    </div>
    @include('web.formControl.modalDelete')
    @include('web.includes.script')
    @yield('runJS')
    {!! setting()->Google_Analytics!!}
</body>
</html>

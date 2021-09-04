<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate() !!}
    @include('includes.icon')
    <link rel="stylesheet" href="{{asset('assets/themes/plugins/fontawesome-free/css/all.min.css')}}?v={{ uniqid() }}">
    @include('web.includes.css')
    @yield('runCSS')
</head>
<body class="login-page {{ setting()->darkMode=='on'?'dark-mode':'' }}">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-dark">

      <div class="card-body login-card-body">
        <div class="callout callout-warning">
            <p>Nhập email của bạn để lấy lại mật khẩu !</p>
        </div>
        <form action="{{route('web.forgot.index') }}" method="POST">

            @if (session('status_forgot_error'))
            <div class="callout callout-danger">
                <p> {{session('status_forgot_error')}}</p>
            </div>
            @endif
            @if (session('status_forgot_success'))
            <div class="callout callout-success">
            <p> {{session('status_forgot_success')}}</p>
            </div>
            @endif
            @csrf
            <div class="form-group">
                <input type="email" class="form-control" required name="email" placeholder="Nhập email của bạn .... ">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info btn-block"><i class="far fa-share-square"></i>  Gửi </button>
            </div>
            <div class="form-group">
                <a href="{{ redirect()->route('web.home.index') }}" class="btn btn-danger btn-block" ><i class="fas fa-home"></i> Quay lại</a>
            </div>
        </form>
    </div>

    </div>
    <!-- /.card -->
  </div>

@include('web.includes.script')
@yield('runJS')
@yield('runJSFollow')
{!! setting()->Google_Analytics!!}
</body>
</html>



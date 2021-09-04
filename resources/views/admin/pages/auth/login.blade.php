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
</head>
<body class="hold-transition bg-color login-page {{ setting()->darkMode=='on'?'dark-mode':'' }}">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{route('admin.auth.login')}}" class="h3"><b>ĐĂNG NHẬP</b></a>
            </div>
                <!-- /.card-header -->
            <div class="card-body " >

                    <div id="alertJS">
                        @if (session('status'))
                        <div class="alert alert-warning text-small alert-dismissible" role="alert"> <i class="icon fas fa-exclamation-triangle"></i> {{session('status')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        @endif
                    </div>
                    <form id="formLogin">
                    <div class="form-group">
                        <input type="text" name="username" value="" placeholder="Email or username" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" value="" placeholder="Mật khẩu" class="form-control">
                    </div>
                    <div class="form-group">
                        <button id="buttonLogin" data-url="{{route('admin.auth.ajaxLogin')}}" type="submit" class="btn btn-info btn-flat btn-block">Đăng nhập</button>
                    </div>
                    @if (setting()->github_status=='on'||setting()->google_status=='on'||setting()->facebook_status=='on')
                    <div class="form-group">
                        <div class="social-auth-links text-center mt-2 mb-3">
                            @if (setting()->facebook_status=='on')
                                <a href="{{route('web.social.oauth','facebook')}}" class="btn btn-block btn-primary">
                                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                                </a>
                            @endif
                            @if (setting()->github_status=='on')
                                <a href="{{route('web.social.oauth','github')}}" class="btn btn-block btn-dark">
                                    <i class="fab fa-github"></i> Sign in using Github
                                </a>
                            @endif
                            @if (setting()->google_status=='on')
                                <a href="{{route('web.social.oauth','google')}}" class="btn btn-block btn-danger">
                                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                                </a>
                            @endif
                        </div>
                    </div>
                    @endif

                    </form>

            </div>
            <div class="card-footer ">
                <p class="mb-1">
                  <a href="{{ route('web.forgot.index') }}" class="text-center text-info">Tôi quên mật khẩu của tôi</a>
                </p>
            </div>
        </div>
    </div>
    @include('admin.includes.script')
    <script src="{{asset('assets/web/auth/auth.js')}}"></script>
    <script>
    var auth = new auth(); auth.datas={}auth.init();
    </script>
</body>
</html>


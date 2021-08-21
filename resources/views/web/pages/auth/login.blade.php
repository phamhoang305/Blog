@extends('layouts.web')
@section('web')

<!-- Main content -->
<div class="content">
  <div class="container ">
    <div class="row">
        <div class="offset-md-4">
        </div>
        <div class="col-md-4  ">
        <div class="card  card-dark">
          <div class="card-header text-center">
            <a href="{{route('web.auth.login')}}" class="h3"><b>ĐĂNG NHẬP</b></a>
          </div>
            <!-- /.card-header -->
            <div class="card-body " >
                <div class="form-group">
                    {{-- <img width="100%" src="{{asset('assets/images/logo/logo.png')}}" alt="{{setting()->name}}"/> --}}
                </div>
                <div id="alertJS"></div>
                <form id="formLogin">
                  <div class="form-group">
                      <input type="text" name="username" value="" placeholder="Email or username" class="form-control">
                  </div>
                  <div class="form-group">
                      <input type="password" name="password" value="" placeholder="Mật khẩu" class="form-control">
                  </div>
                  <div class="form-group">
                      <button id="buttonLogin" data-url="{{route('web.auth.ajaxLogin')}}" type="submit" class="btn btn-info btn-flat btn-block">Đăng nhập</button>
                  </div>
                  @if (setting()->github_status=='on'||setting()->google_status=='on'||setting()->facebook_status=='on')
                  <div class="form-group">
                    <div class="social-auth-links text-center mt-2 mb-3">
                        @if (setting()->facebook_status=='on')
                            <a href="{{route('web.social.oauth','facebook')}}?redirect=true" class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                            </a>
                        @endif
                        @if (setting()->github_status=='on')
                            <a href="{{route('web.social.oauth','github')}}?redirect=true" class="btn btn-block btn-dark">
                                <i class="fab fa-github"></i> Sign in using Github
                            </a>
                        @endif
                        @if (setting()->google_status=='on')
                            <a href="{{route('web.social.oauth','google')}}?redirect=true" class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                            </a>
                        @endif



                    </div>
                  </div>
                  @endif

                </form>

            </div>
            <div class="card-footer bg-dark">
              <p class="mb-1">
                <a href="{{ route('web.forgot.index') }}" class="text-center text-info">Tôi quên mật khẩu của tôi</a>
              </p>
              <p class="mb-0">
                <a href="{{route('web.auth.register')}}" class="text-center text-info">Đăng ký thành viên mới</a>
              </p>
            </div>
          </div>
    </div>

      <!-- /.col-md-6 -->
    </div>

    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@endsection
@section('runJS')
<script src="{{asset('assets/web/auth/auth.js')}}"></script>
<script>
   var auth = new auth();
   auth.init();
</script>
@endsection

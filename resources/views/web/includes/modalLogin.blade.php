<div class="modal" tabindex="-1" id="modalLogin" role="dialog">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
                <div class="card-header bg-white">
                    <h5 class="card-title">Đăng nhập</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body m-3" >
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
                                <a href="{{route('web.social.oauth','facebook')}}?redirect=true" class="btn btn-block btn-primary btn-login-social">
                                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                                </a>
                            @endif
                            @if (setting()->github_status=='on')
                                <a href="{{route('web.social.oauth','github')}}?redirect=true" class="btn btn-block btn-dark btn-login-social">
                                    <i class="fab fa-github"></i> Sign in using Github
                                </a>
                            @endif
                            @if (setting()->google_status=='on')
                                <a href="{{route('web.social.oauth','google')}}?redirect=true" class="btn btn-block btn-danger text-white btn-login-social">
                                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                                </a>
                            @endif
                        </div>
                    </div>
                    @endif
                    </form>
                </div>
                <div class="card-footer bg-white" >
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('web.forgot.index') }}" class="btn bg-navy btn-block ">Tôi quên mật khẩu của tôi</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('web.auth.register')}}" class="btn btn-warning btn-block ">Đăng ký thành viên mới</a>
                        </div>
                    </div>
                </div>
      </div>
    </div>
</div>

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
          <div class="card-header text-center bg-white">
            <a href="" class="h3"><b>ĐĂNG KÝ</b></a>
          </div>
            <!-- /.card-header -->
            <div class="card-body p-4" >

                <div class="alertJS"></div>
                <form id="formRegister">
                    <div class="form-group">
                        <input type="text" name="full_name" value="" placeholder="Họ và tên" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" value="" placeholder="Email .... " class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" value=""  placeholder="Mật khẩu" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="cf_password" value="" placeholder="Nhập lại mật khẩu" class="form-control">
                    </div>
                    <div class="form-group">
                        <button  data-url="{{route('web.auth.ajaxRegister')}}" type="submit" class="btn btn-info btn-flat btn-block buttonConfirm">Đăng ký</button>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn bg-navy btn-flat btn-block btn-show-login">Tôi đã có tài khoản</button>
                    </div>
                </form>
            </div>

          </div>
    </div>

      <!-- /.col-md-6 -->
    </div>

    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="modal" id="modalCode" >
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <div class="form-group">
                <div id="alertJSConfirm"></div>
                <div class="alertJS"></div>
            </div>
            <div class="form-group">
                <input class="form-control text-center" placeholder="Nhập mã xác thực" id="code" name="code"/>
            </div>
		</div>
        <div class="modal-footer">
			<button data-dismiss="modal" aria-label="Close" class="btn btn-danger" >Hủy bỏ</button>
            <button class="btn btn-info buttonConfirm">Gửi lại</button>
			<button type="button" class="btn btn-dark" data-url="{{route('web.auth.ajaxRegister')}}" id="buttonRegister">Xác nhận</button>
        </div>
      </div>
    </div>
</div>
@endsection
@section('runJS')
<script src="{{asset('assets/web/auth/register.js')}}"></script>
<script>
   var register = new register();
   register.init();
</script>
@endsection

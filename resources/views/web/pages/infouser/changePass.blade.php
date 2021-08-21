@extends('layouts.profile')
@section('web')
<section class="content ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('web.pages.infouser.includes.info')
            </div>
            <!-- /.col -->
            <div class="col-md-12">
                <form id="formChangePass" action="{{route('web.user.changePass')}}">
                    <div class="card">
                        <div class="card-header p-2">
                            @include('web.pages.infouser.includes.menu',['menuType'=>'changePass','user'=>$user])
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="card card-body">
                                        <div class="form-group">
                                            <div class="alertJS">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="old_password">Nhập lại mật khẩu củ <span class="text-danger old_password"></span>
                                            </label>
                                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="...">
                                        </div>
                                        <div class="form-group ">
                                            <label for="new_password">Nhập mật khẩu mới <span class="text-danger old_password"></span>
                                            </label>
                                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="...">
                                        </div>
                                        <div class="form-group ">
                                            <label for="re_password" class="">Xác nhận lại mật khẩu mới <span class="text-danger old_password"></span>
                                            </label>
                                            <input type="password" class="form-control" id="re_password" name="re_password" placeholder="...">
                                        </div>

                                    </div>
                                    <div class="card card-footer">
                                        <div class=""> <a href="{{route('web.home.index')}}" class="btn btn-danger float-feft"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                                            <button type="submit" id="onSaveChangePass" class="btn btn-success">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <!-- /.tab-pane -->
                        </div>

                    </div><!-- /.card-body -->
                </form>
            </div>
          <!-- /.card -->
        </div>
    </div>
</section>
@endsection
@section('runJS')
<script src="{{asset('assets/web/profile/profile.js')}}"></script>
<script>
   var profile = new profile();
   profile.datas={

   }
   profile.init();
</script>
@endsection

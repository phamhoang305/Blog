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
                <form id="formProfile" action="{{route('web.user.updateProfile')}}" >
                    <div class="card">
                        <div class="card-header p-2">
                            @include('web.pages.infouser.includes.menu',['menuType'=>'profile','user'=>$user])
                        </div><!-- /.card-header -->
                        <div class=" card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="username" >ID <small class="error-email text-danger"></small></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text">@</span>
                                                        </div>
                                                        <input type="text" name="username" id="username" class="form-control" value="{{$user->username}}" placeholder="ID ... ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" >Email
                                                        @if ($user->email_verified_token!=NULL)
                                                            <small class="text-danger"><b>(Chưa xác thực mail !)</b></small>
                                                        @else
                                                            <small class="text-success"><b>(Đã xác thực)</b> </small>
                                                        @endif
                                                    </label>
                                                    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="Email ... ">
                                                </div>
                                                <div class="form-group ">
                                                    <label for="full_name" >Họ Tên</label>
                                                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{$user->full_name}}" placeholder="Họ tên ... ">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputName2" >Giới Tính</label>
                                                    <select  class="form-control">
                                                        <option {{$user->sex=='0'?'selected':''}}value="1">Nam</option>
                                                        <option {{$user->sex=='1'?'selected':''}}value="0">Nữ</option>
                                                    </select>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="birthday" >Ngày Sinh</label>
                                                    <input type="date" class="form-control" id="birthday" name="birthday" value="{{$user->birthday}}" placeholder="Ngày sinh">
                                                </div>
                                                <div class="form-group ">
                                                    <label for="address" >Địa chỉ</label>
                                                    <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}" placeholder="Địa chỉ ... ">
                                                </div>
                                                {{-- <div class="form-group ">
                                                    <label for="phone" >Số Điện Thoại</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}" placeholder="Số ĐT" ... ">
                                                </div> --}}
                                                <div class="form-group ">
                                                    <label for="about" >Giới thiệu </label>
                                                    <div id="about">
                                                        {!!$user->about!!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputName2" > Nhận Mail người đã theo dõi </label>
                                                    <select  name="status_notice_userFollow"  class="form-control">
                                                        <option {{$user->status_notice_userFollow=='on'?'selected':''}} value="on">Bật</option>
                                                        <option {{$user->status_notice_userFollow=='off'?'selected':''}} value="off">Tắt</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-footer">
                                        <div class=""> <a href="{{route('web.home.index')}}" class="btn btn-danger float-feft"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                                            <button type="submit" id="onSaveProfile"  class="btn btn-success">Lưu</button>
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
@section('runCSS')
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/quill/quill.snow.css')}}">
@endsection
@section('runJS')
<script src="{{asset('assets/themes/plugins/quill/quill.js')}}"></script>
<script src="{{asset('assets/themes/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/web/profile/profile.js')}}"></script>
<script>
   var profile = new profile();
   profile.datas={

   }
   profile.init();
</script>
@endsection

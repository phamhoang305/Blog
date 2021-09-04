@extends('layouts.admin')
@section('admin')
<!-- Main content -->
<section class="content">
    <div class="container-fulld">
        <form value="{{$user->id}}" action="{{$type=='update'?route('admin.user.edit'):route('admin.user.add')}}" id="formAction" name="id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-widget card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{$type=='update'?'CẬP NHẬT':'THÊM MỚI'}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body " >
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="type" >Hệ thống hay thành viên </label>
                                                <select id="type" name="type" class="select2">
                                                        <option @isset($user->type){{$user->type=='userAdminCreate'?'selected':''}}@endisset  value="userAdminCreate">Hệ thống</option>
                                                        <option @isset($user->type){{$user->type=='userCreate'?'selected':''}}@endisset  value="userCreate">Thành viên</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="roleHiden">
                                            <div class="form-group">
                                            <label for="roleID" >Vai trò </label>
                                            <select name="roleID" class="select2">
                                                <option value="">- Chọn vai trò -</option>
                                                @foreach (getRoles() as $item)
                                                     <option @isset($user){{$user->roleID==$item->id?'selected':''}}@endisset value="{{$item->id}}">{{$item->role_name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                         </div>
                                        <div class="col-md-12">
                                             @if ($type=='update')
                                             <div class="form-group">
                                                <label for="username" >ID <small class="error-email text-danger"></small></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">@</span>
                                                    </div>
                                                    <input type="text" name="username" id="username" class="form-control" value="{{$user->username}}" placeholder="ID ... ">
                                                </div>
                                            </div>
                                             @endif

                                            <div class="form-group">
                                                <label for="email" >Email <small class="error-email text-danger"></small></label>
                                                <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="Email ... ">
                                            </div>
                                            <div class="form-group">
                                                <label for="email" >Mật khẩu
                                                    @if ($type=='update')
                                                        <small class="error-email text-danger"> Nhập mật khẩu mới để thay đổi</small>
                                                    @else
                                                        <small class="error-email text-danger"> Nếu không nhập sẽ mặt định (123456)</small>
                                                    @endif

                                                </label>
                                                <input type="text" class="form-control" id="password" name="password"  placeholder="Mật khẩu ... ">
                                            </div>
                                            <div class="form-group">
                                                    <label>Trạng thái đăng bài </label>
                                                    <select name="status_approve" class="form-control select2">
                                                        <option {{$user->status_approve=='off'?'selected':''}} value="off">Không phê duyệt</option>
                                                        <option {{$user->status_approve=='on'?'selected':''}} value="on">Phê duyệt</option>
                                                    </select>
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
                                                <input type="text" class="form-control" id="about" name="about" value="{{$user->about}}" placeholder="Giới thiệu ... ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class=""> <a href="{{route('admin.user.view')}}" class="btn btn-danger float-feft"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                                <button type="submit" id="onSaveUser"  class="btn btn-success">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('runJS')
<script src="{{asset('assets/admin/user/user.js')}}"></script>
<script>
   var user = new user();
   user.datas={
    type:"@isset($user->type){{$user->type}}@endisset",
    action:"{{$type}}"
   }
   user.init();
</script>
@endsection

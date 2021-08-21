@extends('layouts.admin')
@section('admin')
<!-- Main content -->
<section class="content">
    <div class="container-fulld">
        <form value="{{$role->id}}" action="{{$type=='update'?route('admin.role.edit'):route('admin.role.add')}}" id="formAction" name="id">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card card-info ">
                        <div class="card-header">
                            <h3 class="card-title">{{$type=='update'?'CẬP NHẬT':'THÊM MỚI'}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body " >


                                            <div class="form-group ">
                                                <label for="role_name" >Tên quyền</label>
                                                <input type="text" class="form-control" id="role_name" name="role_name" value="{{$role->role_name}}" placeholder="Tên quyền ... ">
                                            </div>
                                            <div class="form-group ">
                                                <label for="role_des" >Mô tả</label>
                                                <input type="text" class="form-control" id="role_des" name="role_des" value="{{$role->role_des}}" placeholder="Mô tả ...">
                                            </div>
                                            <div class="form-group ">
                                                <label for="about" >Quyền chi tiết </label>
                                                    <table class="table  table-bordered table-sm">
                                                        <tr class="table-info">
                                                            <th class="text-center">Chức năng</th>
                                                            <th class="text-center">Trạng thái</th>
                                                        </tr>
                                                        @include('admin.pages.role.includes.category')
                                                        @include('admin.pages.role.includes.page')
                                                        @include('admin.pages.role.includes.post')
                                                        @include('admin.pages.role.includes.contact')
                                                        @include('admin.pages.role.includes.comment')
                                                        @include('admin.pages.role.includes.quiz')
                                                        @include('admin.pages.role.includes.ad')
                                                        @include('admin.pages.role.includes.sitemap')
                                                        @include('admin.pages.role.includes.user')
                                                        @include('admin.pages.role.includes.role')
                                                        @include('admin.pages.role.includes.setting')
                                                    </table>

                                            </div>

                        </div>
                        <div class="card-footer">
                            <div class=""> <a href="{{route('admin.role.view')}}" class="btn btn-danger float-feft"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                                <button type="submit" id="onSaveRole"  class="btn btn-success">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('runCSS')
<link rel="stylesheet" href="{{asset('assets/themes/plugins/bootstrap-multiselect/bootstrap-multiselect.js')}}?v={{time()}}">
@endsection
@section('runJS')
<script src="{{asset('assets/themes/plugins/bootstrap-multiselect/bootstrap-multiselect.js')}}?v={{time()}}"></script>
<script src="{{asset('assets/admin/role/role.js')}}"></script>
<script>
   var role = new role();
   role.datas={
    type:"{{$type}}",
    roles:@json($role->permission)

   }
   role.init();
</script>
@endsection

@extends('layouts.admin')
@section('admin')
<!-- Main content -->
<section class="content">
    <div class="container-fulld">
        <form value="{{$ad->id}}" action="{{route('admin.ad.edit')}}" id="formAction" name="id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-widget card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">CẬP NHẬT</h3>
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
                                            <div class="form-group ">
                                                <label for="about" >Trạng thái </label>
                                                <select  name="status" class="form-control">
                                                    <option {{$ad->status=='on'?'selected':''}}  value="on">Bật</option>
                                                    <option {{$ad->status=='off'?'selected':''}}  value="off">Tất</option>
                                                </select>
                                            </div>
                                            <div class="form-group ">
                                                <label for="name" >Tên</label>
                                                <input type="text" readonly class="form-control" id="name" name="name" value="{{$ad->name}}" placeholder="Tên quyền ... ">
                                            </div>
                                            <div class="form-group ">
                                                <label for="url" >Link</label>
                                                <input type="text" class="form-control" id="url" name="url" value="{{$ad->url}}" placeholder="Link...">
                                            </div>
                                            <div class="form-group">
                                                <label for="file_image_name" >Image (jpg,png,gif,jpeg)</label>
                                                <input class="form-control d-none" type="file" name="file_ad" id="file_ad">
                                                <input readonly class="form-control btn btn-default" value="{{$ad->file_image_name}}" type="text" placeholder="Chọn file hình ảnh" name="file_image_name" id="file_image_name">
                                            </div>
                                            <div class="form-group ">
                                                <label for="code" >Code</label>
                                                <textarea rows="3" id="code" name="code" class="form-control">{{$ad->code}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                                <div class="">
                                    <a href="{{route('admin.ad.view')}}" class="btn btn-danger pull-feft"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                                    <button id="idClear" type="button" class="btn btn-warning pull-right idClear"> Làm mới </button>
                                    <button type="button" id="onSaveAd"  class="btn btn-success pull-right">Lưu</button>
                                <div class="">

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
<script src="{{asset('assets/admin/ad/ad.js')}}"></script>
<script>
   var ad = new ad();
   ad.datas={

   }
   ad.init();
</script>
@endsection

{{-- <a href="http://dinhvanlanh.com/cpane/setting"><img src="https://24hcode.net/uploads/blocks/block_6090cb48f1852.jpg" alt=""></a> --}}

@extends('layouts.admin')
@section('admin')
<section class="content">
    <div class="container-fulld">
        <form value="{{setting()->id}}" action="{{route('admin.setting.edit')}}" id="formAction" name="id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-widget card-dark ">
                        <div class="card-header">
                            <h3 class="card-title">Cài đặt chung</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body " >
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">Thiết lập cơ bản</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body " >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label for="title" >Tiêu đề website</label>
                                                        <input type="text" class="form-control form-control-sm" id="title" name="title" value="{{setting()->title}}" placeholder="Tiêu đề website... ">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="name" >Tên website</label>
                                                        <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{setting()->name}}" placeholder="Tên website... ">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="darkMode" class=" col-form-label ">Dark mode</label>
                                                        <select type="text" class="form-control form-control-sm" name="darkMode">
                                                            <option  {{setting()->darkMode=='off'?'selected':''}} value="off">Tắt</option>
                                                            <option  {{setting()->darkMode=='on'?'selected':''}} value="on">Bật</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="sidebar_post_random_status" class=" col-form-label ">Trạng thái sidebar bài viết ngẫu nhiên</label>
                                                        <select type="text" class="form-control form-control-sm" name="sidebar_post_random_status">
                                                            <option  {{setting()->sidebar_post_random_status=='off'?'selected':''}} value="off">Tắt</option>
                                                            <option  {{setting()->sidebar_post_random_status=='on'?'selected':''}} value="on">Bật</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="sidebar_top_author_status" class=" col-form-label ">Trạng thái sidebar tóp tác giả</label>
                                                        <select type="text" class="form-control form-control-sm" name="sidebar_top_author_status">
                                                            <option  {{setting()->sidebar_top_author_status=='off'?'selected':''}} value="off">Tắt</option>
                                                            <option  {{setting()->sidebar_top_author_status=='on'?'selected':''}} value="on">Bật</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="sidebar_tag_status" class=" col-form-label ">Trạng thái sidebar thẻ</label>
                                                        <select type="text" class="form-control form-control-sm" name="sidebar_tag_status">
                                                            <option  {{setting()->sidebar_tag_status=='off'?'selected':''}} value="off">Tắt</option>
                                                            <option  {{setting()->sidebar_tag_status=='on'?'selected':''}} value="on">Bật</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="sidebar_top_postview_status" class=" col-form-label ">Trạng thái sidebar bài viết xem nhiều</label>
                                                        <select type="text" class="form-control form-control-sm" name="sidebar_top_postview_status">
                                                            <option  {{setting()->sidebar_top_postview_status=='off'?'selected':''}} value="off">Tắt</option>
                                                            <option  {{setting()->sidebar_top_postview_status=='on'?'selected':''}} value="on">Bật</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="sidebar_tag_status" class=" col-form-label ">Cho phép thành viên (Viết bài)</label>
                                                        <select type="text" class="form-control form-control-sm" name="user_add_post_status">
                                                            <option  {{setting()->user_add_post_status=='off'?'selected':''}} value="off">Tắt</option>
                                                            <option  {{setting()->user_add_post_status=='on'?'selected':''}} value="on">Bật</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="sidebar_tag_status" class=" col-form-label ">Cho phép thành viên (Đăng ký,đăng nhập)</label>
                                                        <select type="text" class="form-control form-control-sm" name="user_login_register_status">
                                                            <option  {{setting()->user_login_register_status=='off'?'selected':''}} value="off">Tắt</option>
                                                            <option  {{setting()->user_login_register_status=='on'?'selected':''}} value="on">Bật</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="post_page_number" >Bài viết trên 1 trang</label>
                                                        <input type="number" class="form-control form-control-sm" id="post_page_number" name="post_page_number" value="{{setting()->post_page_number}}" placeholder="Số bài viết trên 1 trang ... ">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="route_admin" >Đường dẫn hệ thống</label>
                                                        <input type="text" class="form-control form-control-sm" id="route_admin" name="route_admin" value="{{setting()->route_admin}}" placeholder="Tên đương dẫn hệ thống ... ">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="route_login" >Đường dẫn đăng nhập hệ thống</label>
                                                        <input type="text" class="form-control form-control-sm" id="route_login" name="route_login" value="{{setting()->route_login}}" placeholder="Tên đương dẫn đăng nhập ... ">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="cache_seconds" >Thời gian lưu Cache (Giây)</label>
                                                        <input type="number" class="form-control form-control-sm" id="cache_seconds" name="cache_seconds" value="{{setting()->cache_seconds}}" placeholder="Số giây cache ... ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">Thông tin liên hệ</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body " >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label for="contact_mail" >Email</label>
                                                        <input type="text" class="form-control form-control-sm" id="contact_mail" name="contact_mail" value="{{setting()->contact_mail}}" placeholder="Email... ">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="contact_phone" >Số ĐT</label>
                                                        <input type="text" class="form-control form-control-sm" id="contact_phone" name="contact_phone" value="{{setting()->contact_phone}}" placeholder="Số điện thoại... ">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="contact_address" >Địa chỉ</label>
                                                        <input type="text" class="form-control form-control-sm" id="contact_address" name="contact_address" value="{{setting()->contact_address}}" placeholder="Địa chỉ... ">
                                                    </div>

                                                    <div class="form-group ">
                                                        <label for="name" >Google Map (iframe)</label>
                                                        <textarea rows="3" type="text" class="form-control form-control-sm text-left" id="iframe_map" name="iframe_map"  placeholder="Iframe map ... ">
                                                            {!! setting()->iframe_map !!}
                                                        </textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">HÌNH ẢNH</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body " >
                                            <label>ICON</label>
                                            <div  class="post-select-image-container"  id="change_icon">
                                                <label class="btn-select-image"  >
                                                   
                                                    <img id="icon_review"  height="100%" width="100%" src="{{getIcon()}}"/>
                                                
                                                    <div class="btn-select-image-inner">
                                                    </div>
                                                </label>
                                            </div>
                                            <input class="d-none" type="file" name="file_icon" id="file_icon">
                                            <label>LOGO</label>
                                            <div  class="post-select-image-container" id="change_logo">
                                                <label class="btn-select-image" >
                                                
                                                    <img id="logo_review" height="100%"  width="100%" src="{{getLogo()}}"/>
                                                   
                                                    <div class="btn-select-image-inner">
                                                    </div>
                                                </label>
                                            </div>
                                            <input class="d-none" type="file" name="file_logo" id="file_logo">
                                        </div>
                                        <div class="card-footer">
                                            <div class="">
                                                <a href="{{route('admin.dashboard.view')}}" class="btn btn-danger float-feft"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                                                <button type="submit"   class="btn btn-success onSaveSetting">Lưu</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="">
                                <a href="{{route('admin.dashboard.view')}}" class="btn btn-danger float-feft"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                                <button type="submit"   class="btn btn-success onSaveSetting">Lưu</button>
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
<style>
.form-group {
    margin-bottom: 0rem;
}
</style>
@endsection
@section('runJS')
<script src="{{asset('assets/admin/setting/setting.js')}}"></script>
<script>
   var setting = new setting();
   setting.datas={

   }
   setting.init();
</script>
@endsection

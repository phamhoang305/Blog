@php
    $image= img_post($post->thumbnail);
    $is_delete=false;
    if (\File::exists(public_path($post->thumbnail))&&$post->thumbnail!=null){
        $is_delete = true;
    }
@endphp
<form  value="{{$post->uniqid}}" action="{{$type=='update'?route('web.publish.edit'):route('web.publish.add')}}" id="formAction" name="uniqid">
                        <input type="hidden" id="defaults-image" value="{{asset('assets/images/defaults/photos-icon.png')}}"/>

                            <div class="row">
                                <div class="col-md-8 ">
                                    <div class="card card-widget card-dark">
                                        <div class="card-body " >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Tiêu đề <span class="text-danger">*</span></label>
                                                    <div class="form-group">
                                                        <input type="text" value="{{$post->post_title}}" id="post_title" name="post_title" placeholder="Tiêu đề ... " class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Sơ lượt & Mô tả (Thẻ meta)</label>
                                                        <div class="input-group">
                                                            <textarea rows="2" type="text" id="post_des"  name="post_des" placeholder="Sơ lượt & Mô tả (Thẻ meta)... " class="form-control">{{$post->post_des}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Từ khóa (Thẻ meta)</label>
                                                        <div class="input-group">
                                                            <input type="text" name="post_keywords" value="{{$post->post_keywords}}" placeholder="Từ khóa (Thẻ meta) ... " class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="card card-widget ">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Tối ưu hóa công cụ tìm kiếm</h3>
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus text-danger"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="card-body" id="seo_wrap">
                                                            <div class="seo-preview">
                                                                <div class="existed-seo-meta ">
                                                                    <div class="page-url-seo ws-nm">
                                                                        <p>{{route('web.home.index')}}/<span class="view-slug">{{$post->post_slug}}<span></p>
                                                                    </div>
                                                                    <span class="page-title-seo">{{$post->post_title}}</span>
                                                                    <div class="ws-nm">
                                                                        @if ($post->created_at)
                                                                        <span style="color: #70757a;">{{ helper_date_format($post->created_at)}} —</span>
                                                                        @else
                                                                        <span style="color: #70757a;">{{ helper_date_format(date('Y-m-d h:i:s'))}} —</span>
                                                                        @endif

                                                                        <span class="page-description-seo">
                                                                            {{$post->post_des}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>Nội dung <span class="text-danger">*</span></label>
                                                    <div class="form-group" >
                                                        <select class="form-control form-control-sm select2" id="editor" name="editor">
                                                            <option {{$post->editor=='quill'?'selected':''}} value="quill">--  Editor Quill --</option>
                                                            <option {{$post->editor=='tinymce'?'selected':''}} value="tinymce">-- Editor  Tinymce --</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div id="alertJS"></div>
                                                        <div id="post_content" name="post_content"  >
                                                        {!!($post->post_content)!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="card card-widget card-dark">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Chọn danh mục cha <span class="text-danger">*</span></label>
                                                    <div class="form-group" >
                                                        <select class="form-control select2" id="category_id" name="category_id">
                                                            <option value="">-- CHỌN DANH MỤC --</option>
                                                            @foreach (getMenu() as $parent)
                                                                <option {{$post->category_id==$parent->id?'selected':''}} value="{{$parent->id}}">{{$parent->cate_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>Chọn danh mục con</label>
                                                    <div class="form-group" >
                                                        <select class="form-control select2" id="category_sub_id" name="category_sub_id">
                                                            <option value="">-- CHỌN DANH MỤC CON --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Hình ảnh (jpg,png,gif,jpeg)</label>
                                                        <div id="alertJSUploadImg"></div>
                                                        <div  class="post-select-image-container" id="change_post_image">
                                                            <button title="Xóa hình ảnh" type="button" id="buttonRemoveIamge" style="position:absolute;z-index: 1000;display:{{$is_delete==true?'':'none'}}" value="{{$is_delete}}" class="btn btn-danger"><i class="fa fa-trash "></i></button>
                                                            <label class="btn-select-image">
                                                                <img id="post_image_review" height="100%" class="img-thumbnail"  width="100%" src="{{$image}}"/>
                                                                <div class="btn-select-image-inner">
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <input class="d-none" type="file" name="file_post_image" id="file_post_image">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                            <label>Trạng thái </label>
                                                            <select name="post_status" class="form-control select2">
                                                                @if ($type=='update')
                                                                    @if ($post->post_status=='published'&&$post->post_approve==null)
                                                                        <option {{$post->post_status=='published'?'selected':''}} value="published">Công khai</option>
                                                                        <option {{$post->post_status=='lock'?'selected':''}} value="lock">Khóa</option>
                                                                    @elseif ($post->post_status=='draft'&&$post->post_approve==null)
                                                                        <option {{$post->post_status=='published'?'selected':''}} value="published">Công khai</option>
                                                                        <option {{$post->post_status=='draft'?'selected':''}} value="draft">Nháp</option>
                                                                    @elseif ($post->post_status=='published'&&$post->post_approve=='approve')
                                                                        <option {{$post->post_status=='published'?'selected':''}} value="published">Công khai</option>
                                                                    @endif
                                                                @else
                                                                    <option {{$post->post_status=='published'?'selected':''}} value="published">Công khai</option>
                                                                    <option {{$post->post_status=='draft'?'selected':''}} value="draft">Nháp</option>
                                                                @endif
                                                            </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Thẻ</label>
                                                        <div class="input-group ">
                                                            <input type="text"  value="@isset($tags){{ $tags }}@endisset" id="tags" data-role="tagsinput" placeholder="Thẻ ... " class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Đặt mật khẩu (Nếu có)</label>
                                                        <div class="input-group">
                                                            <input type="text"  value="{{ $post->post_password }}"  name="post_password" id="post_password" placeholder="Mật khẩu ... " class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputName2"> Gửi Email cho người theo dõi </label>
                                                        <select  name="status_notice_userFollow" class="form-control form-control-sm">
                                                            <option value="off">Không</option>
                                                            <option value="on">Có</option>
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                @if (checkRole('post.approve')
                                                                &&$post->post_approve=='approve'
                                                                &&$post->post_status=='published'
                                                                &&Route::currentRouteName()=='admin.post.edit'
                                                                )
                                                                    <button type="button" value="{{ route('admin.post.approvePublic') }}" id="btnApprove" class="btn btn-default btn-block">Duyệt </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="{{ url()->previous() }}" class="btn btn-danger btn-block">Quay lại</a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="button" id="btnPublic" class="btn btn-info btn-block">Lưu </button>
                                                        </div>
                                                         <div class="col-md-12">
                                                            <input type="hidden" name="showData" value="{{$showData}}" />
                                                         </div>

                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                            </div>

</form>


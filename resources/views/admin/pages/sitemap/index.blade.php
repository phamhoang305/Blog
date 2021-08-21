
@extends('layouts.admin') @section('admin')
<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6 col-md-12">
                        <form id="updateSeo" action="{{ route('admin.sitemap.update') }}">
                            <div class="card card-primary">
                                <div class="card-header with-border">
                                    <h3 class="card-title">SEO</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div  class="post-select-image-container"  id="change_seo">
                                            <label class="btn-select-image"  >
                                                <img id="seo_review"  height="100%" width="100%" src="{{img_seoImage()}}"/>
                                                <div class="btn-select-image-inner">
                                                </div>
                                            </label>
                                        </div>
                                        <input class="d-none" type="file" name="file_seo" id="file_seo">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Tên </label>
                                        <input type="text" class="form-control" value="{{ setting()->name }}" name="name" placeholder="Tên ... ">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tiêu đề trang chủ</label>
                                        <input type="text" class="form-control" value="{{ setting()->title }}" name="title" placeholder="Tiêu đề ...">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Mô tả</label>
                                        <input type="text" class="form-control" value="{{ setting()->des }}" name="des" placeholder="Mô tả ..." >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Từ khóa</label>
                                        <input type="text" class="form-control" value="{{ setting()->keywords }}" name="keywords" placeholder="Mô tả ..." >

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Google Analytics</label>
                                        <textarea class="form-control text-area" name="Google_Analytics" placeholder=" Mã Google Analytics" style="min-height: 100px;">
                                            {{ setting()->Google_Analytics }}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="card-footer" >
                                    <button type="button" data-url="{{route('admin.sitemap.update')}}"  class="btn btn-info pull-right onSaveData"> Lưu </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card card-primary">
                            <div class="card-header with-border">
                                <h3 class="card-title">Sitemap</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="label-sitemap">Tần suất </label>
                                    <small class="small-sitemap">(Giá trị này cho biết tần suất nội dung tại một URL cụ thể có thể thay đổi)</small>
                                    <select id="sitemap_frequency" name="sitemap_frequency" class="form-control">
                                        <option {{ setting()->sitemap_frequency=='none'?'selected':'' }} value="none">None</option>
                                        <option {{ setting()->sitemap_frequency=='always'?'selected':'' }} value="always">Always</option>
                                        <option {{ setting()->sitemap_frequency=='hourly'?'selected':'' }} value="hourly">Hourly</option>
                                        <option {{ setting()->sitemap_frequency=='daily'?'selected':'' }} value="daily">Daily</option>
                                        <option {{ setting()->sitemap_frequency=='weekly'?'selected':'' }} value="weekly">Weekly</option>
                                        <option {{ setting()->sitemap_frequency=='monthly'?'selected':'' }} value="monthly">Monthly</option>
                                        <option {{ setting()->sitemap_frequency=='yearly'?'selected':'' }} value="yearly">Yearly</option>
                                        <option {{ setting()->sitemap_frequency=='never'?'selected':'' }} value="never">Never</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a  href="{{ route('admin.sitemap.dowload') }}"  class="btn btn-primary pull-right" > Tải Sitemap </a>
                                <button type="button" class="btn onSaveData btn-success pull-right m-r-10"> Cập nhật Sitemap </button>
                                <a target="_blank" href="{{ route('admin.sitemap.show') }}"  class="btn btn-info pull-right" > <i class="fa fa-eye"></i> </a>

                            </div>
                        </div>
                        <div class="callout" style="margin-top: 30px;background-color: #fff; border-color:#00c0ef;max-width: 600px;">
                            <h4>Cron Job</h4>
                            <p><strong>{{ route('admin.sitemap.cronjobUpdate') }}</strong></p>
                            <small>Với URL này, bạn có thể tự động cập nhật sơ đồ trang web của mình.</small>
                        </div>
                    </div>
                </div>
</div>
@endsection @section('runJS')
<script src="{{asset('assets/admin/seo/seo.js')}}?v={{ time() }}"></script>
<script>
	var seo = new seo();
	    seo.datas={
	        routes:{
	          update:"{{route('admin.sitemap.update')}}",
	        }
	    }
	    seo.init();
</script>@endsection

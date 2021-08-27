@extends('layouts.admin')
@section('admin')
<section class="content">
    <div class="container-fulld">
        <form value="{{setting()->id}}" action="{{route('admin.setting.socialite')}}" id="formAction" name="id">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Cấu hình đăng nhập mạng xã hội</h3>
                </div>
                <div class="card-body row" >
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Facebook</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group ">
                                    <label for="facebook_status" class=" col-form-label ">Trạng thái</label>
                                    <select type="text" class="form-control" name="facebook_status">
                                        <option  {{setting()->facebook_status=='off'?'selected':''}} value="off">Tắt</option>
                                        <option  {{setting()->facebook_status=='on'?'selected':''}} value="on">Bật</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="facebook_client_id" class=" col-form-label ">Facebook client id</label>
                                    <input type="text" class="form-control" name="facebook_client_id" placeholder="App ID ..." value="{{setting()->facebook_client_id}}" />
                                </div>
                                <div class="form-group ">
                                    <label for="facebook_client_secret" class=" col-form-label ">Facebook client secret </label>
                                    <input type="text" class="form-control" name="facebook_client_secret" placeholder="secret ... " value="{{setting()->facebook_client_secret}}" />
                                </div>
                                <div class="form-group ">
                                    <label for="facebook_redirect" class=" col-form-label ">Facebook redirect  (HomepageURL/oauth/facebook/callback)</label>
                                    <input type="text" readonly class="form-control" placeholder="..." name="facebook_redirect" placeholder=".." value="{{route('web.social.callback','facebook')}}" />
                                </div>
                            </div>
                            <div class="card-footer">
                                <button id="btnSaveFacebook" class="btn bg-navy btn-block">Lưu</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card  card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Google</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="google_status" class=" col-form-label ">Trạng thái</label>
                                    <select type="text" class="form-control" name="google_status">
                                        <option  {{setting()->google_status=='off'?'selected':''}} value="off">Tắt</option>
                                        <option  {{setting()->google_status=='on'?'selected':''}} value="on">Bật</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="google_client_id" class=" col-form-label text-danger">Google client id</label>
                                    <input type="text" class="form-control" placeholder="App ID ..."  name="google_client_id" value="{{setting()->google_client_id}}" />
                                </div>
                                <div class="form-group ">
                                    <label for="google_client_secret" class=" col-form-label text-danger">Google client secret </label>
                                    <input type="text" class="form-control" placeholder="secret ..." name="google_client_secret" value="{{setting()->google_client_secret}}" />
                                </div>
                                <div class="form-group ">
                                    <label for="google_redirect" class=" col-form-label text-danger">Google redirect (HomepageURL/oauth/google/callback) </label>
                                    <input type="text" readonly class="form-control" placeholder="...." name="google_redirect" value="{{route('web.social.callback','google')}}" />
                                </div>
                            </div>
                            <div class="card-footer">
                                <button id="btnSaveGoogle" class="btn bg-navy btn-block">Lưu</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Githup</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="github_status" class=" col-form-label ">Trạng thái</label>
                                    <select type="text" class="form-control" name="github_status">
                                        <option  {{setting()->github_status=='off'?'selected':''}} value="off">Tắt</option>
                                        <option  {{setting()->github_status=='on'?'selected':''}} value="on">Bật</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="github_client_id" class=" col-form-label text-danger">Github client id</label>
                                    <input type="text" class="form-control" placeholder="App ID ..."  name="github_client_id" value="{{setting()->github_client_id}}" />
                                </div>
                                <div class="form-group ">
                                    <label for="github_client_secret" class=" col-form-label text-danger">Github client secret </label>
                                    <input type="text" class="form-control" placeholder="secret ..." name="github_client_secret" value="{{setting()->github_client_secret}}" />
                                </div>
                                <div class="form-group ">
                                    <label for="github_redirect" class=" col-form-label text-danger">Github redirect (HomepageURL/oauth/github/callback) </label>
                                    <input type="text" readonly class="form-control" placeholder="...." name="github_redirect" value="{{route('web.social.callback','github')}}" />
                                </div>
                            </div>
                            <div class="card-footer">
                                <button id="btnSaveGithup" class="btn bg-navy btn-block">Lưu</button>
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
<script src="{{asset('assets/admin/setting/setting.js')}}?v={{uniqid()}}"></script>
<script>
   var setting = new setting();
   setting.datas={
   }
   setting.init();
</script>
@endsection

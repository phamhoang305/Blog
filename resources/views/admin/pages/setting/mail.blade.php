@extends('layouts.admin')
@section('admin')
<section class="content">
    <div class="container-fulld">
        <form value="{{setting()->id}}" action="{{route('admin.setting.mail')}}" id="formAction" name="id">
            <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">Cấu hình mail</h3>
                                        </div>
                                        <div class="card-body " >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_DRIVER</label>
                                                        <input type="text" class="form-control form-control-sm" name="MAIL_DRIVER" value="{{setting()->MAIL_DRIVER}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_HOST</label>
                                                        <input type="text" class="form-control form-control-sm" name="MAIL_HOST" value="{{setting()->MAIL_HOST}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_PORT</label>
                                                        <input type="text" class="form-control form-control-sm" name="MAIL_PORT" value="{{setting()->MAIL_PORT}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_FROM_ADDRESS</label>
                                                        <input type="text" class="form-control form-control-sm" name="MAIL_FROM_ADDRESS" value="{{setting()->MAIL_FROM_ADDRESS}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_FROM_NAME</label>
                                                        <input type="text" class="form-control form-control-sm" name="MAIL_FROM_NAME" value="{{setting()->MAIL_FROM_NAME}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_ENCRYPTION</label>
                                                        <input type="text" class="form-control form-control-sm" name="MAIL_ENCRYPTION" value="{{setting()->MAIL_ENCRYPTION}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_USERNAME</label>
                                                        <input type="text" class="form-control form-control-sm" name="MAIL_USERNAME" value="{{setting()->MAIL_USERNAME}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_PASSWORD</label>
                                                        <input type="text" class="form-control form-control-sm" name="MAIL_PASSWORD" value="{{setting()->MAIL_PASSWORD}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group ">
                                                                <label for="address" class=" col-form-label">MAIL_RECEIVE</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control form-control-sm" name="MAIL_RECEIVE" value="{{setting()->MAIL_RECEIVE}}" />
                                                                    <button type="button" id="testSenMail" class="btn btn-info btn-flat">Kiểm tra</button>
                                                                    <button type="button" id="saveMail" class="btn bg-navy btn-flat">Lưu</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <br>
                                                            <div class="form-group">
                                                            <div id="alertJSTestMail"></div>
                                                            </div>
                                                        </div>
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

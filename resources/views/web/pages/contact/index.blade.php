@extends('layouts.web')
@section('web')

<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-widget card-dark">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN LIÊN HỆ</h3>
                    <!-- /.user-block -->
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body " >
                        <div class="row">
                            <div class="col-md-8">
                                <form id="formAction" action="{{route('web.contact.sendContact')}}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (setting()->iframe_map)
                                                {!!setting()->iframe_map!!}
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="full_name" value="@if(Auth::check()){{user()->full_name}}@endif" id="full_name" placeholder="Họ và tên ... " class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="email" value="@if(Auth::check()){{user()->email}}@endif" id="email" placeholder="Email ... " class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea rows="5" name="body"  id="body" placeholder="Nội dung ... " class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="button" id="sendContact" class="btn btn-info btn-flat btn-block">Gủi</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-dark">
                                            <div class="card-header">
                                            <h3 class="card-title">Thông tin liên hệ</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <hr>
                                                <p class="text-muted">
                                                    <span><i class="fas fa-phone "></i>  : {{setting()->contact_phone}} </span>
                                                </p>
                                                <hr>
                                                <p class="text-muted">
                                                    <span><i class="fas fa-map-marker-alt "></i> : {{setting()->contact_address}}</span>
                                                </p>
                                                <hr>
                                                <p class="text-muted">
                                                    <span><i class="fas fa-pencil-alt "></i> : {{setting()->contact_mail}}</span>
                                                </p>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /.col-md-6 -->
        </div>
    </div>
<div class="modal" id="modalMath" >
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-body">
            <div class="form-group">
                <div class="alert alert-warning alert-dismissible">
                     Bạn có phải là con người không nếu phải thì : <span id="MathA">{{$MathA}}</span> <span id="MathType">{{$MathType}}</span> <span id="MathB">{{$MathB}}</span> = ?
                </div>
                <div id="alertJSConfirm"></div>
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Nhập kết quả" id="result" name="result"/>
            </div>
		</div>
        <div class="modal-footer">
			<button data-dismiss="modal" aria-label="Close" class="btn btn-danger" id="contact-button-cancel">Hủy bỏ</button>
			<button class="btn btn-dark" type="button" id="contact-button-confirm">Xác nhận</button>
        </div>
      </div>
    </div>
</div>
@endsection
@section('runJS')
<script src="{{asset('assets/web/contact/contact.js')}}?v={{time()}}"></script>
<script>
   var contact = new contact();
   contact.init();
</script>
@endsection

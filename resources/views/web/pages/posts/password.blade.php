@extends('layouts.web')
@section('web')
         <!-- Main content -->
        <div class="content">
            <div class="container card-category">
              <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card card-dark ">
                        <div class="card-header ">
                          <h3 class="card-title text-center"><i class="fa fa-lock"></i> Nhập mật khẩu </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="formPassword" action="{{ route('web.posts.password') }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control text-center" required placeholder="Nhập mật khẩu ..." name="password"/>
                                            <input type="hidden" class="form-control" required  placeholder="uniqid ..." value="{{$post->uniqid}}" name="uniqid"/>
                                        </div>
                                        <div class="form-group">
                                            <div id="alertJS"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" id="button-password" class="btn btn-block btn-info">Mở khóa</button>
                                            <a href="{{ url()->previous() }}" class="btn btn-block btn-danger"><i class="fas fa-undo"></i> Quay lại</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
         </div>
        </div>
@endsection
@section('runCSS')
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/codesample/prism.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/highlight/styles/monokai-sublime.min.css')}}">
@endsection
@section('runJS')
<script src="{{asset('assets/themes/plugins/codesample/prism.min.js')}}"></script>
<script src="{{asset('assets/themes/plugins/highlight/highlight.min.js')}}"></script>
<script src="{{asset('assets/web/single/single.js')}}?v={{ time() }}"></script>
<script>var single = new single();single.init();</script>
@endsection



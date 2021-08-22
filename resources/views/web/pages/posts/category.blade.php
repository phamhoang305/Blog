@extends('layouts.web')
@section('web')

          <!-- Main content -->
          <div class="content">
            <div class="container card-category">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header ">
                                    <h3 style="text-align: center" class="card-title "> <img src="{{ img_category($cate->cate_icon) }}" width="25" style="border-radius: 25px" class="" alt="{{ $cate->cate_name }}"> {{$cate->cate_name}}</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @include('web.pages.posts.includes.post-item')
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <div class="card-tools">
                                    {!! $posts->links() !!}
                                    </div>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                        </div>
                        <div class="col-lg-4 card-category">
                            @include('web.formControl.controlSidebar')
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
@endsection

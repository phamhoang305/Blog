@extends('layouts.web')
@section('web')

          <!-- Main content -->
          <div class="content">
            <div class="container card-category">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-detail card ">
                                <div class="card-body">
                                    <form  action="{{ route('web.search.index') }}">
                                        <div class="input-group ">
                                            <input type="text" placeholder="Nhập từ khóa để tìm kiếm .... " name="q" class="form-control">
                                            <span class="input-group-append">
                                            <button type="submit" class="btn btn-{{ raddomClass() }} btn-flat">Tìm kiếm</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-detail card">
                                <div class="card-header " style="">
                                    <h3 style="text-align: center" class="card-title "> <img src="{{ img_category($post->cate_icon) }}" width="25" style="border-radius: 25px" class="" alt="{{ $post->post_title }}"> {{$post->cate_name}}</h3>
                                </div>
                                <div class="card-header " style="">
                                    <h3 style="text-align: center" class="card-title "> <b>  {{$post->post_title}} </b></h3>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
@endsection
@section('runJS')

@endsection



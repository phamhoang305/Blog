@extends('layouts.web')
@section('web')
         <!-- Main content -->
        <div class="content">
            <div class="container ">
              <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark ">
                        <div class="card-header ">
                          <h3 class="card-title text-center"><i class="fa fa-search"></i> Tìm kiếm </h3>
                          <div class="card-tools d-none d-sm-inline-block">

                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('web.search.index') }}">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Tìm kiếm theo từ khóa ..." value="{{ $qSearch }}" name="q"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button class="btn btn-block btn-info"><i class="fa fa-search"></i> Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card card-dark ">
                        <div class="card-header ">
                          <h3 class="card-title text-center"><i class="fa fa-list"></i> Kết quả tìm kiếm @if(count($posts)>0) ({{ count($posts) }}) @endif </h3>
                          <div class="card-tools d-none d-sm-inline-block">

                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-1">
                            @include('web.pages.posts.includes.post-item')
                        </div>
                        <div class="card-footer ">
                            @if (count($posts)>0)

                                {!! $posts->links() !!}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
         </div>
        </div>
@endsection

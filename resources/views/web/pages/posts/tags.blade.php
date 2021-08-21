@extends('layouts.web')
@section('web')

          <!-- Main content -->
          <div class="content">
            <div class="container card-category">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card ">
                                <div class="card-header " style="">
                                    <h3 style="text-align: center" class="card-title "> <i class="fas fa-tags"></i> <b> {{ mb_strtoupper($tag->tag, "UTF-8") }}</b></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @isset($posts)
                                    @include('web.pages.posts.includes.post-item')
                                    @endisset

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <div class="card-tools">
                                        @isset($posts)
                                        {!! $posts->links() !!}
                                        @endisset
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

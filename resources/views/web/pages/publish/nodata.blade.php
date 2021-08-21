@extends('layouts.web')
@section('web')

          <!-- Main content -->
          <div class="content">
            <div class="container ">
              <div class="row">

                <div class="col-lg-8">
                    <div class="card card-danger card-outline">
                        <div class="card-header card-category">
                          <h3 class="card-title text-center">ĐỊNH LÀM GÌ ĐÓ</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="pl-2 pr-2 p-2">
                                <div class="callout callout-warning text-center">
                                    <h5> Không được nha tậm bậy rồi đấy  !</h5>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer ">



                          </div>
                        <!-- /.card-footer -->
                      </div>

                </div>
                <div class="col-lg-4 card-category">
                    @include('web.formControl.random-posts')
                    @include('web.formControl.top-authors',['_topAuthors'=>getTopAuthors(), 'headerTopAuth'=>true])

                </div>

                <!-- /.col-md-6 -->
              </div>

              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
@endsection

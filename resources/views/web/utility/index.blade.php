@extends('layouts.web')
@section('web')
          <div class="content">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card card-dark ">
                        <div class="card-header">
                          <h3 class="card-title text-center">CÔNG CỤ</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-lg-3 col-md-6">
                                  <!-- small box -->
                                  <div class="small-box bg-info">
                                    <div class="inner">
                                      <h3 class="tool">Css Gradien</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <a href="{{route('web.css_gradien.index')}}" class="small-box-footer">Xem chi tiết <i class="fas fa-css-right"></i></a>
                                  </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-sm-12 col-lg-3 col-md-6">
                                  <!-- small box -->
                                  <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3 class="tool">Jsx to Html</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <a href="{{route('web.htmltojsx.index')}}" class="small-box-footer">Xem chi tiết <i class="fas fa-css-right"></i></a>
                                  </div>
                                </div>

                                <div class="col-sm-12 col-lg-3 col-md-6">
                                  <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3 class="tool"> Xml to Json</h3>
                                    </div>
                                    <div class="icon">
                                      <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">Xem chi tiết <i class="fas fa-css-right"></i></a>
                                  </div>
                                </div>
                                <div class="col-sm-12 col-lg-3 col-md-6">
                                  <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="tool">Image to Base64</h3>
                                    </div>
                                    <div class="icon">
                                      <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">Xem chi tiết <i class="fas fa-css-right"></i></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                      </div>
                      <div class="card-footer">

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header">
                            <h3 class="card-title">Bình luận </h3>
                        </div>
                        <div class="card-body">
                                <div style="background-color: white;">
                                    <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#{{URL::current()}}" data-width="100%" data-lazy="true" data-numposts="10"></div>
                                </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
              </div>
            </div>
          </div>
@endsection
@section('runJS')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=2784474005206649&autoLogAppEvents=1" nonce="V2POithY"></script>
@endsection

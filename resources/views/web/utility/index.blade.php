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
                                <div class="col-sm-12 col-lg-4 col-md-4">
                                  <a href="{{route('web.css_gradien.index')}}">
                                  <div class="small-box bg-success p-2 bg-rand">
                                    <div class="inner text-center">
                                      <h5 class="tool">Css Gradien</h5>
                                    </div>
                                  </div>
                                  </a>
                                </div>
                                <!-- ./col -->
                                <div class="col-sm-12 col-lg-4 col-md-4">
                                  <!-- small box -->
                                  <a href="{{route('web.htmltojsx.index')}}">
                                    <div class="small-box bg-info p-2 bg-rand">
                                      <div class="inner text-center">
                                          <h5 class="tool">Jsx to Html</h5>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                                <div class="col-sm-12 col-lg-4 col-md-4">
                                  <a href="{{route('web.filetobase64.index')}}">
                                  <div class="small-box bg-danger p-2 bg-rand">
                                    <div class="inner text-center">
                                        <h5 class="tool">File to Base64</h5>
                                    </div>
                                  </div>
                                  </a>
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

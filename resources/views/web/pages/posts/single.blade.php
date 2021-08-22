@extends('layouts.web')
@section('web')
          <div class="content">
            <div class="container card-category">
                    <div class="row">
                        <div class="col-lg-8 single_loading">
                            <div class="card ">
                                <div class="skeleton skeleton-card-3"></div>
                                <div
                                class="skeleton skeleton-card-2"
                                style="
                                    --c-w: 100%;
                                    --lines: 5;
                                    --f-l-c: rgba(103,89,255,0.3);
                                    --s-l-c: rgba(54,216,175,0.3);
                                "
                                ></div>
                                <div class="skeleton skeleton-line" style="--lines: 5;--c-w: 100%;"></div>
                                <div
                                class="skeleton skeleton-list"
                                style="
                                    --lines: 5;
                                    --c-w: 100%;
                                "
                                ></div>
                            </div>
                        </div>
                        <div class="col-lg-8 single_loadingDone" style="display: none">
                            <div class="card-detail card ">
                                <div class="card-header">
                                    <div class="p-3">
                                        @include('web.formControl.top-authors',['_topAuthors'=>$user, 'headerTopAuth'=>false])
                                    </div>
                                </div>
                                <div class="card-header" style="">
                                    <h3 style="text-align: center;font-size: 12pt;" class="card-title ">
                                        <img src="{{ img_category($post->cate_icon) }}"
                                        width="25" style="border-radius: 25px" class="" alt="{{ $post->post_title }}">
                                        {{$post->cate_name}}
                                    </h3>
                                </div>
                                <div class="card-header" style="">
                                    <h4 style="text-align: center;font-size: 12pt" class="card-title ">  {{$post->post_title}} </h4>
                                </div>
                                <div class="card-body p-3">
                                    <div class="post-share">
                                        <ul class="share-box">
                                        <li class="share-li-lg">
                                            <a href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-lg facebook">
                                                <i class="fab fa-facebook-f"></i>
                                                <span>Facebook</span>
                                            </a>
                                        </li>
                                        <li class="share-li-lg">
                                            <a href="javascript:void(0)" onclick="window.open('https://twitter.com/share?url={{URL::current()}};text={{ $post->post_title }}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-lg twitter">
                                                <i class="fab fa-twitter"></i>
                                                <span>Twitter</span>
                                            </a>
                                        </li>
                                        <li class="share-li-sm">
                                            <a href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-sm facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li class="share-li-sm">
                                            <a href="javascript:void(0)" onclick="window.open('https://twitter.com/share?url={{URL::current()}};text={{ $post->post_title }}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-sm twitter">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-sm linkedin">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <li class="li-whatsapp">
                                            <a href="https://api.whatsapp.com/send?text={{ $post->post_title }} - {{URL::current()}}" class="social-btn-sm whatsapp" target="_blank">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" onclick="window.open('http://pinterest.com/pin/create/button/?url={{URL::current()}};media={{URL::current()}}{{$post->post_image}}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-sm pinterest">
                                                <i class="fab fa-pinterest"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" onclick="window.open('http://www.tumblr.com/share/link?url={{URL::current()}};title={{ $post->post_title }}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-sm tumblr">
                                                <i class="fab fa-tumblr"></i>
                                            </a>
                                        </li>
                                        </ul>
                                    </div>
                                </div>
                                @if ($post->post_des)
                                <div class="card-body p-3">
                                    <div class="post-content">
                                        {{$post->post_des}}
                                    </div>
                                </div>
                                @endif
                                @if($post->thumbnail!=NULL)
                                    <div class="card-body p-3 text-center">
                                            <img class="img-fluid img-thumbnail" src="{{img_post($post->thumbnail)}}" alt="{{$post->post_title}}">
                                    </div>
                                @endif
                                <div class="card-body p-3">
                                    @if (getAds('sidbar_header'))
                                    <div class="form-group">
                                        {!! getAds('post_header') !!}
                                    </div>
                                    @endif
                                    <div class="post-content" id="post_content">
                                        {!!($post->post_content)!!}
                                    </div>
                                    @if (getAds('post_footer'))
                                    <div class="form-group">
                                        {!! getAds('post_footer') !!}
                                    </div>
                                    @endif
                                </div>
                                <!-- /.card-body -->
                                <div class="card-header text-center">
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <div class="card card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" id="comment-facebook-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Bình luận Facebook</a>
                                        </li>
                                        <li class="nav-item"> <a class="nav-link " id="comment-default-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Bình luận @if (($post->CountComments)>0) ({{ ($post->CountComments) }}) @endif</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade show active" style="background-color: white;" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="comment-facebook-tab">
                                            <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#{{URL::current()}}" data-width="100%" data-lazy="true" data-numposts="10"></div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="comment-default-tab">
                                            @comments(['model' => $post,'perPage'=>20,'maxIndentationLevel' => 2])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            @include('web.formControl.controlSidebar')
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <div id="fb-root"></div>
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
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=2784474005206649&autoLogAppEvents=1" nonce="V2POithY"></script>
@endsection



<div class="row">
    <div class="col-md-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach (sliderPosts(5) as $key=> $item)
                 <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="{{$key==0?'active':''}}"></li>
                 @endforeach
            </ol>
            <div class="carousel-inner ">
                @foreach (sliderPosts(5) as $key=> $item)
                    @php
                    $item->CountComments = $item->CountComments==null?0:$item->CountComments;
                    // if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
                    // $url = route('web.posts.index',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
                    // }else{
                    //     $url = route('web.posts.index',[$item->cate_slug,$item->post_slug]);
                    // }
                    $url = route('web.posts.index',[$item->post_slug]);
                    if($item->post_image_min!=NULL){
                        if ( file_exists(public_path($item->post_image_min))&&$item->post_image_min!=""){
                            $post_image = $item->post_image_min;
                        }else{
                            $post_image = asset('assets/images/defaults/image-home.gif');
                        }
                    }else{
                        $post_image = asset('assets/images/defaults/image-home.gif');
                    }
                    if($item->avatar==''){
                        $item->avatar = "https://www.gravatar.com/avatar/".md5($item->email)."jpg?s=64";
                    }
                    @endphp
                    <div class="carousel-item {{$key==0?'active':''}}">
                        <div class="">
                            <div class="card">
                                <div class="card-header">
                                <div class="user-block">
                                    <img src="{{ asset('assets/images/defaults/loading.gif') }}?v={{uniqid()}}" data-src="{{$item->avatar}}" alt="{{$item->full_name}}" class="img-size-50 img-circle img-thumbnail">
                                    <span class="username"><a href="{{ route('web.user.index',$item->username)}}">{{$item->full_name}}</a></span>
                                    <span class="description">
                                        {{ helper_date_format($item->created_at) }}&nbsp;-&nbsp;{{ formatted_hour($item->created_at)}}
                                        <i class="fa fa-comment text-success"></i>&nbsp;{{$item->CountComments}}
                                        &nbsp;<i class="fa fa-eye text-info"></i>&nbsp;{{$item->post_view}}
                                    </span>
                                </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" >
                                    <a href="{{ $url }}">
                                    <img class="img-fluid pad " src="{{ asset('assets/images/defaults/loadlist2.gif') }}" data-src="{{ $post_image }}" alt="{{$item->post_title}}">
                                    <div class="body-post ">
                                        <b class="">{{$item->post_title}}</b>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-custom-icon" aria-hidden="true">
                <i class="fas fa-chevron-left"></i>
              </span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-custom-icon" aria-hidden="true">
                <i class="fas fa-chevron-right"></i>
              </span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

</div>

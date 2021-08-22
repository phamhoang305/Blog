
@if (count($posts)>0)
<div id="listLoading" data-count="{{count($posts)}}" class="listLoading">
</div>
@endif
@if (count($posts)>0)
<div id="listLoadingDone" class="listLoadingDone" style="display: none">
<ul class="products-list product-list-in-card ">
    @foreach ($posts as $item)
        @php
        $url = route('web.posts.index',$item->post_slug);
        // if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
        // $url = route('web.posts.index',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
        // }else{
        //     $url = route('web.posts.index',[$item->cate_slug,$item->post_slug]);
        // }
        if($item->thumbnail!=NULL){
            if ( file_exists(public_path($item->thumbnail))&&$item->thumbnail!=""){
                $post_image = $item->thumbnail;
            }else{
                $post_image = asset('assets/images/defaults/photos-icon.png');
            }
        }else{
            $post_image = asset('assets/images/defaults/photos-icon.png');
        }
        @endphp
    <li class="item">
        <div class="product-img">
            @php
                if($item->avatar==''){
                    $item->avatar = "https://www.gravatar.com/avatar/".md5($item->email)."jpg?s=64";
                }
            @endphp

        <img
        {{-- src="{{ asset('assets/images/defaults/loading.gif') }}" --}}
        src="{{$post_image}}" alt="{{$item->full_name}}" class="img-size-50 img-thumbnail">
        </div>
        <div class="product-info">
            <a href="{{ $url }}" class="product-title">{{$item->post_title}}
                <span class="badge badge-default float-right text-muted"> {{ helper_date_format($item->created_at) }}&nbsp;-&nbsp;{{ formatted_hour($item->created_at)}}</span><br>
                <span class="badge badge-{{raddomClass()}} float-right">{{$item->cate_name}} </span>
                <span class="product-description">
                    <span title="{{$item->full_name}} đã đăng {{time_Ago(date_time($item->created_at))}}" class="badge badge-default float-left">{{$item->full_name}} đã đăng {{time_Ago(date_time($item->created_at))}}
                        |  {{$item->CountComments}} <i class="fas fa-comments"></i>
                        | {{$item->post_view}}  <i class="fas fa-eye"></i>
                    </span><br>

                </span>
            </a>
        </div>
    </li>
    @endforeach
</ul>
<div class="text-center">
    {!! $posts->links() !!}
</div>
</div>
@else
<div class="">
<div class="callout callout-warning text-center">
    <h6>Không có dữ liệu !</h6>
</div>
</div>
@endif





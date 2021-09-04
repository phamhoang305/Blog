

<li class="item">
    <div class="product-img">
        <img src="{{img_post($item->thumbnail)}}" alt="{{$item->full_name}}" class="img-size-50 profile-user-img">
    </div>
    <div class="product-info">
        <a href="{{ route('web.posts.index',$item->post_slug) }}" class="product-title">{{$item->post_title}}
            <span class="badge badge-default float-right text-muted"> {{ helper_date_format($item->created_at) }}&nbsp;-&nbsp;{{ formatted_hour($item->created_at)}}</span><br>
            <span class="badge badge-{{raddomClass()}} float-right">{{$item->cate_name}} </span>
            <span class="product-description pt-2" data-toggle="tooltip" data-placement="bottom" title="{{$item->full_name}} đã đăng {{time_Ago(date_time($item->created_at))}}">
                <span class="badge badge-default float-left">{{$item->full_name}} đã đăng {{time_Ago(date_time($item->created_at))}}
                    |  {{$item->CountComments}} <i class="fas fa-comments"></i>
                    | {{$item->post_view}}  <i class="fas fa-eye"></i>
                </span><br>
            </span>
        </a>
    </div>
</li>









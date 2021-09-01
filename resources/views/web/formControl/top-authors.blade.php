@php
    $header_TopAuth = true;
    $footer_topAuth = false;
@endphp
@isset($headerTopAuth)
    @php
    $header_TopAuth = $headerTopAuth;
    @endphp
@endisset
@isset($footerTopAuth)
    @php
    $footer_topAuth = $footerTopAuth;
    @endphp
@endisset
@if($header_TopAuth)
<div class="card ">
    <div class="card-header">
        <h3 class="card-title text-center"><a href="{{route('web.author.index')}}"><b>CÁC TÁC GIẢ HÀNG ĐẦU</b></a></h3>
    </div>
    <div class="card-body">
@endif
    @if ($_topAuthors&&count($_topAuthors)>0)
        <ul class="products-list product-list-in-card ">
            @foreach ($_topAuthors as $item)
            @php
            if($item->avatar==''){
                $item->avatar = "https://www.gravatar.com/avatar/".md5($item->email)."jpg?s=64";
            }
            @endphp
            <li class="item" id="itemAuthID{{ $item->userID }}">
                <div class="product-img">
                    <img src=" {{ $item->avatar }}" alt="{{ $item->full_name }}" class="img-size-50 profile-user-img">
                </div>
                <div class="product-info">
                    <a href="{{ route('web.user.index',$item->username)  }}" class="product-title">
                    {{ $item->full_name }}
                    </a>
                    @include('web.formControl.top-authors-button',['item'=>$item])
                    <span class="product-description pt-1">
                    <span class="badge badge-danger float-left" title="Bài viết" > <i class="fas fa-user-edit"></i> {{$item->CountPosts==null?0:$item->CountPosts}} </span>
                    <span class="badge badge-primary float-left"  title="Người theo dõi"> <i class="fas fa-user-plus"></i> <span id="follow-{{$item->userID}}"> {{$item->CountFollows==null?0:$item->CountFollows}} </span> </span>
                    <span class="badge badge-warning float-left"  title="Đang theo dõi"> <i class="fas fa-users"></i> <span id="following-{{$item->userID}}"> {{$item->CountFollowing==null?0:$item->CountFollowing}} </span> </span>

                </span>
                </div>
            </li>
            @endforeach

        </ul>
        @if($footer_topAuth)
            </div>
            <div class="card-footer">
                {!! $_topAuthors->links() !!}
            </div>
        </div>
        @endif
    @else
        <div class="callout callout-warning text-center">
            <h5>Không có dữ liệu !</h5>
        </div>
    @endif


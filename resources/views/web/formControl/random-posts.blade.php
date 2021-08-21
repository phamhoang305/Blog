
<div class="card ">
    <div class="card-header ">
        <h3 class="card-title text-center">BÀI VIẾT NGẪU NHIÊN</h3>
    </div>
    <div class="card-body">
        <ul class="products-list product-list-in-card ">
            @foreach (randomPosts(5) as $item)
                @include('web.pages.home.includes.post-item',['item'=>$item])
            @endforeach
        </ul>
    </div>
</div>

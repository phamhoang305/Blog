

<div class="card ">
    <div class="card-header ">
        <h3 class="card-title text-center">BÀI VIẾT XEM NHIỀU</h3>
    </div>
    <div class="card-body" id="getPostViewTop">
        <ul class="products-list product-list-in-card ">
            @foreach (getPostViewTop() as $item)
                @include('web.pages.home.includes.post-item',['item'=>$item])
            @endforeach
        </ul>
    </div>
</div>



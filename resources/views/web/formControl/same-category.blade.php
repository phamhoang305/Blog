
@if (count(sameCategory($_cate_slug,$_postID))>0)
<div class="card  ">
    <div class="card-header ">
        <h3 class="card-title text-center">CÙNG CHUYÊN MỤC</h3>
    </div>
    <div class="card-body" id="sameCategory">
        <ul class="products-list product-list-in-card ">
            @foreach (sameCategory($_cate_slug,$_postID) as $item)
            @include('web.pages.home.includes.post-item',['item'=>$item])
            @endforeach
        </ul>
    </div>
</div>
@endif


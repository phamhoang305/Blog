
@if (count($posts)>0)
<div id="listLoading" data-count="{{count($posts)}}" class="listLoading">
</div>
@endif
@if (count($posts)>0)
<div id="listLoadingDone" class="listLoadingDone" style="display: none">
<ul class="products-list product-list-in-card ">
    @foreach ($posts as $item)
        @include('web.pages.home.includes.post-item')
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





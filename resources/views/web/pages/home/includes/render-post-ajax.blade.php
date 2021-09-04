@foreach ($posts as $item)
    @include('web.pages.home.includes.post-item',['item'=>$item])
@endforeach

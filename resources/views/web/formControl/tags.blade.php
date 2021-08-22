
<div class="card ">
    <div class="card-header ">
        <h3 class="card-title text-center"><i class="fas fa-tags"></i> TAGS</h3>
    </div>
    <div class="card-body" id="getTags">
            @foreach (getTags(5) as $item)
                <a href="{{ route('web.tag.post',$item->tag_slug) }}" class="btn btn-outline-{{ raddomClass() }} m-1  btn-flat">{{ mb_strtoupper($item->tag, "UTF-8") }}</a>
            @endforeach
    </div>
</div>

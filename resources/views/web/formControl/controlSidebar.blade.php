<div class="controlSidebar" id="controlSidebar">
<div class="search_loading"></div>
<div class="card search_loadingDone" style="display: none">
    <div class="card-body">
       <form  action="{{ route('web.search.index') }}">
        <div class="input-group ">
            <input type="text" placeholder="Nhập từ khóa để tìm kiếm .... " name="q" class="form-control">
            <span class="input-group-append">
              <button type="submit" class="btn btn-{{ raddomClass() }} btn-flat">Tìm kiếm</button>
            </span>
        </div>
        </form>
    </div>
</div>
@if (getAds('sidbar_header'))
<div class="card">
    <div class="card-body">
    {!! getAds('sidbar_header') !!}
    </div>
</div>
@endif
@isset($viewBlade)
    @if ($viewBlade=='single')
        <div id="sameCategory">
        </div>
    @endif
@endisset
@if (setting()->sidebar_post_random_status=='on')
    <div id="randomPosts">
        {{-- @include('web.formControl.random-posts') --}}
    </div>
@endif
@if (getAds('sidbar_center'))
<div class="card">
    <div class="card-body">
    {!! getAds('sidbar_center') !!}
    </div>
</div>
@endif
@if (setting()->sidebar_top_postview_status=='on')
    <div id="postTopView">
        {{-- @include('web.formControl.post-top-view') --}}
    </div>
 @endif
@if (setting()->sidebar_tag_status=='on')
    <div id="tags">
        {{-- @include('web.formControl.tags') --}}
    </div>
@endif
@if (setting()->user_login_register_status =='on'&&setting()->sidebar_top_author_status=='on')
    <div id="authors">
    </div>
@endif
@if (getAds('sidbar_footer'))
<div class="card">
    <div class="card-body">
    {!! getAds('sidbar_footer') !!}
    </div>
</div>
@endif
</div>


<div class="header-top bg-danger">
    <nav class="main-header navbar navbar-expand-md top-bg navbar-dark navbar-danger">
        <div class="container">
                <div class="header-top-menu">
                    <ul>
                        <li><a href="{{route('web.contact.index')}}" class="">Liên hệ</a></li>
                        <li><a href="{{route('web.tools.index') }}" class="">Công cụ</a></li>
                        <li><a href="{{route('web.quiz.category.view') }}" class="">Thi trắc nghiệm</a></li>
                        @foreach (getPagesHeader() as $item)
                            @if ($item->page_link)
                            <li><a href="{{$item->page_link}}"  {{$item->page_link_type=='newPage'?('target="_blank"'):''}}>{{ mb_strtolower($item->post_title,'utf-8') }}</a>
                            @else
                            <li><a href="{{route('web.posts.index',$item->post_slug)}}" >{{ mb_strtolower($item->post_title,'utf-8') }}</a>
                            @endif
                        @endforeach
                    </ul>
                </div>
        </div>
    </nav>
</div>
<div class="header-footer">
<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{route('web.home.index')}}" class="nav-link"> <i class="fas fa-home"></i> TRANG CHỦ</a>
            </li>
          @foreach (getMenu() as $item)
          <li class="nav-item dropdown">
                <a id="{{$item->id}}" href="{{$item->url}}"
                    @if (count($item->sub_menu)>0)data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"@endif
                    class="nav-link  @if (count($item->sub_menu)>0) dropdown-toggle @endif">
                    {{ $item->cate_name }}
                </a>
                @if (count($item->sub_menu)>0)
                    <ul aria-labelledby="{{$item->id}}" class="dropdown-menu border-0 shadow">
                        @foreach ($item->sub_menu as $sub)
                        @if ($sub->cate_posts>0)
                            <li><a href="{{$sub->url}}" class="dropdown-item">{{$sub->cate_name}} </a></li>
                        @endif
                        @endforeach
                    </ul>
                @endif
          </li>
          @endforeach
        </ul>
      </div>
      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        @if (Auth::check())
        @php
        $avatar = user()->avatar;
        if($avatar==''){
            $avatar = "https://www.gravatar.com/avatar/".md5(user()->email)."jpg?s=64";
        }
        @endphp
        @if (setting()->user_add_post_status=='on'||Auth::user()->type=='userAdminDefault'||Auth::user()->type=='userAdminCreate')
            <li class="nav-item mytooltip" title="Đóng góp bài viết">
                <a class="nav-link"  href="{{ route('web.publish.add') }}" role="button">
                    <i class="fas fa-plus-circle"></i> Viết bài</a>
                </a>
            </li>
        @endif
        <li class="nav-item dropdown" id="dropdownSubMenu1">
            <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
                <i class="fas fa-users"></i> {{ Auth::user()->full_name }}
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                <li><a href="{{ route('web.user.index',Auth::user()->username)  }}" class="dropdown-item"><i class="fas fa-user"></i> Hô sơ cá nhân </a></li>
                @if (setting()->user_add_post_status=='on'||Auth::user()->type=='userAdminDefault'||Auth::user()->type=='userAdminCreate')
                <li><a href="{{route('web.me.public')}}" class="dropdown-item"><i class="fas fa-rss"></i> Nội dung của tôi </a></li>
                @endif
                @if (Auth::user()->type=='userAdminDefault'||Auth::user()->type=='userAdminCreate')
                    <li><a target="_blank" href="{{route('admin.dashboard.view')}}" class="dropdown-item"><i class="fas fa-tachometer-alt"></i> Bản điều khiển </a></li>
                @endif
                <li><a href="{{route('web.quiz.history')}}" class="dropdown-item"><i class="fas fa-history"></i> Lịch sử làm bài </a></li>
                <li class="dropdown-divider"></li>
                <li><a href="{{ route('web.auth.logout') }}"  class="button-logout dropdown-item"><i class="fas fa-sign-out-alt"></i> Đăng xuất </a></li>
            </ul>
          </li>
        @else
            @if (setting()->user_login_register_status=='on')
            <li class="nav-item">
                <a class="nav-link btn-show-login" href="javascript:void(0)" role="button">
                    <i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                </a>
            </li>
            @endif
        @endif
      </ul>
    </div>
</nav>
</div>
  <div class="modal fade" id="searchModal"   >
	<div class="modal-dialog  modal-dialog-centered" role="document">
		<div class="modal-content">
      <div class="modal-body">
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
  </div>
</div>

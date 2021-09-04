<div class="toolbar foo_tab_menu foo_tab_menu-labels hidden-md hidden-lg non-resp is767" style="background-color:#fff; ">
	<div class="toolbar-inner">
        {{-- <a  class="tab-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-list icon" style="color:#a676b8;"></i>

			<span class="foo_tab_menu-label">Danh mục</span>
		</a> --}}
		<a href="{{ route('web.home.index') }}" class="tab-link"> <i class="fa fa-home icon" style="color:#ed686e;"></i>
			<span class="foo_tab_menu-label">Trang chủ</span>
		</a>
		{{-- <a href="" class="tab-link"> <i class="fas fa-rss-square icon" style="color:#3b5998"></i>
			<span class="foo_tab_menu-label">Tin tức</span>
		</a> --}}

		<a href="{{ route('web.contact.index') }}" class="tab-link"> <i class="fa fa-clipboard-list icon" style="color:#ff5419;"></i>
			<span class="foo_tab_menu-label">Liên hệ</span>
		</a>
        <a data-toggle="modal" data-target="#searchModal" href="javascript:void(0)" class="tab-link"> <i class="fa fa-search icon" style="color:#ff5419;"></i>
			<span class="foo_tab_menu-label">Tìm kiếm</span>
		</a>

        @if (Auth::check()==true)
        <a href="{{ route('web.auth.logout') }}" id="_logout" class="tab-link button-logout">
            <i class="fas fa-sign-out-alt icon" style="color:#a676b8;"></i>
			<span class="foo_tab_menu-label">Đăng xuất</span>
		</a>
        @else
            @if (setting()->user_login_register_status=='on')
                <a href="javascript:void(0)" class="tab-link show-_login btn-show-login"> <i class="fa fa-user-circle icon" style="color:#a676b8;"></i>
                    <span class="foo_tab_menu-label">Đăng nhập</span>
                </a>
            @endif
        @endif
	</div>
</div>
<a id="back-to-top" href="javascript:void(0)" class="btn btn-danger back-to-top" role="button" aria-label="Scroll to top">
    <i class="fas fa-chevron-up"></i>
</a>


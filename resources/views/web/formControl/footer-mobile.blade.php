<div class="toolbar foo_tab_menu foo_tab_menu-labels hidden-md hidden-lg non-resp is767" style="background-color:#fff; ">
	<div class="toolbar-inner">
		<a href="{{ route('web.home.index') }}" class="tab-link"> <i class="fa fa-home icon" style="color:#ed686e;"></i>
			<span class="foo_tab_menu-label">Trang chủ</span>
		</a>
		<a href="" class="tab-link"> <i class="fas fa-rss-square icon" style="color:#3b5998"></i>
			<span class="foo_tab_menu-label">Tin tức</span>
		</a>
		<a href="" class="tab-link"> <i class="fa fa-award icon" style="color:#ff5419;"></i>
			<span class="foo_tab_menu-label">Đăng tin</span>
		</a>
		<a href="{{ route('web.contact.index') }}" class="tab-link"> <i class="fa fa-clipboard-list icon" style="color:#ff5419;"></i>
			<span class="foo_tab_menu-label">Liên hệ</span>
		</a>

        @if (Auth::check()==true)
        <a href="{{ route('web.auth.logout') }}" id="_logout" class="tab-link button-logout">
            <i class="fas fa-sign-out-alt icon" style="color:#a676b8;"></i>
			<span class="foo_tab_menu-label">Đăng xuất</span>
		</a>
        @else
        <a href="{{ route('web.auth.login') }}" class="tab-link show-_login"> <i class="fa fa-user-circle icon" style="color:#a676b8;"></i>
			<span class="foo_tab_menu-label">Đăng nhập</span>
		</a>
        @endif




	</div>
</div>

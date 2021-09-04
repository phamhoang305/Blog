<nav class="main-header navbar navbar-expand navbar-dark navbar-light dropdown-legacy border-bottom-0 text-sm">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a target="_blank" href="{{ route('web.home.index') }}" class=""><button class="btn btn-info btn-sm bg-color"><i class="fa fa-eye"></i> Xem website</button></a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          @if (Auth::check())
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <i class="fa fa-user-circle"></i> <span class="d-none d-sm-inline-block">&nbsp; {{ Auth::user()->full_name }}</span>
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
              <li><a href="{{ route('web.user.index',Auth::user()->username)  }}" class="dropdown-item"><i class="fas fa-user"></i> Hô sơ cá nhân </a></li>
              <li><a href="{{route('web.me.public')}}" class="dropdown-item"><i class="fas fa-rss"></i> Nội dung của tôi </a></li>
              <li class="dropdown-divider"></li>
              <li><a href="{{ route('web.auth.logout') }}"  class="button-logout dropdown-item"><i class="fas fa-sign-out-alt"></i> Đăng xuất </a></li>
            </ul>
          </li>
          @else
            <li class="nav-item">
              <a class="nav-link"  href="{{ route('web.auth.login') }}" role="button">
                <i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
            </li>
          @endif
        </ul>
</nav>

<aside  class="main-sidebar sidebar-dark-info elevation-1">
    <!-- Brand Logo -->
    <a href="{{route('web.home.index')}}" class="brand-link text-center">
      <span id="sidebarDarkmode" class="brand-text font-weight-{{getDarkMode()=='on'?'dark':'light'}}">{{ mb_strtoupper(setting()->name, "UTF-8") }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="menu-open-new nav-item">
                <a href="{{ route('web.home.index') }}/" class="nav-link">
                    <img src="{{ asset('assets/images/defaults/loading.gif') }}" data-src="{{ asset('assets/images/defaults/home-photos-icon.png') }}" height="25" width="25" style="border-radius: 25px" class="img-thumbnail" alt="Trang chủ">
                  <p>
                     TRANG CHỦ
                  </p>
                </a>

            </li>
            <li class="nav-header bg-{{ raddomClass(true) }}">
                <img src="{{ asset('assets/images/defaults/loading.gif') }}" data-src="{{ asset('assets/images/defaults/kienthuc.png') }}" height="25" width="25" style="border-radius: 25px" class="img-thumbnail" alt="Kiến thức">
                 CHIA SẼ
            </li>
            @foreach (getMenu() as $item)
            <li class="nav-item   menu-open-new  @if (count($item->sub_menu)>0) has-treeview @endif">
                <a href="{{$item->url}}" class="nav-link">
                <p>
                    <img src="{{ asset('assets/images/defaults/loading.gif') }}" data-src="{{ $item->cate_icon }}" height="25" width="25" style="border-radius: 25px" class="img-thumbnail" alt="{{ $item->cate_name }}">
                    {{ $item->cate_name }}
                    @if (count($item->sub_menu)>0) <i class="right fas fa-angle-left"></i> @endif
                </p>
                </a>
                @if (count($item->sub_menu)>0)
                <ul class="nav nav-treeview">
                    @foreach ($item->sub_menu as $sub)
                        @if ($sub->cate_posts>0)
                        <li class="nav-item menu-open-new">
                            <a href="{{$sub->url}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{$sub->cate_name}}</p>
                            </a>
                        </li>
                        @endif
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
            <li class="nav-header bg-{{ raddomClass(true) }}">
                <img src="{{ asset('assets/images/defaults/loading.gif') }}" data-src="{{ asset('assets/images/defaults/photos-icon.png') }}" height="25" width="25" style="border-radius: 25px" class="img-thumbnail" alt="Tiện ích">
                TIỆN ÍCH
            </li>
            <li class="menu-open-new nav-item">
                <a href="{{ route('web.css_gradien.index') }}" class="nav-link">
                    <img src="{{ asset('assets/images/defaults/loading.gif') }}" data-src="{{ asset('assets/images/defaults/css_gradient.photos-icon.png') }}" height="25" width="25" style="border-radius: 25px" class="img-thumbnail" alt="CSS-GRADIENT">
                <p>
                    CSS-GRADIENT
                </p>
                </a>
            </li>
            <li class="menu-open-new nav-item">
                <a href="{{route('web.htmltojsx.index')}}" class="nav-link">
                    <img src="{{ asset('assets/images/defaults/loading.gif') }}" data-src="{{ asset('assets/images/defaults/htmltojsx.png') }}" height="25" width="25" style="border-radius: 25px" class="img-thumbnail" alt="CSS-GRADIENT">
                    <p>
                        HTML TO JSX
                    </p>
                </a>
            </li>

        </ul>
      </nav>

    </div>
  </aside>

<aside class="main-sidebar sidebar-dark-admin elevation-4 ">
    <!-- Brand Logo -->
    <a href="{{route('web.home.index')}}" class="brand-link text-center">
      <span class="brand-text font-weight-dark">{{ setting()->name }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="menu-open-new nav-item">
                <a href="{{ route('admin.dashboard.view') }}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                     Bản điều khiển

                  </p>
                </a>
            </li>
            @if (checkRole('category.view'))
                <li class="menu-open-new   nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Danh mục
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="menu-open-new nav-item">
                        <a href="{{ route('admin.category.parent.view') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Danh mục cha</p>
                        </a>
                    </li>
                    <li class="menu-open-new nav-item">
                        <a href="{{ route('admin.category.sub.view') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Danh mục con</p>
                        </a>
                    </li>

                    </ul>
                </li>
            @endif
            @if (checkRole('page.view')||checkRole('page.add'))
            <li class="menu-open-new  nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                     Trang
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                @if (checkRole('page.add'))
                  <li class="menu-open-new nav-item">
                    <a href="{{route('admin.page.add') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Thêm trang mới</p>
                    </a>
                  </li>
                @endif
                @if (checkRole('page.view'))
                  <li class="menu-open-new nav-item">
                    <a href="{{route('admin.page.view') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tất cả trang</p>
                    </a>
                  </li>
                @endif
                </ul>
            </li>
            @endif
            @if (checkRole('post.add')||checkRole('post.public')||checkRole('post.draft')||checkRole('post.lock')||checkRole('post.trash'))
            @if (checkRole('post.add'))
            <li class="nav-item  menu-open-new ">
                <a href="{{ route('admin.post.add') }}" class="nav-link bg-danger">
                    <i class="nav-icon fas fa-plus-circle"></i>
                    <p>Viết bài mới</p>
                  </a>
            </li>
            @endif
            <li class="menu-open-new menu-open nav-item">
                <a href="" class="nav-link">
                    <i class="fab fa-blogger nav-icon"></i>
                  <p>
                     Bài viết
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                @if (checkRole('post.public'))
                  <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.post.public') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Công bố</p>
                      <span class="badge badge-success right">{{ $shareAdmin->posts_public }}</span>
                    </a>
                  </li>
                @endif
                @if (checkRole('post.draft'))
                  <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.post.draft') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Nháp</p>
                      <span class="badge badge-dark right">{{ $shareAdmin->posts_draft }}</span>
                    </a>
                  </li>
                @endif
                @if (checkRole('post.approve'))
                <li class="nav-item menu-open-new">
                    <a href="{{route('admin.post.approve')}}" class="nav-link">
                      <i class="fas fa-check nav-icon"></i>
                      <p> Chờ duyệt</p>
                      <span class="badge badge-warning right">{{ $shareAdmin->posts_approve}}</span>
                    </a>
                </li>
                @endif
                @if (checkRole('post.lock'))
                  <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.post.lock') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Khóa</p>
                      <span class="badge badge-info right">{{ $shareAdmin->posts_lock }}</span>
                    </a>
                  </li>
                @endif
                @if (checkRole('post.trash'))
                  <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.post.trash') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Thùng rác</p>
                      <span class="badge badge-danger right">{{ $shareAdmin->posts_trash }}</span>
                    </a>
                  </li>
                @endif
                </ul>
            </li>
            @endif
            @if (checkRole('quiz.testcategory.view'))
                <li class="nav-item  menu-open-new ">
                    <a href="{{ route('admin.quiz.testcategory.view') }}" class="nav-link bg-info">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Hệ thống trắc nghiệm</p>
                    </a>
                </li>
            @endif
            @if (checkRole('contact.view'))
            <li class="menu-open-new nav-item">
                <a href="{{ route('admin.contact.view') }}" class="nav-link">
                    <i class="nav-icon fas fa-mail-bulk"></i>
                  <p>
                     Tin nhắn liên hệ
                  </p>
                  <span class="badge badge-info right">{{ $shareAdmin->contact }}</span>
                </a>
            </li>
            @endif
            @if (checkRole('comment.view'))
            <li class="menu-open-new nav-item">
                <a href="{{ route('admin.comment.view') }}" class="nav-link">
                    <i class="nav-icon fas fa-comment"></i>
                  <p>
                     Quản lý bình luận
                  </p>
                </a>
            </li>
            @endif
            @if (checkRole('user.view')||checkRole('user.add'))
            <li class="menu-open-new  nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Người dùng
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (checkRole('user.add'))
                  <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.user.add') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Thêm người dùng</p>
                    </a>
                  </li>
                  @endif
                  @if (checkRole('user.view'))
                  <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.user.view') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tất cả người dùng</p>
                    </a>
                  </li>
                  @endif
                </ul>
            </li>
            @endif
            @if (checkRole('sitemap.view'))
            <li class="nav-item menu-open-new">
                <a href="{{ route('admin.sitemap.view') }}" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                Công cụ SEO
                </p>
                </a>
            </li>
            @endif
            @if (checkRole('ad.view'))
            <li class="nav-item menu-open-new">
                <a href="{{ route('admin.ad.view') }}" class="nav-link">
                    <i class="nav-icon fas fa-donate"></i>
                <p>
                    Không gian quảng cáo
                </p>
                </a>
            </li>
            @endif
            @if (checkRole('role.view')||checkRole('setting.view')||checkRole('setting.mail.view')||checkRole('socialite.socialite.view'))
            <li class="menu-open-new nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                     Hệ thống
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (checkRole('role.view'))
                    <li class="menu-open-new nav-item">
                        <a href="{{ route('admin.role.view') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Phân quyền</p>
                        </a>
                    </li>
                    @endif
                    @if (checkRole('setting.mail.view'))
                    <li class="menu-open-new nav-item">
                        <a href="{{ route('admin.setting.mail') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cấu hình mail</p>
                        </a>
                    </li>
                    @endif
                    @if (checkRole('socialite.socialite.view'))
                    <li class="menu-open-new nav-item">
                        <a href="{{ route('admin.setting.socialite') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cấu hình socialite</p>
                        </a>
                    </li>
                    @endif
                    @if (checkRole('setting.view'))
                    <li class="menu-open-new nav-item">
                        <a href="{{ route('admin.setting.view') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cài đặt chung</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
        </ul>
      </nav>

    </div>
  </aside>

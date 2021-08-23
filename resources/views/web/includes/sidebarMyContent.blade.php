<aside class="main-sidebar sidebar-dark-user elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('web.home.index')}}" class="brand-link text-center">
      <span class="brand-text font-weight-dark">{{ setting()->name }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item  menu-open-new ">
                <a href="{{ route('web.publish.add') }}" class="nav-link bg-danger">

                    <i class="nav-icon fas fa-plus-circle"></i>
                    <p>
                        Viết bài mới

                    </p>
                  </a>
            </li>
            <li class="nav-item menu-open menu-open-new ">
                <a href="#" class="nav-link bg-info">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                    Bài viết
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item menu-open-new">
                    <a href="{{route('web.me.public')}}" class="nav-link {{$type=='public'?'active':''}}">
                      <i class="far fa-eye nav-icon"></i>
                      <p>Công bố</p>
                      <span class="badge badge-success right">{{ countPostPublicMyContent() }}</span>
                    </a>
                  </li>
                  <li class="nav-item menu-open-new">
                    <a href="{{route('web.me.draft')}}" class="nav-link {{$type=='draft'?'active':''}}">
                      <i class="fas fa-hand-rock nav-icon"></i>
                      <p>Nháp</p>
                      <span class="badge badge-info right">{{ countPostDraftMyContent() }}</span>
                    </a>
                  </li>
                  <li class="nav-item menu-open-new">
                    <a href="{{route('web.me.approve')}}" class="nav-link {{$type=='approve'?'active':''}}">
                      <i class="fas fa-check nav-icon"></i>
                      <p>Chờ duyệt</p>
                      <span class="badge badge-warning right">{{ countPostApproveMyContent() }}</span>
                    </a>
                  </li>
                  <li class="nav-item menu-open-new">
                    <a href="{{route('web.me.lock')}}" class="nav-link {{$type=='lock'?'active':''}}">
                      <i class="fas fa-lock nav-icon"></i>
                      <p>Khóa</p>
                      <span class="badge badge-warning right">{{ countPostLockMyContent() }}</span>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item  menu-open-new ">
                <a href="{{ route('web.me.trash') }}" class="nav-link ">

                    <i class="nav-icon fas fa-trash-alt"></i>
                    <p>
                        Thùng rác

                    </p>
                    <span class="badge badge-danger right">{{ countPostTrashMyContent() }}</span>
                  </a>
            </li>
        </ul>
      </nav>

    </div>
  </aside>

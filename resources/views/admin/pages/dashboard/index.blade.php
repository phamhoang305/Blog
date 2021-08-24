@extends('layouts.admin')
@section('admin')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-default card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-list"></i>
                 Bảng điều khiển
              </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3 class="count">{{ $shareAdmin->categorys_all }}</h3>
                          <p>Danh mục</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-list"></i>
                        </div>
                        <a href="{{ route('admin.category.parent.view') }}" class="small-box-footer"> Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 class="count">{{ $shareAdmin->posts_public }}</h3>

                          <p>Bai viết</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-rss-square"></i>
                        </div>
                        <a href="{{ route('admin.post.public') }}" class="small-box-footer"> Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3 class="count">{{ $shareAdmin->users_member }}</h3>

                          <p>Thành viên</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('admin.user.view') }}?type=userCreate" class="small-box-footer"> Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3 class="count">{{ $shareAdmin->users_admin }}</h3>

                          <p>Quản trị viên</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{ route('admin.user.view') }}?type=userAdminCreate" class="small-box-footer"> Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                          <span class="info-box-icon bg-info elevation-1"> <i class="ion fas fa-database"></i></span>

                          <div class="info-box-content">
                            <span class="info-box-text">Database</span>
                            <span class="info-box-number">
                                {{ $shareAdmin->db_size_mb }} MB
                            </span>
                          </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                          <span class="info-box-icon bg-success elevation-1"> <i class="fas fa-server"></i></span>

                          <div class="info-box-content">
                            <span class="info-box-text">Dung lượng đĩa</span>
                            <span class="info-box-number">
                                {{round($shareAdmin->diskusedize,2)}} GB / {{round($shareAdmin->disktotalsize,2)}} GB ({{$shareAdmin->diskuse}})
                            </span>
                          </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                          <span class="info-box-icon bg-navy elevation-1"> <i class="fas fa-comment"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Bình luận</span>
                            <span class="info-box-number">
                                {{ $shareAdmin->comment }}
                            </span>
                          </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                          <span class="info-box-icon bg-primary elevation-1"> <i class="fas fa-mail-bulk"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Liên hệ</span>
                            <span class="info-box-number">
                                {{ $shareAdmin->contact }}
                            </span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>

        </div>
        <div class="col-md-6">
            <!-- USERS LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liên hệ mới nhất</h3>
                <div class="card-tools">
                  <span class="badge badge-warning">Liên hệ chưa xem</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th style="width:10%" class="text-center">STT</th>
                            <th class="text-center">Họ tên</th>
                            <th class="text-center">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($contacts)
                        @php $i=0;@endphp
                        @foreach ($contacts as $item)
                            @php $i++;@endphp
                        <tr>
                            <td class="text-center">{{$i}}</td>
                            <td class="text-center">{{$item->full_name}}</td>
                            <td class="text-center">{{$item->email}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3" class="text-center">Chưa có dữ liệu nào !</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <!-- /.users-list -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="{{ route('admin.contact.view') }}">Xem tất cả liên hệ</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Truy cập gần đây</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-bordered table-sm">
                      <thead>
                          <tr>
                              <th style="width:10%" class="text-center">STT</th>
                              <th class="text-center">IP</th>
                              <th class="text-center">Thông tin</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if ($sessions)
                          @php $i=0;@endphp
                          @foreach ($sessions as $item)
                              @php $i++;@endphp
                            <tr>
                                <td class="text-center">{{$i}}</td>
                                <td class="text-center">{{$item->ip_address}}</td>
                                <td class="text-center">{{$item->user_agent}}</td>
                            </tr>
                          @endforeach
                          @else
                          <tr>
                              <td colspan="3" class="text-center">Chưa có dữ liệu nào !</td>
                          </tr>
                          @endif
                      </tbody>
                  </table>
                  <!-- /.users-list -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  {{-- <a href="{{ route('admin.contact.view') }}">Xem tất cả liên hệ</a> --}}
                </div>
                <!-- /.card-footer -->
              </div>
            <!--/.card -->
        </div>
        <div class="col-md-6">
            <!-- USERS LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Thành viên mới nhất</h3>

                <div class="card-tools">
                  <span class="badge badge-danger">{{count($users)}} Thành viên mới</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="users-list clearfix">
                    @foreach ($users as $item)
                        @php if($item->avatar==''){$item->avatar = "https://www.gravatar.com/avatar/".md5($item->email)."jpg?s=64";}@endphp
                        <li>
                        <img class="img-size-50 " src="{{ $item->avatar }}" alt="User Image">
                        <a class="users-list-name" href="#">{{ $item->full_name }}</a>
                        <span class="users-list-date">{{ $item->created_at }}</span>
                      </li>
                    @endforeach

                </ul>
                <!-- /.users-list -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="{{ route('admin.user.view') }}?type=userCreate">Xem tất cả thành viên</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!--/.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- ./row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

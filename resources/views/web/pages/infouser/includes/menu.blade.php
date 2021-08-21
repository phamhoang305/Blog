
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link {{$menuType=='posts'?'active':''}}" href="{{ route('web.user.index',$user->username) }}">Bài viết</a></li>
        <li class="nav-item"><a class="nav-link {{$menuType=='follow'?'active':''}}" href="{{ route('web.user.index',[$user->username,'follow']) }}">Người theo dõi</a></li>
        <li class="nav-item"><a class="nav-link {{$menuType=='following'?'active':''}}" href="{{ route('web.user.index',[$user->username,'following']) }}">Đang theo dõi</a></li>
        @if (Auth::check())
        @if ($user->id==user()->id)
        <li class="nav-item"><a class="nav-link {{$menuType=='profile'?'active':''}}" href="{{ route('web.user.profile') }}">Cài đặt</a></li>
        <li class="nav-item"><a class="nav-link {{$menuType=='changePass'?'active':''}}" href="{{ route('web.user.changePass') }}">Đỗi mật khẩu</a></li>
        @endif
        @endif


    </ul>
    </div>
  </nav>

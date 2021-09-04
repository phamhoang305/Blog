<table class="table table-bordered table-sm">
    @if (Auth::check())
        <tr>
            <td colspan="4">
                <div class="card card-widget widget-user">
                    @php
                    if(Auth::user()->avatar==''){
                        $avatar = "https://www.gravatar.com/avatar/".md5(Auth::user()->email)."jpg?s=64";
                    }else{
                        $avatar = Auth::user()->avatar;
                    }
                   @endphp
                    <div class="widget-user-header text-white" >
                        <h3 class="widget-user-username">{{ Auth::user()->full_name }}</h3>
                        <h5 class="widget-user-desc">{{ '@'.Auth::user()->username }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class=" elevation-2" src="{{ $avatar }}" alt="{{ Auth::user()->full_name }}" >
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">
                <a href="{{ route('web.auth.logout') }}" class="button-logout btn btn-danger btn-block"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </th>
            <th colspan="2" class="text-center">
                <a href="{{route('web.quiz.history')}}" class="btn btn-info btn-block"><i class="fas fa-history"></i> Lịch sử</a>
            </th>
        </tr>
    @else
        <tr>
            <th colspan="4"><button class="btn btn-danger btn-block btn-show-login"><i class="fa fa-user"></i> Đăng nhập</button></th>
        </tr>
    @endif
</table>

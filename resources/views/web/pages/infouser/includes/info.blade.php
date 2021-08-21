<!-- Widget: user widget style 1 -->
<div class="card card-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    @php
    if($user->avatar==''){
        $user->avatar = "https://www.gravatar.com/avatar/".md5($user->email)."jpg?s=64";
    }
   @endphp
    <div class="widget-user-header text-white" >
        <h3 class="widget-user-username">{{ $user->full_name }}</h3>
        <h5 class="widget-user-desc">{{ '@'.$user->username }}</h5>
    </div>
    <div class="widget-user-image">
        <img class=" elevation-2" src="{{ $user->avatar }}" alt="{{ $user->full_name }}" >
    </div>
    <div class="card-footer">
        <div class="row">
        <div class="col-sm-4 border-right">
            <div class="description-block">
            <h5 class="description-header count">{{$user->CountFollowing }}</h5>
            <span class="description-text">ĐANG THEO DÕI</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 border-right">
            <div class="description-block">
            <h5 class="description-header count">{{$user->CountFollows}}</h5>
            <span class="description-text">NGƯỜI THEO DÕI</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
            <div class="description-block">
            <h5 class="description-header count">{{$user->CountPosts}}</h5>
            <span class="description-text">BÀI VIẾT</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</div>
    <!-- /.widget-user -->

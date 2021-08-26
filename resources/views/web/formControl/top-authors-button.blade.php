@if (Auth::check())
    @if (setting()->sidebar_top_author_status=='on'||(user()->type=='userAdminDefault'||user()->type=='userAdminCreate'))
        @isset($singleID)
            @if ((user()->type=='userAdminDefault'||user()->type=='userAdminCreate'))
            <a href="{{ route('admin.post.edit',$singleID)}}" ><button style="margin-left: 1px" class="float-right btn btn-outline-warning btn-xs follo">Cập nhật</button></a>
            @else
            <a href="{{ route('web.publish.edit',$singleID)}}" ><button style="margin-left: 1px" class="float-right btn btn-outline-warning btn-xs follo">Cập nhật</button></a>
            @endif
        @endisset
        @if(isset($menuType)&&$menuType=='follow')
            @if (isset($user)&&$user->id==user()->id)

            @else
                <button  {{user()->id==$item->userID?'disabled':''}} style="display:{{ countFollowLogin($item->userID)!=NULL?'none':'block'}}" value="{{ $item->userID }}" data-url="{{route('web.follows.addFollows')}}" data-follows="{{$item->CountFollows==null?0:$item->CountFollows}}" class="btn btn-outline-info btn-xs float-right btn-addFollows addFollows{{ $item->userID }}"> <i class=" fa fa-user-plus"></i>  Follow  </button>
                <button  style="display:{{ countFollowLogin($item->userID)==NULL?'none':'block'}}" value="{{ $item->userID }}" data-url="{{route('web.follows.removeFollows')}}" data-follows="{{$item->CountFollows==null?0:$item->CountFollows}}" class="btn btn-outline-success btn-xs float-right btn-removeFollows removeFollows{{ $item->userID }}"> <i class=" fa fa-check"></i>  Following  </button>
            @endif
        @endif
            @if(isset($menuType)&&$menuType=='following')
            @if (isset($user)&&$user->id==user()->id)
                <button   value="{{ $item->userID }}" data-url="{{route('web.follows.removeFollows')}}" data-event='remove' data-follows="{{$item->CountFollows==null?0:$item->CountFollows}}" class="btn btn-outline-success btn-xs float-right btn-removeFollows removeFollows{{ $item->userID }}"> <i class=" fa fa-check"></i>  Following  </button>
            @else
                <button  {{user()->id==$item->userID?'disabled':''}} style="display:{{  countFollowLogin($item->userID)!=NULL?'none':'block'}}" value="{{ $item->userID }}" data-url="{{route('web.follows.addFollows')}}" data-follows="{{$item->CountFollows==null?0:$item->CountFollows}}" class="btn btn-outline-info btn-xs float-right btn-addFollows addFollows{{ $item->userID }}"> <i class=" fa fa-user-plus"></i>  Follow  </button>
                <button  style="display:{{ countFollowLogin($item->userID)==NULL?'none':'block'}}" value="{{ $item->userID }}" data-url="{{route('web.follows.removeFollows')}}" data-follows="{{$item->CountFollows==null?0:$item->CountFollows}}" class="btn btn-outline-success btn-xs float-right btn-removeFollows removeFollows{{ $item->userID }}"> <i class=" fa fa-check"></i>  Following  </button>
            @endif
        @endif
        @if(!isset($menuType))
            <button  {{user()->id==$item->userID?'disabled':''}} style="display:{{ $item->user_id!=NULL?'none':'block'}}" value="{{ $item->userID }}" data-url="{{route('web.follows.addFollows')}}" data-follows="{{$item->CountFollows==null?0:$item->CountFollows}}" class="btn btn-outline-info btn-xs float-right btn-addFollows addFollows{{ $item->userID }}"> <i class=" fa fa-user-plus"></i>  Follow  </button>
            <button  style="display:{{ $item->user_id==NULL?'none':'block'}}" value="{{ $item->userID }}" data-url="{{route('web.follows.removeFollows')}}" data-follows="{{$item->CountFollows==null?0:$item->CountFollows}}" class="btn btn-outline-success btn-xs float-right btn-removeFollows removeFollows{{ $item->userID }}"> <i class=" fa fa-check"></i>  Following  </button>
        @endif
    @else
        <button  {{user()->id==$item->userID?'disabled':''}} style="display:{{ $item->user_id!=NULL?'none':'block'}}" value="{{ $item->userID }}" data-url="{{route('web.follows.addFollows')}}" data-follows="{{$item->CountFollows==null?0:$item->CountFollows}}" class="btn btn-outline-info btn-xs float-right btn-addFollows addFollows{{ $item->userID }}"> <i class=" fa fa-user-plus"></i>  Follow  </button>
        <button  style="display:{{ $item->user_id==NULL?'none':'block'}}" value="{{ $item->userID }}" data-url="{{route('web.follows.removeFollows')}}" data-follows="{{$item->CountFollows==null?0:$item->CountFollows}}" class="btn btn-outline-success btn-xs float-right btn-removeFollows removeFollows{{ $item->userID }}"> <i class=" fa fa-check"></i>  Following  </button>
    @endif
@else
    @if (setting()->sidebar_top_author_status=='on')
        <a href="javascript:void(0)" class="btn btn-outline-info btn-xs float-right btn-show-login"> <i class=" fa fa-user-plus"></i>  Follow  </a>
    @endif
@endif

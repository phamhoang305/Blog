@php $stt=0; $control = ($showData=='admin'?'admin.post':'web.publish');@endphp
<div class="table-responsive">
    <table class="table table-bordered table-sm">
        <colgroup>
            <col width="5%">
            <col width="5%">
            <col width="10%">
            <col width="50%">
            <col width="10%">
            <col width="20%">
        </colgroup>
        <thead class="thead-info">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">
                    <div class="icheck-success d-inline">
                        <input type="checkbox"  class="checkAll" id="checkAll" >
                        <label for="checkAll">
                        </label>
                    </div>
                </th>
                <th scope="col" class="text-center">Hình</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col" class="text-center">Ngày</th>
                <th scope="col" class="text-center">Tác vụ</th>
            </tr>
            <tr>
                <td colspan="6" class="text-left showAction" style="display: none">
                    @if ($type=='public')
                        <button data-url="{{route($control.'.trash')}}" class="btn btn-warning btn-xs btn-trash-all"> <i class="fa fa-trash"></i> Thùng rác (<span class="count"></span>)</button>
                        <button data-url="{{route($control.'.delete')}}" class="btn btn-danger btn-xs btn-delete-all"> <i class="fa fa-trash"></i> Xóa vĩnh viễn (<span class="count"></span>)</button>
                        <button data-url="{{route($control.'.lock')}}" class="btn btn-info btn-xs btn-lock-all"> <i class="fa fa-lock"></i> Khóa (<span class="count"></span>)</button>
                    @endif
                    @if ($type=='draft')
                        <button data-url="{{route($control.'.trash')}}" class="btn btn-warning btn-xs btn-trash-all"> <i class="fa fa-trash"></i> Thùng rác (<span class="count"></span>)</button>
                        <button data-url="{{route($control.'.delete')}}" class="btn btn-danger btn-xs btn-delete-all"> <i class="fa fa-trash"></i> Xóa vĩnh viễn (<span class="count"></span>)</button>
                    @endif
                    @if ($type=='lock')
                        <button data-url="{{route($control.'.trash')}}" class="btn btn-warning btn-xs btn-trash-all"> <i class="fa fa-trash"></i> Thùng rác (<span class="count"></span>)</button>
                        <button data-url="{{route($control.'.delete')}}" class="btn btn-danger btn-xs btn-delete-all"> <i class="fa fa-trash"></i> Xóa vĩnh viễn (<span class="count"></span>)</button>
                        <button data-url="{{route($control.'.unlock')}}" class="btn btn-info btn-xs btn-unlock-all"> <i class="fa fa-lock-open"></i> Mở Khóa (<span class="count"></span>)</button>
                    @endif
                    @if ($type=='approve')
                        <button data-url="{{route($control.'.trash')}}" class="btn btn-warning btn-xs btn-trash-all"> <i class="fa fa-trash"></i> Thùng rác (<span class="count"></span>)</button>
                        <button data-url="{{route($control.'.delete')}}" class="btn btn-danger btn-xs btn-delete-all"> <i class="fa fa-trash"></i> Xóa vĩnh viễn (<span class="count"></span>)</button>
                    @endif
                    @if ($type=='trash')
                        <button data-url="{{route($control.'.restore')}}" class="btn btn-danger btn-xs btn-restore-all"> <i class="fa fa-trash-restore"></i> Khôi phục  (<span class="count"></span>)</button>
                        <button data-url="{{route($control.'.delete')}}" class="btn btn-danger btn-xs btn-delete-all"> <i class="fa fa-trash"></i> Xóa vĩnh viễn (<span class="count"></span>)</button>
                    @endif
                </td>
            </tr>
        </thead>
        <tbody>
            @if (count($posts)>0)
                @foreach ($posts as $item)
                    @php
                        $stt++;
                        $lockAdmin = false;
                        $trashAdmin = false;
                        if($item->avatar==''){
                            $item->avatar = "https://www.gravatar.com/avatar/".md5($item->email)."jpg?s=64";
                        }
                        if($item->thumbnail!=NULL){
                            if ( file_exists(public_path($item->thumbnail))&&$item->thumbnail!=""){
                                $post_image = $item->thumbnail;
                            }else{
                                $post_image = asset('assets/images/defaults/photos-icon.png');
                            }
                        }else{
                            $post_image = asset('assets/images/defaults/photos-icon.png');
                        }
                        $url = route('web.posts.index',[$item->post_slug]);
                    @endphp
                <tr>
                    <td scope="row" class="text-center">{{$stt}}</td>
                    <td scope="col" class="text-center">
                        <div class="icheck-success d-inline">
                            <input type="checkbox" class="checkItem" value="{{$item->uniqid}}" id="{{$item->uniqid}}" >
                            <label for="{{$item->uniqid}}">
                            </label>
                        </div>
                    </td>
                    <td class="text-center"><img height="60px" src="{{$post_image}}"></td>
                    <td>
                        <a target="_blank" href="{{ $url }}" class="product-title"> {{$item->post_title}} </a><br>
                        <span title="Tác giả" class="badge badge-default float-left"> <i class="fa fa-users"></i> {{$item->full_name}} </span><br>
                        <span title="Danh mục" class="badge badge-default float-left"> {{$item->cate_name}} </span>
                        <span title="Lượt xem" class="badge badge-default float-left"> <i class="fa fa-eye"></i> {{$item->post_view}} </span>
                        <span title="Bình luận" class="badge badge-default float-left"><i class="fas fa-comments"></i> {{$item->CountComments}} </span>
                    </td>
                    <td class="text-center">{{$item->created_at}}</td>
                    <td class="text-center">
                        <div class="btn-group ">
                            @if ($type=='public')
                                <button data-url="{{route($control.'.lock')}}" data-uniqid="{{$item->uniqid}}" class="btn-lock btn btn-outline-info btn-sm float-right" title="khóa"> <i class="fas fa-lock"></i></button>
                                <button data-url="{{route($control.'.edit',$item->uniqid)}}" title="Cập nhật" class="btn-update btn btn-outline-success btn-sm float-right  pr-2"><i class="fa fa-pen"></i></button >
                                <button data-url="{{route($control.'.trash')}}" data-uniqid="{{$item->uniqid}}" class="btn-trash btn btn-outline-danger btn-sm float-right" title="Xóa"><i class="fa fa-trash"></i></button>
                            @endif
                            @if ($type=='draft')
                                <button data-url="{{route($control.'.edit',$item->uniqid)}}" title="Cập nhật" class="btn-update btn btn-outline-success btn-sm float-right  pr-2"><i class="fa fa-pen"></i></button >
                                <button data-url="{{route($control.'.trash')}}" data-uniqid="{{$item->uniqid}}" class="btn-trash btn btn-outline-danger btn-sm float-right" title="Xóa"><i class="fa fa-trash"></i></button>
                            @endif
                            @if ($type=='lock')
                                <button  {{$lockAdmin==true?'disabled':''}}  data-url="{{route($control.'.unlock')}}" data-uniqid="{{$item->uniqid}}" class="btn-unlock btn btn-outline-info btn-sm float-right" title="Mở khóa"><i class="fas fa-lock-open"></i></button>
                                <button  {{$lockAdmin==true?'disabled':''}}  data-url="{{route($control.'.trash')}}" data-uniqid="{{$item->uniqid}}" class="btn-trash btn btn-outline-danger btn-sm float-right" title="Xóa"><i class="fa fa-trash"></i></button>
                            @endif
                            @if ($type=='trash')
                            <button {{$trashAdmin==true?'disabled':''}} {{ $trashAdmin}} data-url="{{route($control.'.restore')}}" data-uniqid="{{$item->uniqid}}" class="btn-restore btn btn-outline-info btn-sm float-right" title="Khôi phục"><i class="fas fa-trash-restore"></i></button>
                            <button {{$trashAdmin==true?'disabled':''}}  data-url="{{route($control.'.delete')}}" data-uniqid="{{$item->uniqid}}" class="btn-delete btn btn-outline-danger btn-sm float-right" title="Xóa vĩnh viễn"><i class="fa fa-trash"></i></button>
                            @endif
                            @if ($type=='approve')
                            <button data-url="{{route($control.'.edit',$item->uniqid)}}" title="Cập nhật" class="btn-update btn btn-outline-success btn-sm float-right  pr-2"><i class="fa fa-pen"></i></button >
                            <button data-url="{{route($control.'.trash')}}" data-uniqid="{{$item->uniqid}}" class="btn-trash btn btn-outline-danger btn-sm float-right" title="Xóa"><i class="fa fa-trash"></i></button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            @else
            <tr>
                <th colspan="6" class="text-center">Không có dữ liệu !</th>
            </tr>
            @endif
        </tbody>
        <tfoot>

            <tr><td colspan="6" class="text-center"> {!! $posts->links() !!}</td></tr>
        </tfoot>
    </table>
</div>
@section("runCSS")
@parent
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection
@section('runJS')
@parent
<script src="{{asset('assets/web/publish/postlist.js')}}?v={{ time() }}"></script>
<script>
   var postlist = new postlist();
   postlist.showData = "{{$showData}}";
   postlist.init();
</script>
@endsection

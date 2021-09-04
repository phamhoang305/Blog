@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">Danh sách bình luận</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" placeholder="Nhập từ kháo tìm kiếm .... " class="form-control form-control-sm" name="q" value="@isset($search){{($search)}}@endisset" />
                                                <div class="input-group-append">
                                                <button onclick="$('input[name=q]').val('')" class="btn btn-sm btn-outline-danger" type="button">Hủy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-outline-info btn-block">Tìm kiếm</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2 showAction" style="display: none">
                                        <div class="form-group">
                                            <button type="button" data-url="{{route('admin.comment.delete')}}" class="btn btn-sm btn-outline-danger btn-block btn-delete-all">Xóa ̣(<span class="count"></span>)</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">@sortablelink('id','STT')</th>
                                        <th class="text-center">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox"  class="checkAll" id="checkAll" >
                                                <label for="checkAll">
                                                </label>
                                            </div>
                                        </th>
                                        <th class="text-center">@sortablelink('full_name','Tên')</th>
                                        <th class="text-center">@sortablelink('comment','Bình luận')</th>
                                        <th class="text-center">@sortablelink('post_title','Bài viết')</th>
                                        <th class="text-center">@sortablelink('created_at','Ngày')</th>
                                        <th class="text-center">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($data)
                                        @if (count($data)>0)
                                            @php $i=0;@endphp
                                            @foreach ($data as $item)
                                                @php $i++;@endphp
                                                <tr id="item-{{$item->id}}">
                                                    <td class="text-center">{{$i}}</td>
                                                    <td class="text-center">
                                                        <div class="icheck-success d-inline">
                                                            <input type="checkbox" class="checkItem" value="{{$item->id}}" id="{{$item->id}}" >
                                                            <label for="{{$item->id}}">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($item->guest_name!=""||$item->guest_email!="")
                                                            {{$item->guest_name}}<br>{{$item->guest_email}}
                                                        @else
                                                            {{$item->full_name}}<br>{{$item->email}}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{$item->comment}}</td>
                                                    <td class="text-center">
                                                        @if ($item->cate_slug!=null&&$item->cate_slug_parent!=null)
                                                            <a target="_blank" href="{{route('web.posts.index',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug])}}">{{$item->post_title}}</a>
                                                        @else
                                                            <a target="_blank" href="{{route('web.posts.index',[$item->cate_slug,$item->post_slug])}}">{{$item->post_title}}</a>
                                                        @endif


                                                    </td>
                                                    <td class="text-center">{{$item->created_at}}</td>
                                                    <td class="text-center">
                                                        <div class="btn btn-group">
                                                            <button type="button" data-id="{{$item->id}}" data-url="{{route('admin.comment.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <th colspan="7" class="text-center">Không có dữ liệu !</th>
                                        </tr>
                                        @endif
                                    @endisset
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">@isset($data){!! $data->links() !!}@endisset</td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
          </div>
@endsection
@section("runCSS")
@parent
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection
@section('runJS')
<script src="{{asset('assets/admin/comment/list.js')}}"></script>
<script>
   var comment = new comment();
   comment.datas={

   }
   comment.init();
</script>
@endsection

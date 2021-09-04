@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">Danh sách trang</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control form-control-sm" name="q" value="@isset($search) {{$search}} @endisset " placeholder="Tìm kiếm ... " />
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
                                </div>
                            </form>
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">@sortablelink('id','STT')</th>
                                        <th> @sortablelink('post_title','Tiêu đề')</th>
                                        <th class="text-center">@sortablelink('post_status','Trạng thái')</th>
                                        <th class="text-center">@sortablelink('created_at','Ngày tạo')</th>
                                        <th class="text-center">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data)>0)
                                        @php $i=0;@endphp
                                        @foreach ($data as $item)
                                            @php $i++;@endphp
                                            <tr id="item-{{$item->id}}">
                                                <td class="text-center">{{$i}}</td>
                                                <td>{{$item->post_title}}</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input data-id="{{$item->id}}" data-url="{{route('admin.page.status')}}" {{$item->post_status=='published'?'checked':''}} type="checkbox" class="custom-control-input post_status" id="customSwitch{{$i}}">
                                                        <label class="custom-control-label" for="customSwitch{{$i}}"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{$item->created_at}}</td>
                                                <td class="text-center">
                                                    <div class="btn btn-group">
                                                        <a href="{{ route('admin.page.edit',$item->id) }}" class="btn btn-success btn-xs">Sửa</a>
                                                        <button type="button" data-id="{{$item->id}}" data-url="{{route('admin.page.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <th colspan="5" class="text-center">Không có dữ liệu !</th>
                                    </tr>
                                    @endif


                                </tbody>

                            </table>
                        </div>
                        <div class="card-footer">
                            @isset($data)
                                {!! $data->links() !!}
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
          </div>
@endsection
@section('runJS')
<script src="{{asset('assets/admin/page/list.js')}}?v={{uniqid()}}"></script>
<script>
   var page = new page();
   page.init();
</script>
@endsection

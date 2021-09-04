@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">PHÂN QUYỀN</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control form-control-sm" name="q" value="@isset($q) {{$q}} @endisset " placeholder="Tìm kiếm ... " />
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
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <a href="{{ route('admin.role.add') }}" class="btn btn-sm btn-outline-warning btn-block">Thêm mới</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">@sortablelink('id','STT')</th>
                                        <th class="text-center">@sortablelink('role_name','Tên quyền')</th>
                                        <th class="text-center">@sortablelink('role_des','Mô tả')</th>
                                        <th class="text-center">@sortablelink('created_at','Ngày tạo')</th>
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
                                                <td>{{$item->role_name}}</td>
                                                <td>{{$item->role_des}}</td>
                                                <td class="text-center">{{$item->created_at}}</td>
                                                <td class="text-center">
                                                    <div class="btn btn-group">
                                                        <a href="{{ route('admin.role.edit') }}/{{$item->id}}" class="btn btn-success btn-xs">Sửa</a>
                                                        <button type="button" data-id="{{$item->id}}" data-url="{{route('admin.role.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <th colspan="5" class="text-center">Không có dữ liệu !</th>
                                    </tr>
                                    @endif
                                    @endisset
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
<script src="{{asset('assets/admin/role/list.js')}}"></script>
<script>
   var role = new role();
   role.datas={

   }
   role.init();
</script>
@endsection

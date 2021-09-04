@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center"> <a href="{{route('admin.quiz.testcategory.view')}}" class="btn btn-sm btn-outline-danger "><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a> </h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control form-control-sm" name="q" value="@isset($q) {{$q}} @endisset" placeholder="Tìm kiếm ... " />
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
                                            <button type="button" id ="buttonShowModalAction" class="btn btn-sm btn-outline-warning btn-block">Thêm mới</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan="5" class="text-center">{{$category->name}}</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">@sortablelink('id','STT')</th>
                                            <th class="text-center">@sortablelink('testlist_name','Thông tin')</th>
                                            <th class="text-center">@sortablelink('testlist_order','Sắp xếp')</th>
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
                                                    <td>
                                                        <a target="_blank" href="{{route('web.quiz.testdetail.view')}}/{{$item->uniqid}}">
                                                        {{$item->testlist_name}}<br>
                                                        @if ($item->testlist_status==1)
                                                        <span class="badge badge-danger" title="Khóa" >Khóa</span>
                                                        @else
                                                        <span class="badge badge-success" title="Mở" >Mở</span>
                                                        @endif
                                                    </td>
                                                    </td>
                                                    <td class="text-center">{{$item->testlist_order}}</td>
                                                    <td class="text-center">{{$item->created_at}}</td>
                                                    <td class="text-center">
                                                        <div class="btn btn-group">
                                                            <button type="button" data-uniqid="{{$item->uniqid}}" data-url="{{route('admin.quiz.testdetail.view')}}/{{$item->uniqid}}" class="btn-view btn btn-info btn-xs">Thêm câu hỏi</button>
                                                            <button type="button" data-uniqid="{{$item->uniqid}}" data-url="{{route('admin.quiz.testlist.edit')}}/{{$item->uniqid}}" class="btn-edit btn btn-success btn-xs">Sửa</button>
                                                            <button type="button" data-uniqid="{{$item->uniqid}}" data-url="{{route('admin.quiz.testlist.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
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
          @include('admin.pages.quiz.testlist.action')
@endsection
@section('runJS')
<script src="{{asset('assets/admin/quiz/testlist.js')}}"></script>
<script>
   var testlist = new testlist();
   testlist.datas={
        test_categoryID:"{{ $category->id }}",
        route:{
           add:"{{route('admin.quiz.testlist.add')}}",
           edit:"{{route('admin.quiz.testlist.edit')}}",
           delete:"{{route('admin.quiz.testlist.delete')}}",
        }
   }
   testlist.init();
</script>
@endsection

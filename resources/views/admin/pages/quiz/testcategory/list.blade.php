@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">Danh mục </h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-8">
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
                                        <th class="text-center">@sortablelink('id','STT')</th>
                                        <th class="text-center">@sortablelink('name','Tên')</th>
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
                                                <td><a target="_blank" href="{{route('web.quiz.testlist.view')}}/{{$item->uniqid}}">
                                                    {{$item->name}}<br>
                                                    @if ($item->status==1)
                                                    <span class="badge badge-danger" title="Khóa" >Khóa</span>
                                                    @else
                                                    <span class="badge badge-success" title="Mở" >Mở</span>
                                                    @endif
                                                    </a>

                                                </td>
                                                <td class="text-center">{{$item->created_at}}</td>
                                                <td class="text-center">
                                                    <div class="btn btn-group">
                                                        <button type="button" data-uniqid="{{$item->uniqid}}" data-url="{{route('admin.quiz.testlist.view')}}/{{$item->uniqid}}" class="btn-view btn btn-info btn-xs">Xử lý</button>
                                                        <button type="button" data-uniqid="{{$item->uniqid}}" data-url="{{route('admin.quiz.testcategory.edit')}}/{{$item->uniqid}}" class="btn-edit btn btn-success btn-xs">Sửa</button>
                                                        <button type="button" data-uniqid="{{$item->uniqid}}" data-url="{{route('admin.quiz.testcategory.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <th colspan="4" class="text-center">Không có dữ liệu !</th>
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
          @include('admin.pages.quiz.testcategory.action')
@endsection
@section('runJS')
<script src="{{asset('assets/admin/quiz/testcategory.js')}}"></script>
<script>
   var testcategory = new testcategory();
   testcategory.datas={
       route:{
           add:"{{route('admin.quiz.testcategory.add')}}",
           edit:"{{route('admin.quiz.testcategory.edit')}}",
           delete:"{{route('admin.quiz.testcategory.delete')}}",
       }
   }
   testcategory.init();
</script>
@endsection

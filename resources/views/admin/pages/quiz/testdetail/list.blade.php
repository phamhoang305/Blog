@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center"> <a href="{{route('admin.quiz.testlist.view',$info->uniqid)}}" class="btn btn-sm btn-outline-danger "><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a></h3>
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
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="button" id ="buttonShowModalImport" class="btn btn-sm btn-outline-success btn-block">Nhập excel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                            <table class="table table-bordered table-sm">

                                <thead>
                                    <tr>
                                        <th colspan="4" class="text-center">{{$info->name}} - ({{$countDetail}}) Câu</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">@sortablelink('id','STT')</th>
                                        <th class="text-center">@sortablelink('title','Tiêu đề')</th>
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
                                                    {{$item->title}}<br>
                                                    @if ($item->status==1)
                                                    <span class="badge badge-danger" title="Khóa" >Khóa</span>
                                                    @else
                                                    <span class="badge badge-success" title="Mở" >Mở</span>
                                                    @endif
                                                </td>

                                                <td class="text-center">{{$item->created_at}}</td>
                                                <td class="text-center">
                                                    <div class="btn btn-group">
                                                        <button type="button" data-uniqid="{{$item->uniqid}}" data-url="{{route('admin.quiz.testdetail.edit')}}/{{$item->uniqid}}" class="btn-edit btn btn-success btn-xs">Sửa</button>
                                                        <button type="button" data-uniqid="{{$item->uniqid}}" data-url="{{route('admin.quiz.testdetail.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
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
          @include('admin.pages.quiz.testdetail.action')
@endsection
@section('runCSS')

<link rel="stylesheet" href="{{ asset('assets/themes/plugins/codesample/prism.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/highlight/styles/monokai-sublime.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/quill/quill.snow.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection
@section('runJS')
<script src="{{asset('assets/themes/plugins/codesample/prism.min.js')}}"></script>
<script src="{{asset('assets/themes/plugins/highlight/highlight.min.js')}}"></script>
<script src="{{asset('assets/themes/plugins/quill/quill.js')}}"></script>
<script src="{{asset('assets/themes/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/admin/quiz/testdetail.js')}}?v={{ time() }}"></script>
<script>
   var testdetail = new testdetail();
   testdetail.datas={
        name:"{{ $info->name }}",
        test_listID:"{{$info->testlistID}}",
        route:{
           add:"{{route('admin.quiz.testdetail.add')}}",
           edit:"{{route('admin.quiz.testdetail.edit')}}",
           delete:"{{route('admin.quiz.testdetail.delete')}}",
        }
   }
   testdetail.init();
</script>
@endsection

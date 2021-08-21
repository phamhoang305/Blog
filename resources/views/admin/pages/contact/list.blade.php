@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">Thông tin liên hệ</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control form-control-sm" name="q" value="@isset($search) {{$search}} @endisset" placeholder="Tìm kiếm ... " />
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
                                            <button type="button" data-url="{{route('admin.contact.delete')}}" class="btn btn-sm btn-outline-danger btn-block btn-delete-all">Xóa ̣(<span class="count"></span>)</button>
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
                                        <th class="text-center">@sortablelink('email','Email')</th>
                                        {{-- <th class="text-center">@sortablelink('body','Nội dung')</th> --}}
                                        <th class="text-center">@sortablelink('created_at','Ngày gửi')</th>
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
                                                    <td class="text-center">{{$item->full_name}}</td>
                                                    <td class="text-center">
                                                        {{$item->email}}
                                                        @if ($item->status==1)
                                                        <span class="badge badge-info" id="status-table-{{$item->id}}" title="Đã xem" >Đã xem</span>
                                                        @else
                                                        <span class="badge badge-warning" id="status-table-{{$item->id}}" title="Chưa xem" >Chưa xem</span>
                                                        @endif
                                                    </td>
                                                    {{-- <td class="text-center">{{$item->body}}</td> --}}
                                                    <td class="text-center">{{$item->created_at}}</td>
                                                    <td class="text-center">
                                                        <div class="btn btn-group">
                                                            <button type="button" data-id="{{$item->id}}" data-url="{{route('admin.contact.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
                                                            <button type="button" data-id="{{$item->id}}" data-url="{{route('admin.contact.viewAjax')}}" class="btn bg-navy btn-view btn-xs">Xem</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <th colspan="6" class="text-center">Không có dữ liệu !</th>
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
          @include('admin.pages.contact.modal')
@endsection
@section("runCSS")
@parent
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<style>.form-group { margin-bottom: 0rem;}</style>
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/codesample/prism.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/highlight/styles/monokai-sublime.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/quill/quill.snow.css')}}">
@endsection
@section('runJS')
<script src="{{asset('assets/themes/plugins/codesample/prism.min.js')}}"></script>
<script src="{{asset('assets/themes/plugins/highlight/highlight.min.js')}}"></script>
<script src="{{asset('assets/themes/plugins/quill/quill.js')}}"></script>
<script src="{{asset('assets/themes/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/admin/contact/list.js')}}"></script>
<script>
   var contact = new contact();
   contact.datas={

   }
   contact.init();
</script>
@endsection

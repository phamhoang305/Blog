@extends('layouts.web')
@section('web')
          <div class="content">
            <div class="container card-category">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{$category->name}}</th>
                                        </tr>
                                    </thead>
                                </table>
                                <br>
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-10">
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

                                    </div>
                                </form>
                                <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead class="">
                                        <tr>
                                            <th class="text-center">@sortablelink('id','STT')</th>
                                            <th class="text-center">@sortablelink('testlist_name','Tiêu đề')</th>
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
                                                        <b>{{$item->testlist_name}}</b>
                                                    </td>
                                                    <td class="text-center">
                                                        <a  href="{{route('web.quiz.testdetail.view')}}/{{$item->uniqid}}" class="btn-view btn btn-info btn-xs">Làm bài</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <th colspan="3" class="text-center">Không có dữ liệu !</th>
                                        </tr>
                                        @endif
                                        @endisset
                                    </tbody>

                                </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('web.quiz.category.view')}}" class="btn btn-sm btn-outline-danger "><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                                @isset($data)
                                    {!! $data->links() !!}
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          @include('web.pages.quiz.includes.modal-view')
          @include('web.pages.quiz.includes.modal-test')
@endsection
@section('runJS')
<script src="{{asset('assets/web/quiz/testlist.js')}}?v={{time()}}"></script>
<script>
   var testlist = new testlist();
   testlist.init();
</script>
@endsection



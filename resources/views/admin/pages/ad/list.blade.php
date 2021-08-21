@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header ">
                            <h3 class="card-title text-center">KHÔNG GIAN QUẢNG CÁO</h3>
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
                            <table class="table table-bordered table-sm hover table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">@sortablelink('id','STT')</th>
                                        <th class="text-center">@sortablelink('name','Tên')</th>
                                        <th class="text-center">@sortablelink('status','Trạng thái')</th>
                                        <th class="text-center">@sortablelink('updated_at','Ngày')</th>
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
                                                    <td class="text-center">{{$item->name}} </td>
                                                    <td class="text-center">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                            <input data-id="{{$item->id}}" data-url="{{route('admin.ad.status')}}" {{$item->status=='on'?'checked':''}} type="checkbox" class="custom-control-input ad_status" id="customSwitch{{$i}}">
                                                            <label class="custom-control-label" for="customSwitch{{$i}}"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{$item->updated_at}}</td>
                                                    <td class="text-center">
                                                        <div class="btn btn-group">
                                                            <a   href="{{route('admin.ad.edit')}}/{{$item->id}}" class="btn btn-success  btn-xs">Cập nhật</a>
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
                            </table>
                        </div>
                        <div class="card-footer">
                            @isset($data)
                                {!! $data->links() !!}
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark p-2 ">
                        <div class="card-header  ">
                            <h3 class="card-title text-center">MÃ KÍCH HOẠT (AdSense)</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea rows="3" id="AdSense" name="AdSense" class="form-control">
                                        {{setting()->AdSense}}
                                </textarea>
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="button" data-url="{{route('admin.ad.saveAdSene')}}" id="saveCodeAdSense" class="btn btn-info">Lưu</button>
                        </div>
                    </div>

                </div>
            </div>
          </div>
@endsection
@section('runJS')
<script src="{{asset('assets/admin/ad/list.js')}}"></script>
<script>
   var ad = new ad();
   ad.datas={

   }
   ad.init();
</script>
@endsection

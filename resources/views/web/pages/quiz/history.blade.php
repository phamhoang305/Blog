@extends('layouts.web')
@section('web')
          <div class="content">
            <div class="container card-category">
                <div class="card ">
                    <div class="card-header p-2 ">
                        <h3 class="card-title text-center">Lịch sử </h3>
                    </div>
                    <div class="card-body">
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            @php
                            if(Auth::user()->avatar==''){
                                $avatar = "https://www.gravatar.com/avatar/".md5(Auth::user()->email)."jpg?s=64";
                            }else{
                                $avatar = Auth::user()->avatar;
                            }
                           @endphp
                            <div class="widget-user-header text-white" >
                                <h3 class="widget-user-username">{{ Auth::user()->full_name }}</h3>
                                <h5 class="widget-user-desc">{{ '@'.Auth::user()->username }}</h5>
                            </div>
                            <div class="widget-user-image">
                                <img class=" elevation-2" src="{{ $avatar }}" alt="{{ Auth::user()->full_name }}" >
                            </div>
                        </div>
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
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;" class="text-center">STT</th>
                                    <th class="text-left">Dạnh mục</th>
                                    <th class="text-left">Đề</th>
                                    <th class="text-center"> Kết quả</th>
                                    <th style="width: 15%;" class="text-center">
                                       Tác vụ
                                    </th>
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
                                            <td> <a href="{{route('web.quiz.testlist.view')}}/{{$item->category_uniqid}}">{{$item->name}}</a></td>
                                            <td> <a href="{{route('web.quiz.testdetail.view')}}/{{$item->testlist_uniqid}}">{{$item->testlist_name}}</a></td>
                                            <td class="text-center">
                                                <span class="badge badge-success ">{{$item->true_number}}</span>
                                                <span class="badge badge-danger ">{{$item->error_number}}</span>
                                                <span class="badge badge-dark ">{{$item->nocheck_number}}</span><br>
                                                {{time_Ago(date_time($item->created_at))}}
                                            </td>
                                            <td class="text-center">
                                                <a class="btn bg-navy" href="{{route('web.quiz.resultdetail')}}/{{$item->results_uniqid}}">Xem lại</a>
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
@endsection
@section('runJS')
@endsection



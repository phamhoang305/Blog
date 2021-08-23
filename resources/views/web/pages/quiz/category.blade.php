@extends('layouts.web')
@section('web')
          <div class="content">
            <div class="container card-category">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header p-2 ">
                                <h3 class="card-title text-center" >Chủ đề </h3>
                            </div>
                            <div class="card-body">
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
                                <div class="row">
                                    @isset($data)
                                        @if (count($data)>0)
                                            @php $i=0; $array = ['danger','success','warning','info','dark','primary'] @endphp
                                            @foreach ($data as $item)
                                            @php
                                                $i++;
                                                if($i==5){
                                                    $i=0;
                                                }
                                            @endphp
                                            <div class="col-sm-12 col-lg-3 col-md-3">
                                                <div class="small-box bg-{{$array[$i]}}">
                                                    <div class="inner">
                                                    <h3 >{{$item->name}}</h3>
                                                    {{-- <p>New Orders</p> --}}
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fas fa-laptop-code"></i>
                                                    </div>
                                                    <a href="{{route('web.quiz.testlist.view')}}/{{$item->uniqid}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                     @endisset
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
          </div>
@endsection
@section('runCSS')
<style>
    .small-box h3 {
          font-size: 1.5rem;
          font-weight: 700;
          margin: 0 0 10px;
          padding: 0;
          white-space: nowrap;
      }
</style>
@endsection



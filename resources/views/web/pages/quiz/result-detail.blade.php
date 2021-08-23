@extends('layouts.web')
@section('web')
          <div class="content">
            <div class="container card-category">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card ">
                            <div class="card-body">
                                <div class="skeleton skeleton-line" style="--lines: 25;--c-w: 100%;"></div>
                                <div class="load-content-quiz" style="display: none">
                                    @php $i=0; @endphp
                                        <table class="table table-bordered table-sm">
                                            <tr class="dark"><th colspan="4">{{$data->category_name}} - {{ $data->testlist_name }}</th></tr>

                                            <tr class="dark">
                                                <th colspan="2"><a href="{{route('web.quiz.history')}}" class="btn btn-sm btn-block btn-outline-danger "><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a></th>
                                                <th colspan="2"><a href="{{route('web.quiz.testdetail.view')}}/{{$data->testlist_uniqid}}" class="btn btn-sm btn-block btn-outline-info "><i class="fas fa-check"></i> Làm lại</a></th>
                                            </tr>
                                            <tr class="dark"><th colspan="4" class="item-note">{!! $data->testlist_des !!}</th></tr>
                                        </table>
                                        <table class="table table-bordered table-sm">
                                        <tr >
                                            <th class="text-center">Đúng</th>
                                            <th class="text-center">Sai</th>
                                            <th class="text-center">Bỏ</th>
                                        </tr>
                                        <tr >
                                            <td class="text-center">{{$data->true_number}}</td>
                                            <td class="text-center">{{$data->error_number}}</td>
                                            <td class="text-center">{{$data->nocheck_number}}</td>
                                        </tr>
                                        </table>
                                    <br>
                                    @foreach ($data->results as $value)
                                        @php $i++ @endphp
                                        <div class="">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table table-bordered table-sm">
                                                        <tr class="dark"><th colspan="4">Câu ({{ $i }}) : {{ $value->title }} </th></tr>
                                                    </table>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-sm">
                                                            @if ($value->note!="<p><br></p>")
                                                            <tr><th colspan="4" class="item-note">{!!$value->note!!}</th></tr>
                                                            @endif
                                                        </table>
                                                    </div>
                                                    <table class="table table-bordered table-sm">
                                                        @php
                                                            $items = (json_decode($value->item));
                                                            $stringABC = "A";
                                                            $text="";
                                                        @endphp
                                                        @if (count($items)>0)

                                                            @foreach (($items) as $item)
                                                                @php $class = "";
                                                                    if($value->check==$item->uniqid&&$value->check_uniqid==$item->uniqid){
                                                                        $class = "success";
                                                                    }else if($value->check_uniqid==$item->uniqid){
                                                                        $class = "success";
                                                                    }else if($value->check==$item->uniqid){
                                                                        $class = "danger";
                                                                    }
                                                                @endphp
                                                                <tr class="table-{{$class}}">
                                                                    <td class="text-center" style="width:5%;">{{  $stringABC }}</td>
                                                                    <td colspan="2">{{ $item->name }}</td>
                                                                </tr>
                                                                @php $stringABC++ @endphp
                                                            @endforeach
                                                            @php
                                                                $statusFooter = 'success';
                                                                if($value->status=='Sai'){
                                                                    $statusFooter = 'danger';
                                                                }else if($value->status=='Bỏ'){
                                                                    $statusFooter = 'warning';
                                                                }
                                                            @endphp
                                                            <tr class="table-{{ $statusFooter }}">
                                                                <td class="text-center" colspan="4">{{ $value->status }}</td>
                                                            </tr>
                                                        @endif
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        @include('web.pages.quiz.includes.widget')
                    </div>
                </div>
            </div>
          </div>
@endsection
@section('runCSS')
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/codesample/prism.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/highlight/styles/monokai-sublime.min.css')}}">
@endsection
@section('runJS')
<script src="{{asset('assets/themes/plugins/codesample/prism.min.js')}}"></script>
<script src="{{asset('assets/themes/plugins/highlight/highlight.min.js')}}"></script>
<script src="{{asset('assets/web/quiz/testlist.js')}}?v={{uniqid()}}"></script>
<script>
    var testlist = new testlist();
    testlist.init();
 </script>
@endsection




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
                                            <tr class="dark"><th colspan="2">{{$info->name}} ({{$count}}) câu </th></tr>
                                            <tr class="dark">
                                                <th><a href="{{route('web.quiz.testlist.view')}}/{{$info->uniqid}}" class="btn btn-sm btn-block btn-outline-danger "><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a></th>
                                                @if (Auth::check())
                                                <th><button {{$count>0?'':'disabled'}}  data-uniqid="{{$info->testlist_uniqid}}" data-url="{{route('web.quiz.testdetail.view')}}" class="{{$count>0?'btn-test':''}} btn btn-sm btn-block btn-outline-info "><i class="fas fa-check"></i> Bắt đầu</button></th>
                                                @else
                                                <th><button class="btn btn-sm btn-block btn-outline-info btn-show-login"><i class="fas fa-check"></i> Bắt đầu</button></th>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="post-share">
                                                        <ul class="share-box">
                                                            <li class="share-li-lg">
                                                                <a href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-lg facebook">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                    <span>Facebook</span>
                                                                </a>
                                                            </li>
                                                            <li class="share-li-lg">
                                                                <a href="javascript:void(0)" onclick="window.open('https://twitter.com/share?url={{URL::current()}};text={{ $info->name }}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-lg twitter">
                                                                    <i class="fab fa-twitter"></i>
                                                                    <span>Twitter</span>
                                                                </a>
                                                            </li>
                                                            <li class="share-li-sm">
                                                                <a href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-sm facebook">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                </a>
                                                            </li>
                                                            <li class="share-li-sm">
                                                                <a href="javascript:void(0)" onclick="window.open('https://twitter.com/share?url={{URL::current()}};text={{ $info->name }}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-sm twitter">
                                                                    <i class="fab fa-twitter"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-sm linkedin">
                                                                    <i class="fab fa-linkedin-in"></i>
                                                                </a>
                                                            </li>
                                                            <li class="li-whatsapp">
                                                                <a href="https://api.whatsapp.com/send?text={{ $info->name }} - {{URL::current()}}" class="social-btn-sm whatsapp" target="_blank">
                                                                    <i class="fab fa-whatsapp"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)" onclick="window.open('http://www.tumblr.com/share/link?url={{URL::current()}};title={{ $info->name }}', 'Share This Post', 'width=640,height=450');return false" class="social-btn-sm tumblr">
                                                                    <i class="fab fa-tumblr"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @if ($info->testlist_minutes>0)
                                            <tr class="dark"><th colspan="2">Thời gian :  {{$info->testlist_minutes}} phút </th></tr>
                                            @endif
                                            @if ($info->des!="<p><br></p>")
                                            <tr class="">
                                                <th colspan="2">
                                                    {!!$info->des!!}
                                                </th>
                                            </tr>
                                            @endif
                                        </table>
                                        <br>
                                        @if ($count>0)
                                            @foreach ($data as $value)
                                                @php $i++ @endphp
                                                <div class="card">
                                                    <div class="card-body">
                                                        <table class="table table-bordered table-sm">
                                                            <tr class="dark"><th colspan="2">Câu ({{ $i }}) : {{ $value->title }}</th></tr>
                                                        </table>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-sm">
                                                                @if ($value->note!="<p><br></p>")
                                                                    <tr><th colspan="2" class="item-note">{!!$value->note!!}</th></tr>
                                                                @endif
                                                            </table>
                                                        </div>
                                                        <table class="table table-bordered table-sm">
                                                            @php
                                                                $items = (json_decode($value->item));
                                                                $stringABC = "A"
                                                            @endphp
                                                            @if (count($items)>0)
                                                                @foreach (($items) as $item)
                                                                    <tr>
                                                                        <td class="text-center" style="width:5%;">{{  $stringABC }}</td>

                                                                        <td>{{ $item->name }}</td>
                                                                    </tr>
                                                                    @php $stringABC++ @endphp
                                                                @endforeach
                                                            @endif
                                                        </table>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                        <table class="table table-bordered table-sm">
                                            <tr class="text-center"><th colspan="4">Không có dữ liệu !</th></tr>
                                        </table>
                                        @endif
                                </div>
                            </div>
                            <div class="card-body">

                                    <div  style="background-color: white;" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="comment-facebook-tab">
                                        <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#{{URL::current()}}" data-width="100%" data-lazy="true" data-numposts="10"></div>
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
          @include('web.pages.quiz.includes.modal-test')
@endsection
@section('runCSS')
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/codesample/prism.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/highlight/styles/monokai-sublime.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection
@section('runJS')
<script src="{{asset('assets/themes/plugins/codesample/prism.min.js')}}"></script>
<script src="{{asset('assets/themes/plugins/highlight/highlight.min.js')}}"></script>
<script src="{{asset('assets/web/quiz/testlist.js')}}?v={{uniqid()}}"></script>
<script>
   var testlist = new testlist();
   testlist.datas={
        count:"{{$info->count}}",
        test_listID:"{{$info->testlistID}}",
        saveTest:"{{ route('web.quiz.saveTest') }}",
        testlist_minutes:"{{$info->testlist_minutes}}"
   }
   testlist.init();
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=2784474005206649&autoLogAppEvents=1" nonce="V2POithY"></script>
@endsection


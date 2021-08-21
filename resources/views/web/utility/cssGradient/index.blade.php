@extends('layouts.web')
@section('web')
          <div class="content">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card card-dark ">
                        <div class="card-header">
                          <h3 class="card-title text-center">CSS-GRADIENT</h3>
                        </div>
                        <div class="card-body">
                          <blockquote class="blockquote"><h3 style="">CSS GRADIENT</h3>
                            <p style="font-size: 14px;">CSS Gradient là một trang web nhỏ và công cụ miễn phí cho phép bạn tạo nền gradient cho trang web. Bên cạnh việc là một trình tạo độ dốc css, trang web này cũng chứa đầy nội dung đầy màu sắc về độ dốc từ các bài viết kỹ thuật đến các ví dụ về độ dốc thực tế như Stripe và Instagram.</p><p style="font-size: 14px;">Tại sao bạn làm điều này?</p><p style="font-size: 14px;">Xem độ dốc đã được phát lại trong những ngày đầu web, nhưng bây giờ họ rất phổ biến đến nỗi bạn phải hối hận không bỏ chúng vào trang web, giao diện hoặc công việc nhuộm tóc tiếp theo của bạn.</p><p style="margin-bottom: 1rem; font-size: 14px;">Ngoài ra, tôi là một phần của một nhóm các nhà sản xuất với sứ mệnh xây dựng một mạng internet tốt hơn, một dự án kỹ thuật số tại một thời điểm. Một trong những dự án gần đây của chúng tôi ra mắt là Cool Backgrounds một công cụ thiết kế miễn phí khác để tạo hình nền cho các trang web, blog và điện thoại.</p></blockquote>
                        </div>
                        <div class="card-body p-0">
                            <iframe id="page"   width="100%" data-url="{{ route('web.css_gradien.page') }}"  style="border: none" class="btn-block"></iframe>
                        </div>
                      </div>
                      <div class="card-footer">
                        {{-- <a target="_blank" class="btn btn-outline-info " href="https://magic.reactjs.net/htmltojsx.htm">https://magic.reactjs.net/htmltojsx.htm</a> --}}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header">
                            <h3 class="card-title">Bình luận </h3>
                        </div>
                        <div class="card-body">
                                <div style="background-color: white;">
                                    <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#{{URL::current()}}" data-width="100%" data-lazy="true" data-numposts="10"></div>
                                </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
              </div>
            </div>
          </div>
@endsection
@section('runJS')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=2784474005206649&autoLogAppEvents=1" nonce="V2POithY"></script>
<script>
var _0xab83=["\x75\x72\x6C","\x64\x61\x74\x61","\x23\x70\x61\x67\x65","\x50\x4F\x53\x54","\x68\x74\x6D\x6C","\x73\x72\x63\x64\x6F\x63","\x61\x74\x74\x72","\x73\x63\x72\x6F\x6C\x6C\x48\x65\x69\x67\x68\x74","\x62\x6F\x64\x79","\x66\x69\x6E\x64","\x63\x6F\x6E\x74\x65\x6E\x74\x73","\x6C\x6F\x67","\x68\x65\x69\x67\x68\x74","\x61\x6A\x61\x78","\x72\x65\x61\x64\x79"];$(document)[_0xab83[14]](function(){$[_0xab83[13]]({url:$(_0xab83[2])[_0xab83[1]](_0xab83[0]),type:_0xab83[3],dataType:_0xab83[4],success:function(_0x8d93x1){$(_0xab83[2])[_0xab83[6]](_0xab83[5],_0x8d93x1);setTimeout(function(){var _0x8d93x2=$(_0xab83[2])[_0xab83[10]]()[_0xab83[9]](_0xab83[8])[0][_0xab83[7]];console[_0xab83[11]](_0x8d93x2);$(_0xab83[2])[_0xab83[6]](_0xab83[12],_0x8d93x2)},1000)},error:function(_0x8d93x3){}})})
</script>
@endsection

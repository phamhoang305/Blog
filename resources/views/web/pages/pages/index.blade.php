@extends('layouts.web')
@section('web')
          <!-- Main content -->
          <div class="content">
            <div class="container card-category">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class=" card card-dark">
                                <div class="card-header " >
                                    <h3 style="text-align: center" class="card-title "> <b>  {{$post->post_title}} </b></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-3">
                                    <div class="skeleton skeleton-line" style="--lines: 25;--c-w: 100%;"></div>
                                    <div class="post-content" id="post_content">
                                        {{-- @php echo htmlentities($post->post_content, ENT_QUOTES, 'UTF-8', true)@endphp --}}
                                        {!!($post->post_content)!!}
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-header text-center">

                                </div>
                                <!-- /.card-footer -->
                            </div>
                        </div>
                        <div class="col-lg-4 card-category">
                            @include('web.formControl.controlSidebar')
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
@endsection
@section('runCSS')
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/codesample/prism.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/highlight/styles/monokai-sublime.min.css')}}">
@endsection
@section('runJS')
<script src="{{asset('assets/themes/plugins/codesample/prism.min.js')}}"></script>
<script src="{{asset('assets/themes/plugins/highlight/highlight.min.js')}}"></script>
<script src="{{asset('assets/web/single/single.js')}}"></script>
<script>
   var single = new single();
   single.init();
</script>
@endsection



@extends('layouts.myContent')
@section('web')
<section class="content">
    <div class="container-fulld">
        @include('includes.formActionPost')
    </div>
</section>
@endsection
@section('runCSS')
<style>.form-group { margin-bottom: 0.1rem;margin-top: 0.1rem;}</style>
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/codesample/prism.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/highlight/styles/monokai-sublime.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/themes/plugins/quill/quill.snow.css')}}">
@endsection
@section('runJS')
<script src="{{asset('assets/themes/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/themes/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('assets/themes/plugins/codesample/prism.min.js')}}"></script>
<script src="{{asset('assets/themes/plugins/highlight/highlight.min.js')}}"></script>
<script src="{{asset('assets/themes/plugins/quill/quill.js')}}"></script>
<script src="{{asset('assets/themes/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/web/publish/publish.js')}}?v={{time()}}"></script>
<script>
   var publish = new publish();
   publish.datas={
        editor:"{{ $post->editor }}",
        type:"{{ $type }}",
        category_id:"{{ $post->category_id }}",
        subMenus:@json(getSubMenu())
   };
   publish.init();
</script>
@endsection

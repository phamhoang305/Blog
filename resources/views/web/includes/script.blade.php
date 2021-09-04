<script src="{{route('global.js')}}?v={{uniqid()}}"></script>
<script>
var _postID = "@isset($post->id) {{$post->id}} @endisset";
var _cate_slug = "@isset($post->cate_slug) {{$post->cate_slug}} @endisset";
 </script>
<script src="{{asset('assets/themes/app/script.min.js')}}?v={{uniqid()}}"></script>
@if (env('APP_DEBUG', 'forge')==true)
<script src="{{asset('assets/main//dev.js')}}?v={{uniqid()}}"></script>
@else
<script src="{{asset('assets/main//main.min.js')}}?v={{uniqid()}}"></script>
@endif




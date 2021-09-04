<script src="{{route('global.js')}}?v={{uniqid()}}"></script>
<script src="{{asset('assets/themes/app/script.min.js')}}?v={{time()}}"></script>
@if (env('APP_DEBUG', 'forge')==true)
<script src="{{asset('assets/main//dev.js')}}?v={{uniqid()}}"></script>
@else
<script src="{{asset('assets/main//main.min.js')}}?v={{uniqid()}}"></script>
@endif



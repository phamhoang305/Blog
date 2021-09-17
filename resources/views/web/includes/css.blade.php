<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/themes/app/style.min.css')}}?ver={{ time() }}">
@if (env('APP_DEBUG', 'forge')==true)
<link rel="stylesheet" href="{{asset('assets/main//dev.css')}}?ver={{ time() }}">
@else
<link rel="stylesheet" href="{{asset('assets/main//main.min.css')}}?ver={{ time() }}">
@endif

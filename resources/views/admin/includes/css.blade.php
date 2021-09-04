<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/themes/plugins/fontawesome-free/css/all.min.css')}}?v={{ time() }}">
<link rel="stylesheet" href="{{asset('assets/themes/app/style.min.css')}}?v={{ time() }}">
@if (env('APP_DEBUG', 'forge')==true)
<link rel="stylesheet" href="{{asset('assets/main//main.css')}}?v={{ uniqid() }}">
@else
<link rel="stylesheet" href="{{asset('assets/main//main.min.css')}}?v={{ uniqid() }}">
@endif

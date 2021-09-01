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
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "88bc549a-ca99-43e4-9ffc-6108da4a7c78",
      safari_web_id: "web.onesignal.auto.5c6acdd7-2576-4d7e-9cb0-efba7bf8602e",
      notifyButton: {
        enable: true,
      },
    });
  });
</script>



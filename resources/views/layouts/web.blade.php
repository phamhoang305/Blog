<!DOCTYPE html>
<html amp  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta property="fb:app_id" content="2784474005206649" />
    <meta property="fb:admins" content="L14042019N"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="msvalidate.01" content="B53C2048465C6318DE0D1A6DE93A5B9B" />
    <meta name="google-site-verification" content="vEPcZnk3Nv2QC9JjuZkJ4EiuqsTmn0oYj7eFvQHLPsw" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="sitemap" type="application/xml" href="{{asset('sitemap.xml')}}"/>
    <link rel="amphtml" href="{{URL::current()}}" /> 
    {!! SEO::generate(true) !!}
    @include('includes.icon')
    <link rel="stylesheet" type="text/css"href="{{asset('assets/themes/plugins/fontawesome-free/css/all.min.css')}}?v={{ uniqid() }}">
    @include('web.includes.css')
    @yield('runCSS')
</head>
<body class="{{ setting()->darkMode=='on'?'dark-mode':'' }} layout-top-nav control-sidebar-slide-open layout-navbar-fixed layout-footer-fixed text-sm">
    <div class="wrapper">
        @include('web.includes.header')
        <div class="content-wrapper">
            <div class="container">
                @include('includes.alertSession')
            </div>
            @yield('web')
        </div>
        @include('web.includes.footer')
        @include('web.includes.modalLogin')
    </div>
    @include('web.includes.script')
    @yield('runJS')
    @yield('runJSFollow')
    {!! setting()->Google_Analytics!!}
    {!! setting()->AdSense!!}
</body>
</html>

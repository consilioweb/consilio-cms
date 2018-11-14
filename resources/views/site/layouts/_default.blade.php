<!DOCTYPE html>
<html lang="pt-BR" itemscope itemtype="http://schema.org/WebPage">
<head>
    <!--  Start meta tags -->    
    <title>{!!$site->title!!}</title>
    <meta name="csrf-token" content="{!!csrf_token()!!}"/>

    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <base href="{{url("/")}}">
    <link rel="canonical" href="{{url()->current()}}" />
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="{!!$site->keywords!!}"/>
    <meta name="description" content="{!!$site->description!!}">
    <meta name="robots" content="index,follow,noodp"/>
    <meta name="language" content="portuguese"/>
    <meta name="autor" content="Web:Consilio"/>


    <!-- Open Graph data -->
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{Config::get('app.appTitle')}}"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="{{Config::get('app.appImage')}}"/>
    <meta property="og:description" content="{{Config::get('app.appDescription')}}"/>
    <meta property="og:site_name" content="{{url("/")}}"/>
    <!-- End meta tags -->

    <!-- Start loading the favicon-->
    <link rel="shortcut icon" href="{{asset('public')}}/favicon.png" type="image/png">

    <!-- App Css -->
    <link id="pageStyle" rel="stylesheet" href="{{asset('public')}}/css/app.css">

    <link rel="stylesheet" href="{{asset('public'.elixir('css/site/'.Route::currentRouteName().'.css'))}}">  


</head>

<body>

 @yield('content')

 <input type="hidden" name="app_url" id="app_url" value="{!!url("/")!!}">
 <script src="{{asset('public'.elixir('js/site/'.Route::currentRouteName().'-libs.js'))}}"></script> 
 
 <script src="{{asset('public'.elixir('js/site/'.Route::currentRouteName().'.js'))}}" async></script>  


</body>
</html>
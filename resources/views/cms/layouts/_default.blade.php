<!DOCTYPE html>
<html dir="ltr" lang="pt-BR" itemscope itemtype="http://schema.org/WebPage">
<head>
    <!--  Start meta tags -->    
    <title>{{Config::get('app.appTitle')}}</title>
    <meta name="csrf-token" content="{!!csrf_token()!!}"/>

    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <base href="{{url("/")}}">
    <link rel="canonical" href="{{url()->current()}}" />
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="{{Config::get('app.appKeywords')}}"/>
    <meta name="description" content="{{Config::get('app.appDescription')}}">
    <meta name="robots" content="index,follow,noodp"/>
    <meta name="language" content="portuguese"/>

    <!-- Start loading the favicon-->
    <link rel="shortcut icon" href="{{asset('public')}}/favicon.png" type="image/png">

    <!-- App Css -->
    <link id="pageStyle" rel="stylesheet" href="{{asset('public')}}/css/app.css">

    <!-- Style Css -->
    <link id="pageStyle" rel="stylesheet" href="{{asset('public')}}/css/cms/style.css">

    @if (file_exists("public/css/cms/".Route::currentRouteName().".css"))
    <link rel="stylesheet" href="{{asset('public'.elixir('css/cms/'.Route::currentRouteName().'.css'))}}">  
    @endif

</head>



<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <!-- Header -->
        @include('cms.layouts._header')
        <!-- Sidebar -->
        @include('cms.layouts._sidebar')

        <div class="page-wrapper">
            <!-- Content -->
            @yield('content')

            <!-- Footer -->
            @include('cms.layouts._footer')
        </div>
    </div>

    

    <input type="hidden" name="app_url" id="app_url" value="{!!url("/")!!}">
    <input type="hidden" name="app_hash" id="app_hash" value="{!!criptBySystem(Auth::user()->users_id)!!}">

    <!-- CK Editor -->
    <script src="{{asset('public')}}/js/cms/libs/ckeditor/ckeditor.js"></script>

    <!-- Libs -->
    <script src="{{asset('public')}}/js/cms/app-libs.js"></script> 
    @if (file_exists("public/js/cms/".Route::currentRouteName()."-libs.js"))
    <script src="{{asset('public'.elixir('js/cms/'.Route::currentRouteName().'-libs.js'))}}"></script> 
    @endif


    <!-- App -->
    <script src="{{asset('public')}}/js/cms/app.js"></script> 
    @if (file_exists("public/js/cms/".Route::currentRouteName().".js"))
    <script src="{{asset('public'.elixir('js/cms/'.Route::currentRouteName().'.js'))}}" async></script>   
    @endif

</body>

</html>


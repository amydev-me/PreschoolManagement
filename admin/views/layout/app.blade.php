<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{URL::asset('img/logo.png')}}">

    <title>UNIVERSITY OF OXFORD</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

    <!--Icon-fonts css-->
    <link href="{{URL::asset('css/myfonts.css')}}" rel="stylesheet" />

    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/bootstrap-reset.css')}}" rel="stylesheet">

    <!--Animation css-->
    <link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/form-wizard/jquery.steps.css')}}" />
    <link href="{{URL::asset('css/csstyles.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/helper.css')}}" rel="stylesheet">
    @yield('style')
</head>
<body >
<div id="app">
    @include('layout.sidebar')
    <section class="content" >
        @include('layout.header')
        <div class="wraper container-fluid">
            <div class="page-title">
                <h3 class="title">@yield('page-title')</h3>
            </div>
            @yield('content')
        </div>
        @include('layout.footer')
    </section>
</div>
<script src="{{URL::asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/manifest.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/vendor.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/app.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/pace.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/wow.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/common.js')}}" type="text/javascript"></script>
@yield('script')
</body>
</html>

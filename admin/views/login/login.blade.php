<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{URL::asset('img/favicon_1.ico')}}">
    <title>Wiki - Preschool Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/bootstrap-reset.css')}}" rel="stylesheet">

    <!--Animation css-->
    <link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">

    <!--Icon-fonts css-->
    <link href="{{URL::asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/ionicon/css/ionicons.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/helper.css')}}" rel="stylesheet">
</head>
<body>
<div class="wrapper-page animated fadeInDown">
    <div class="panel panel-color panel-primary">
        <div class="panel-heading">
            <h3 class="text-center m-t-10"> Sign In to <strong>{{$info?$info->title:''}}</strong> </h3>
        </div>
        <form class="form-horizontal m-t-40" action="{{route('admin.login-post')}}" method="post">
            {{csrf_field()}}

            @if(session('error'))
                <div class="alert alert-danger">
                    <p>{{ session('error') }}</p>
                </div>

            @endif
            <div class="form-group ">
                <div class="col-xs-12">
                    <input class="form-control" type="text" placeholder="Username" name="username">
                </div>
            </div>
            <div class="form-group ">

                <div class="col-xs-12">
                    <input class="form-control" type="password" placeholder="Password" name="password">
                </div>
            </div>
            <div class="form-group text-right">
                <div class="col-xs-12">
                    <button class="btn btn-purple w-md" type="submit">Log In</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{URL::asset('js/jquery.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/pace.min.js')}}"></script>
<script src="{{URL::asset('js/wow.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
<!--common script for all pages-->
<script src="{{URL::asset('js/jquery.app.js')}}"></script>


</body>
</html>

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Restaurant') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css')  }}">
    <link href="{{ asset('/components/semantic/dist/semantic.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                       Restaurant Management
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </div>
    <!-- Scripts -->


    <script src="{{ asset('/components/angular/angular.js') }}"></script>   
    <script type="text/javascript" src="{{  asset('components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{  asset('components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/components/semantic/dist/semantic.min.js') }}"></script>


<script type="text/javascript">
    var app = angular.module('app', []);
    app.run(['$http', function ($http) {
        $http.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
        $http.defaults.cache = false;
    }]);
</script>


    
@section('script')

@show
</body>
</html>

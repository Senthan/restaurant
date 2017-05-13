<!DOCTYPE html>
<html lang="en"  style="font-family: Segoe UI, Helvetica, Arial, sans-serif">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaturant</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>


	<div class="container" style="background-color: #fff;">
		@yield('content')
	</div>


	<script type="text/javascript" src="{{  asset('components/jquery/dist/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{  asset('components/bootstrap/dist/js/bootstrap.min.js') }}"></script>


    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM8LtJcXEjCABtsGyigU0dCN4agXmvmag"></script>


</body>

@section('script')

@show
</html>
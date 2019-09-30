<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>No más accidentes</title>

        <!-- Fonts -->
        
        <link rel="stylesheet" href="/css/app.css?v1.0.80">

        <!-- Styles -->
    </head>
    <body >
      <div id="app">
  			@if($user)
  				<App
  					:user="{{$user}}"
            >
  			@else
  				<Login />
  			@endif
        <div class="clearfix"></div>
  		</div>

      <script src="/js/manifest.js?v0.1"></script>
  		<script src="/js/vendor.js?v0.1"></script>
  		<script src="/js/app.js?v0.1.100" charset="utf-8"></script>
    </body>
</html>

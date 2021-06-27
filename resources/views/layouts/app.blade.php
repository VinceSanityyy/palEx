<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PalEx</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">


</head>
<body class="hold-transition login-page" style="background: #44c662;">
<div id="app">
    @yield('content')
</div>

<script src="{{asset('js/app.js')}}"></script>

</body>
</html>

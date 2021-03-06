<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PalEx</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ldbtn.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loading.min.css') }}">
</head>
{{-- <body class="sidebar-mini layout-fixed control-sidebar-open text-sm"> --}}
{{-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> --}}

{{-- <body class="layout-top-nav layout-navbar-fixed"> --}}
<body style="background-color: #f5f5f5">
    <div id="app" >
        <router-view :is_auth="{{ Auth::check() ? 1 : 0 }}"></router-view>
    </div>
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>

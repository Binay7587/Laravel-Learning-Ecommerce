<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Nayabazar Admin | Login</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- PAGE LEVEL STYLES-->
    <link href="{{ asset('css/auth-light.css') }}" rel="stylesheet" />

</head>

<body class="bg-silver-300">
<div class="content">
    <div class="brand">
        <a class="link" href="index.html">AdminCAST</a>
    </div>
    @yield('content')
</div>
<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS -->
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>

<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

</body>

</html>

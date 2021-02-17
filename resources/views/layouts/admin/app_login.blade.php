<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('Admin Login') }} | {{ config('app.name') }}</title>
        <link rel="stylesheet" href="/admin/styles/style.min.css">

        <!-- Waves Effect -->
        <link rel="stylesheet" href="/admin/plugin/waves/waves.min.css">

    </head>

    <body>

        <div id="single-wrapper">
            @yield('content')
        </div><!--/#single-wrapper -->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="/admin/script/html5shiv.min.js"></script>
            <script src="/admin/script/respond.min.js"></script>
        <![endif]-->
        <!-- 
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/admin/scripts/jquery.min.js"></script>
        <script src="/admin/scripts/modernizr.min.js"></script>
        <script src="/admin/plugin/bootstrap/js/bootstrap.min.js"></script>
        <script src="/admin/plugin/nprogress/nprogress.js"></script>
        <script src="/admin/plugin/waves/waves.min.js"></script>

        <script src="/admin/scripts/main.min.js"></script>

        <script src='https://www.google.com/recaptcha/api.js'></script>
    </body>
</html>
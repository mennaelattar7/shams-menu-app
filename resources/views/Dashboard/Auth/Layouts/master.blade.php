<!doctype html>
<html lang="en">

    <head>
        <title>{{ trans('Dashboard.Shams') }} |  @yield('title') </title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        @yield('meta_description_keywords_author')

        <link rel="icon" href="{{ asset('shams/dashboard/favicon.ico') }}" type="image/x-icon">

        <!-- VENDOR CSS -->
        <link rel="stylesheet" href="{{ asset('shams/dashboard/general_assets/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('shams/dashboard/general_assets/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{ asset('shams/dashboard/general_assets/assets/vendor/animate-css/vivify.min.css')}}">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="{{ asset('shams/dashboard/assets/css/site.min.css')}}">
    </head>
    <body class="theme-cyan font-montserrat">
        <!-- Page Loader -->
        @include('Dashboard.Auth.Layouts.page_loader')

        @yield('content')

        <script src="{{ asset('shams/dashboard/assets/bundles/libscripts.bundle.js')}}"></script>
        <script src="{{ asset('shams/dashboard/assets/bundles/vendorscripts.bundle.js')}}"></script>
        <script src="{{ asset('shams/dashboard/assets/bundles/mainscripts.bundle.js')}}"></script>
    </body>
</html>

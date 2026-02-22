<!doctype html>
<html lang="en">
    <head>
        <title>
            Shams | @yield('title')
        </title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="description" content="Oculux Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
        <meta name="keywords" content="admin template, Oculux admin template, dashboard template, flat admin template, responsive admin template, web app, Light Dark version">
        <meta name="author" content="GetBootstrap, design by: puffintheme.com">

        <link rel="icon" href="{{ asset('shams/dashboard/favicon.ico') }}" type="image/x-icon">
        <!-- VENDOR CSS -->
        <link rel="stylesheet" href="{{ asset('shams/dashboard/general_assets/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('shams/dashboard/general_assets/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('shams/dashboard/general_assets/assets/vendor/animate-css/vivify.min.css')}}">
        <link rel="stylesheet" href="{{ asset('shams/dashboard/general_assets/assets/vendor/c3/c3.min.css')}}"/>

        <link rel="stylesheet" href="{{ asset('shams/dashboard/general_assets/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{ asset('shams/dashboard/general_assets/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{ asset('shams/dashboard/general_assets/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{ asset('shams/dashboard/general_assets/assets/vendor/sweetalert/sweetalert.css')}}"/>

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="{{ asset('shams/dashboard/assets/css/site.min.css')}}">
        <style>
            td.details-control {
            background: url('../assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
            tr.shown td.details-control {
                background: url('../assets/images/details_close.png') no-repeat center center;
            }
        </style>
        <!-- Shams Style -->
        <link rel="stylesheet" href="{{ asset('shams/dashboard/shams_assets/css/style.css')}}">
        <style>
            .light_version .fancy-checkbox input[type="checkbox"]+span:before {
                border-color: #17A2B8;
            }
            .search_block
            {
                padding: 30px 20px;
                border: 1px solid #282B2F;
                background-color: #282B2F;
                border-radius: 10px;
                margin-top: 20px;
            }
            .search_block .form_label
            {
            text-align:center
            }
            #search_btn
            {
                width:100%
            }
            .create-button
            {
                font-weight: 900;
            }
            .table-responsive table tbody tr td
            {
                text-align: center
            }
            .table-responsive table thead tr th
            {
                text-align: center
            }

            .table-responsive table tfoot tr th
            {
                text-align: center
            }
            .table-responsive table thead tr , .table-responsive table tfoot tr
            {
                    background-color: #6f5000;
                    color: white;
            }
            .btn-primary:not(:disabled):not(.disabled):active
            {
                color: black
            }
            .btn-primary
            {
                color: black
            }
            .btn-outline-info:hover
            {
                color: black
            }
            .btn-outline-info
            {
                font-weight: 900
            }
            .table-badges
            {
                padding: 10px;
                font-weight: 700;
            }
            /* activation */
            .activation-status-active {
                background-color: #146C43;
            }

            .activation-status-inactive {
                background-color: #495057;
            }
            .btn-info {
                background-color: #117a8b;
                border-color:#117a8b
            }
        </style>

    </head>
    <body class="theme-cyan font-montserrat">
        <!-- Page Loader -->
        {{--  @include('Dashboard.Layouts.page_loader')  --}}
        <!-- Theme Setting -->
        @include('Dashboard.Layouts.theme_setting')
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <div id="wrapper">
{{--  <?php
$user = Auth::user();
dd([
    'roles' => $user->getRoleNames(),
    'permissions' => $user->getAllPermissions()->pluck('name')
]);
?>  --}}
            @include('Dashboard.Layouts.navigationbar')
            @include('Dashboard.Layouts.search')
            @include('Dashboard.Layouts.chat')

            @include('Dashboard.Layouts.sidemenu')
            <div id="main-content">
                @yield('content')
            </div>

        </div>
        <!-- Javascript -->
        <script src="{{ asset('shams/dashboard/assets/bundles/libscripts.bundle.js')}}"></script>
        <script src="{{ asset('shams/dashboard/assets/bundles/vendorscripts.bundle.js')}}"></script>
        <script src="{{ asset('shams/dashboard/assets/bundles/datatablescripts.bundle.js')}}"></script>
        <script src="{{ asset('shams/dashboard/general_assets/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('shams/dashboard/general_assets/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('shams/dashboard/general_assets/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
        <script src="{{ asset('shams/dashboard/general_assets/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('shams/dashboard/general_assets/assets/vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
        <script src="{{ asset('shams/dashboard/general_assets/assets/vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->
        <script src="{{ asset('shams/dashboard/assets/bundles/c3.bundle.js')}}"></script>
        <script src="{{ asset('shams/dashboard/assets/bundles/mainscripts.bundle.js')}}"></script>
        <script src="{{ asset('shams/dashboard/assets/js/pages/tables/jquery-datatable.js')}}"></script>
        <script src="{{ asset('shams/dashboard/assets/js/index.js')}}"></script>
        <script>
            $.fn.dataTable.ext.errMode = 'none';
        </script>
    </body>
</html>

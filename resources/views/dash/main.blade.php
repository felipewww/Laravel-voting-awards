<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Startup Awards {{ env('APP_YEAR') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @yield('styles')

    {{--TEMPLATE--}}
    <!-- Bootstrap Core CSS -->
    <link href="/admin/css/template/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="/admin/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="/admin/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="/admin/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="/admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="/admin/css/template/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/admin/css/template/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="/admin/css/template/colors/default.css" id="theme" rel="stylesheet">
    <link href="/admin/css/style.css" id="theme" rel="stylesheet">
    {{--TEMPLATE--}}

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/admin/css/template/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="/admin/js/template/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="/admin/js/template/waves.js"></script>
    <!--Counter js -->
    <script src="/admin/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="/admin/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!-- chartist chart -->
    <script src="/admin/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="/admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="/admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/admin/js/template/custom.min.js"></script>
    <script src="/admin/js/template/dashboard1.js"></script>
    <script src="/admin/plugins/bower_components/toast-master/js/jquery.toast.js"></script>

    {{--Sweetalert--}}
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.common.js"></script>--}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.min.js"></script>
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.common.min.js.map"></script>--}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.min.css">
    {{--Sweetalert--}}

    {{--<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>--}}
    {{--<script type="text/javascript" src="/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>--}}
    {{--<script type="text/javascript" src="/site/js/Script.js"></script>--}}

    {{--DATATABLES--}}
    <link href="/admin/js/DataTables/datatables.min.css" rel="stylesheet">
    <script src="/admin/js/DataTables/datatables.min.js"></script>
    <script src="/admin/js/DataTablesExtensions.js"></script>
    {{--<script src="/admin/js/DataTablesExtensions.js"></script>--}}
    <script src="/js/mScript.js"></script>
    <script src="/admin/js/Script.js"></script>
    {{--DATATABLES--}}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript">
        $(document).ready(function () {
            window.csrfToken = '{{ csrf_token() }}';
            window.APP_URL = '{{ env("APP_URL") }}'
        })
    </script>

    @yield('scripts')

</head>
<body class="fix-header">

<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>

<div id="wrapper">

    @include('dash.partials.top')
    @include('dash.partials.menu')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">{{ $vars->title }}</h4>
                </div>
            </div>
            @yield('content')
        </div>
        <footer class="footer text-center"> 2017 &copy; Startup Awards </footer>
    </div>
</div>
</body>
</html>
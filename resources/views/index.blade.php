<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Startup Awards {{ env('APP_YEAR') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/site/css/style.css">
    <link rel="stylesheet" type="text/css" href="/js/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    @yield('styles')

    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/site/js/Script.js"></script>
    @yield('scripts')

</head>
<body>
    {{--<img src="/site/media/images/idc_1.png" style="width: 100%; height: 100%; position: absolute; z-index: 999; opacity: 0.3">--}}
    {{--<img src="/site/media/images/idc_2.png" style="width: 100%; height: 100%; position: absolute; z-index: 999; opacity: 0.3">--}}
    <main>
        <div id="bg_main">

            @yield('bg_main_content')

            <div id="content">
                @yield('content')
            </div>

        </div>
    </main>
</body>
</html>
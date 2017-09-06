<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Startup Awards {{ env('APP_YEAR') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{--<meta name="fb_app_id" content="{{ \App\Http\Controllers\Controller::$FB_APP_ID }}">--}}
    <!-- CSRF Token -->
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

    <link rel="stylesheet" type="text/css" href="/site/css/style.css">
    <link rel="stylesheet" type="text/css" href="/js/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    @yield('styles')

    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/site/js/Script.js"></script>

    <script type="text/javascript">
        window.csrfToken = '{{ csrf_token() }}';
    </script>

    @yield('scripts')

</head>
<body>
    <div id="_modal"></div>

    <div id="loader">
        <img src="/images/Spinner.svg">
    </div>
    {{--<img src="/site/media/images/idc_1.png" style="width: 100%; height: 100%; position: absolute; z-index: 999; opacity: 0.3">--}}
    {{--<img src="/site/media/images/idc_2.png" style="width: 100%; height: 100%; position: absolute; z-index: 999; opacity: 0.3">--}}
    <main>
        <div id="bg_main">

            @yield('bg_main_content')

            <div id="content">
                @yield('content') {{-- conteudo default com animação --}}
            </div>

            <footer>
                <div class="realiza">
                    <div class="title">co-realização</div>
                    <div>
                        <img src="/site/media/images/abs.svg">
                        <img src="/site/media/images/logo_blanko.png">
                    </div>
                </div>
                <div class="divider"></div>
                <div class="apoio">
                    <div class="title">apoio</div>
                    <div>
                        <img src="/site/media/images/abs.svg">
                        <img src="/site/media/images/blanko.svg">
                    </div>
                </div>
            </footer>
        </div>
    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Startup Awards {{ env('APP_YEAR') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="/site/css/style.css?{{ $v->rand }}">
    <link rel="stylesheet" type="text/css" href="/js/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    @yield('styles')

    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/site/js/Script.js"></script>

    <script type="text/javascript">
        window.csrfToken = '{{ csrf_token() }}';
        window.APP_URL = '{{ env("APP_URL") }}';

        $(window).resize(function () {
            console.log($(window).width(), $(window).height())

        });

        $( window ).on( "orientationchange", function( event ) {
            window.location.reload();
        });
    </script>

    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-42895350-7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments)};
        gtag('js', new Date());

        gtag('config', 'UA-42895350-7');
    </script>

    @yield('scripts')

</head>
<body>
    <div id="landscape">
        <div>Aproveite melhor a visualização do site em modo Retrato</div>
        <img src="/site/media/images/{{env("APP_LOGO")}}" />
    </div>
    <div id="_modal"></div>

    <div id="loader">
        <img src="/images/Spinner.svg">
    </div>
    {{--<img src="/site/media/images/idc_1.png" style="width: 100%; height: 100%; position: absolute; z-index: 999; opacity: 0.3">--}}
    {{--<img src="/site/media/images/idc_2.png" style="width: 100%; height: 100%; position: absolute; z-index: 999; opacity: 0.3">--}}
    <main>
        @yield('main_content')
        <div id="bg_main">

            @yield('bg_main_content')

            @yield('content') {{-- conteudo default com animação --}}

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
                    <div class="title">patrocinio</div>
                    <div>
                        <img src="/site/media/images/logo_aws.png">
                    </div>
                </div>
            </footer>
        </div>
    </main>
</body>
</html>
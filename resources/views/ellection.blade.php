@extends('index')

@section('scripts')
    {{--<meta property="og:url"           content="{{ env('APP_URL') }}/share" />--}}
    {{--<meta property="og:type"          content="website" />--}}
    {{--<meta property="og:title"         content="Startup Awards {{env("APP_YEAR")}}" />--}}
    {{--<meta property="og:description"   content="Descrição do share aqui" />--}}
    {{--<meta property="og:image"         content="{{ env('APP_URL') }}/site/media/images/{{ env('APP_LOGO') }}" />--}}

    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <script type="text/javascript">
        ellectionInfo = JSON.parse('{!! json_encode($v->info) !!}');
    </script>
    <script type="text/javascript" src="/site/js/Pages.js?{{ $v->rand }}"></script>
    <script type="text/javascript" src="/site/js/Ellection.js?{{ $v->rand }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="/site/css/ellection.css?{{ $v->rand }}">
@endsection

@section('bg_main_content')
    {{--<div class="fb-share-button" data-href="http://www.awards.lumen.dev/share" data-layout="button" data-size="large" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.awards.lumen.dev%2Fshare&amp;src=sdkpreparse">Compartilhar</a></div>--}}

    <div id="gaveta">
        <div class="menu">
            <img src="/site/media/images/{{env("APP_LOGO")}}">
            <ul>
                <li><a href="/sobre">SOBRE O PRÊMIO</a> </li>
                <li><a href="/indicacao/termos">REGULAMENTO</a> </li>
                <li><a href="#">SEGURANÇA</a> </li>
            </ul>

            <div id="footer">
                <div class="realiza-gaveta">
                    <div class="title">co-realização</div>
                    <div>
                        <img src="/site/media/images/abs.svg">
                        <img src="/site/media/images/logo_blanko.png">
                    </div>
                </div>
                <div class="cleaner"></div>
                <div class="apoio-gaveta">
                    <div class="title">apoio</div>
                    <div>
                        <img src="/site/media/images/abs.svg">
                        <img src="/site/media/images/blanko.svg">
                    </div>
                </div>
            </div>
        </div>

        <div id="indicados">

        </div>
    </div>

    <div id="abre-gaveta">
        <div id="nav-icon1">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div id="pagesBar"></div>
@endsection

@section('content')
    <script type="text/javascript">
        //        fbShare = null;
        window.fbAsyncInit = function() {
            FB.init({
                appId       : '139520189890905',//'139520189890905', // Set YOUR APP ID - produçao azure  1685282121713164
                oauth       : true,
                status      : true, // check login status
                cookie      : true, // enable cookies to allow the server to access the session
                xfbml       : true,  // parse XFBML
                version     : 'v2.10',
                channelUrl  : '{{ env("APP_URL") }}' //custom channel
            });
        };
    </script>
    <div id="category" >
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div id="hero" style="background-image: url(/site/media/images/aceleradora.png)"></div>

    <div id="form">
        <form id="mainform" name="mainform">
            <label>
                <input type="text" name="indicated">
            </label>

            <label>
                <input type="text" name="reference">
            </label>

            <div class="button" id="main-btn">
                <span></span>
                <span>
                    <div >INDICAR</div>
                </span>
            </div>
            <div class="cleaner"></div>
            <div class="nav-buttons">
                <div class="button" id="btn-previous">
                    <span></span>
                    <span>
                        <div>ANTERIOR</div>
                    </span>
                </div>
                <div class="button" id="btn-next">
                    <span></span>
                    <span>
                        <div>PRÓXIMA</div>
                    </span>
                </div>
            </div>
        </form>
    </div>

    <div id="req">
        <ul>
            <li>Estar ativo</li>
            <li>Planos específicos para Startups na cidade onde atua</li>
            <li>Ter sido host de no mínimo 3 eventos</li>
        </ul>
    </div>
@endsection
@extends('index')

@section('scripts')
    {{--<script type="text/javascript" src="/site/js/mobile-detect.min.js"></script>--}}
    <script type="text/javascript" src="/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript" src="/js/jquery.nanoscroller.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/nanoscroller.css">
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script type="text/javascript">
        appStatus = '{{  $v->appStatus }}';
        ellectionInfo = JSON.parse('<?= $v->info ?>');
        finalistsInfo = JSON.parse('<?= $v->infoFinalists ?>');
        PrefinalistsInfo = JSON.parse('<?= $v->infoPreFinalists ?>');

        shareToken = '{{ $v->share_token }}';
        publicAppId = '{{ env("FB_APP_ID") }}';
    </script>
    @if($v->appStatus == 'voting')
        <script type="text/javascript" src="/site/js/PreVote.js?{{ $v->rand }}"></script>
        <link rel="stylesheet" type="text/css" href="/site/css/prevote.css?{{ $v->rand }}">
    @endif

    @if($v->appStatus == 'prevote')
        <script type="text/javascript" src="/site/js/PreVote.js?{{ $v->rand }}"></script>
        <link rel="stylesheet" type="text/css" href="/site/css/prevote.css?{{ $v->rand }}">
    @endif
    <script type="text/javascript" src="/site/js/Pages.js?{{ $v->rand }}"></script>
    <script type="text/javascript" src="/site/js/Ellection.js?{{ $v->rand }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="/site/css/ellection.css?{{ $v->rand }}">
    <link rel="stylesheet" type="text/css" href="/site/css/fonts/icon/flaticon.css?{{ $v->rand }}">
@endsection
@section('main_content')
    <div id="abre-gaveta">
        <div id="nav-icon1">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="pagesBar"></div>
    <div id="modal_req_mobile"></div>
@endsection
@section('bg_main_content')

    <div id="gaveta" class="{{ \App\Application::Info()->status }}">
        <div class="menu">
            <img src="/site/media/images/{{env("APP_LOGO")}}">
            <ul>
                <li><a href="/sobre">SOBRE O PRÊMIO</a> </li>
                <li><a href="/regulamento">REGULAMENTO</a> </li>
                <li><a href="/seguranca">SEGURANÇA</a> </li>
            </ul>

            <div id="footer">
                <div class="realiza-gaveta">
                    <div class="title">co-realização</div>
                    <div>
                        <img src="/site/media/images/abs.svg">
                        <img src="/site/media/images/logo_blanko.png">
                    </div>
                </div>
                <div class="apoio-gaveta">
                    <div class="title">patrocinio</div>
                    <div>
                        <img src="/site/media/images/logo_aws.png">
                    </div>
                </div>
            </div>
        </div>

        <div id="indicados" class="nano-content">
            <ul id="ul-gaveta">
                {{-- Montado via JS --}}
            </ul>
        </div>
    </div>

@endsection

@section('content')
<div id="content">
    <script type="text/javascript">
        window.fbAsyncInit = function() {
            FB.init({
                appId       : '{{ env("FB_APP_ID") }}',
                oauth       : true,
                status      : true,
                cookie      : true,
                xfbml       : true,
                version     : 'v2.10',
                channelUrl  : '{{ env("APP_URL") }}'
            });
        };

        $( function() {
            $( "#reference-tooltip" ).tooltip({
                appendToBody: true,
                show:  {
                    effect: 'slideDown'
                },
                position: {
                    my: "center top",
                    at: "center bottom"
                },
                using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                            .addClass( "arrow" )
                            .addClass( feedback.vertical )
                            .addClass( feedback.horizontal )
                            .appendTo( this );
                },
                open: function( event, ui ) {
                    ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
                    setTimeout(function () {
                        $( "#reference-tooltip" ).tooltip( "close" );

                    },3000);
                },
                close: function (e, o) {
//                    $( "#reference-tooltip" ).bind( "click");
                }
            });
        } );

        $( function() {
            $( ".ref-tooltip" ).tooltip({
                show: null,
                position: {
                    my: "center top",
                    at: "center bottom"
                },
                using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                        .addClass( "arrow" )
                        .addClass( feedback.vertical )
                        .addClass( feedback.horizontal )
                        .appendTo( this );
                },
                open: function( event, ui ) {
                    ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
                },
            });
        } );
//        if (isMobile.apple.device) {
//
//            $( "#reference-tooltip" ).on("shown.bs.tooltip", function() {
//                $('body').css('cursor', 'pointer');
//            });
//
//            $( "#reference-tooltip" ).on("hide.bs.tooltip", function() {
//                $('body').css('cursor', 'auto');
//            });
//        }
    </script>

    <div id="logo"></div>
    <div id="hero" style="background-image: url('/site/media/images/aceleradora.png')"></div>
    <div id="category" >
        <div></div>
        <div></div>
        <div></div>
    </div>

    @if(\App\Application::Info()->status == 'ellection')
        <div id="form">
            <form id="mainform" name="mainform">
                <label>
                    <input type="text" name="indicated" maxlength="50">
                </label>

                <label>
                    <input type="text" name="reference"  maxlength="150">
                    <span class="referencia" id="reference-tooltip" title="Neste campo você deve digitar alguma referência para validarmos a sua indicação. Pode ser um link de um site, link de um perfil de LinkedIn, nome da empresa ou instituição relacionada.">
                        <div class="questionicon flaticon-question-mark-on-a-circular-black-background"></div>
                        {{--<img src="/site/media/images/icon_referencia.png">--}}
                    </span>
                </label>

                <div id="main-btn">
                    <span class="bar"></span>
                    <span class="btnbody">
                        <div class="btn-text">INDICAR</div>
                    </span>
                </div>

                <div class="cleaner"></div>
            </form>
        </div>

        <div class="nav-block">
            <div class="btn" id="btn-previous">
                <span class="bar"></span>
                <span class="btnbody">
                    <div class="btn-text">ANTERIOR</div>
                </span>
            </div>
            <div class="btn" id="btn-next">
                <span class="bar"></span>
                <span class="btnbody">
                    <div class="btn-text">PRÓXIMO</div>
                </span>
            </div>
        </div>

        <div id="req">
            <div class="title">
                <div class="bg"></div>
                <div class="req">Requisitos da Categoria</div>
            </div>
            <ul id="requl">
                <li>
                    <span>Estar ativo</span>
                </li>
                <li>
                    <span>Ter sido host de no mínimo 3 eventos</span>
                </li>
            </ul>
        </div>
    @endif

    @if(\App\Application::Info()->status == 'prevote')
        <div id="form">
            <form id="mainform" name="mainform">

                <div id="pre_finalists">
                    <select id="prefinalists" name="prefinalists">
                        <option value="1">asd</option>
                        <option value="1">zxc</option>
                        <option value="1">qwe</option>
                        <option value="1">qwe</option>
                        <option value="1">qwe</option>
                        <option value="1">qwe</option>
                        <option value="1">qwe</option>
                        <option value="1">qwe</option>
                        <option value="1">qwe</option>
                        <option value="1">qwe</option>
                    </select>
                </div>

                <div id="main-btn">
                    <span class="bar"></span>
                    <span class="btnbody">
                        <div class="btn-text">VOTAR</div>
                    </span>
                </div>
                <div class="cleaner"></div>
            </form>
        </div>

        <div class="nav-block">
            <div class="btn" id="btn-previous">
                <span class="bar"></span>
                <span class="btnbody">
                    <div class="btn-text">ANTERIOR</div>
                </span>
            </div>
            <div class="btn" id="btn-next">
                <span class="bar"></span>
                <span class="btnbody">
                    <div class="btn-text">PRÓXIMO</div>
                </span>
            </div>
        </div>
    @endif

    @if(\App\Application::Info()->status == 'voting')
        <div id="form">
            <form id="mainform" name="mainform">

                <div id="finalists">
                    <div class="finalist">
                        <div class="check">
                            <div class="checked"></div>
                        </div>
                        <div class="name">{{--Nome do Indicado via JS--}}</div>
                        {{--<span class="ref-tooltip" title="Aqui vai a referência"><img src="/site/media/images/icon_referencia.png"></span>--}}
                        <div class="cleaner"></div>
                    </div>

                    <div class="finalist">
                        <div class="check">
                            <div class="checked"></div>
                        </div>
                        <div class="name">{{--Nome do Indicado via JS--}}</div>
                        {{--<span class="ref-tooltip" title="Aqui vai a referência"><img src="/site/media/images/icon_referencia.png"></span>--}}
                        <div class="cleaner"></div>
                    </div>

                    <div class="finalist">
                        <div class="check">
                            <div class="checked"></div>
                        </div>
                        <div class="name">{{--Nome do Indicado via JS--}}</div>
                        {{--<span class="ref-tooltip" title="Aqui vai a referência"><img src="/site/media/images/icon_referencia.png"></span>--}}
                        <div class="cleaner"></div>
                    </div>
                </div>

                <div id="main-btn">
                    <span class="bar"></span>
                    <span class="btnbody">
                        <div class="btn-text">VOTAR</div>
                    </span>
                </div>
                <div class="cleaner"></div>
            </form>
        </div>

        <div class="nav-block">
            <div class="btn" id="btn-previous">
                <span class="bar"></span>
                <span class="btnbody">
                    <div class="btn-text">ANTERIOR</div>
                </span>
            </div>
            <div class="btn" id="btn-next">
                <span class="bar"></span>
                <span class="btnbody">
                    <div class="btn-text">PRÓXIMO</div>
                </span>
            </div>
        </div>
    @endif
    <div id="mobile_req">
        <div>
            Requisitos da Categoria
        </div>
    </div>
</div>
@endsection
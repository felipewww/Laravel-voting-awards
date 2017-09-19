@extends('index')

@section('scripts')
    <script type="text/javascript" src="/js/jquery.nanoscroller.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/nanoscroller.css">
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <script type="text/javascript">
        appStatus = '{{  $v->appStatus }}';
        ellectionInfo = JSON.parse('{!! json_encode($v->info) !!}');
        finalistsInfo = JSON.parse('{!! json_encode($v->infoFinalists) !!}');
        shareToken = '{{ $v->share_token }}';
        publicAppId = '{{ env("FB_APP_ID") }}';

//        console.log(ellectionInfo);
        console.log(finalistsInfo);

    </script>
    @if($v->appStatus == 'voting')
        <script type="text/javascript" src="/site/js/Voting.js?{{ $v->rand }}"></script>
        <link rel="stylesheet" type="text/css" href="/site/css/voting.css?{{ $v->rand }}">
    @endif
    <script type="text/javascript" src="/site/js/Pages.js?{{ $v->rand }}"></script>
    <script type="text/javascript" src="/site/js/Ellection.js?{{ $v->rand }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="/site/css/ellection.css?{{ $v->rand }}">
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
@endsection
@section('bg_main_content')
    <div id="gaveta" class="{{ \App\Application::Info()->status }}">
        <div class="menu">
            <img src="/site/media/images/{{env("APP_LOGO")}}">
            <ul>
                <li><a href="/sobre">SOBRE O PRÊMIO</a> </li>
                <li><a href="/indicacao/termos">REGULAMENTO</a> </li>
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

        <div id="indicados" class="nano-content">
            <ul id="ul-gaveta">
                {{-- Montado via JS --}}
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <script type="text/javascript">
        window.fbAsyncInit = function() {
            FB.init({
                appId       : '{{ env("FB_APP_ID") }}',//'139520189890905',//'139520189890905', // Set YOUR APP ID - produçao azure  1685282121713164
                oauth       : true,
                status      : true, // check login status
                cookie      : true, // enable cookies to allow the server to access the session
                xfbml       : true,  // parse XFBML
                version     : 'v2.10',
                channelUrl  : '{{ env("APP_URL") }}' //custom channel
            });
        };


        $( function() {
            $( "#reference-tooltip" ).tooltip({
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
    </script>
    <div id="category" >
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div id="logo"></div>
    <div id="hero" style="background-image: url('/site/media/images/aceleradora.png')"></div>

    @if(\App\Application::Info()->status == 'ellection')
        <div id="form">
            <form id="mainform" name="mainform">
                <label>
                    <input type="text" name="indicated" maxlength="50">
                </label>

            <label>
                <input type="text" name="reference"  maxlength="150">
                <span class="referencia" id="reference-tooltip" title="Aqui vai a referência"><img src="/site/media/images/icon_referencia.png"></span>
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
            <div class="title">
                <div class="bg"></div>
                <div class="req">Requisitos da Categoria</div>
            </div>
            <ul>
                <li>
                    <span>Estar ativo</span>
                </li>
                <li>
                    <span>Ter sido host de no mínimo 3 eventos</span>
                </li>
            </ul>
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
                        <span class="ref-tooltip" title="Aqui vai a referência"><img src="/site/media/images/icon_referencia.png"></span>
                        <div class="cleaner"></div>
                    </div>

                    <div class="finalist">
                        <div class="check">
                            <div class="checked"></div>
                        </div>
                        <div class="name">{{--Nome do Indicado via JS--}}</div>
                        <span class="ref-tooltip" title="Aqui vai a referência"><img src="/site/media/images/icon_referencia.png"></span>
                        <div class="cleaner"></div>
                    </div>

                    <div class="finalist">
                        <div class="check">
                            <div class="checked"></div>
                        </div>
                        <div class="name">{{--Nome do Indicado via JS--}}</div>
                        <span class="ref-tooltip" title="Aqui vai a referência"><img src="/site/media/images/icon_referencia.png"></span>
                        <div class="cleaner"></div>
                    </div>
                </div>

                <div class="button" id="main-btn">
                    <span></span>
                    <span>
                        <div>VOTAR</div>
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
    @endif

@endsection
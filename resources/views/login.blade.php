@extends('index')

@section('scripts')
    <script type="text/javascript" src="/site/js/Login.js"></script>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="/site/css/login.css">
@endsection

@section('content')
{{--    {{ dd($errors->all()) }}--}}
    @if($errors->has('register'))
        <script>
            $(document).ready(function () {
                Script._modal('{{ $errors->get('register')[0] }}');
            })
        </script>
    @endif

    @if($errors->has('regFacebookError'))
        <script>
            $(document).ready(function () {
                Script._modal('{{ $errors->get('regFacebookError')[0] }}');
            })
        </script>
    @endif

    @if($errors->has('notFound'))
        <script>
            $(document).ready(function () {
                Script._modal('{{ $errors->get('notFound')[0] }}');
            })
        </script>
    @endif

    <script type="text/javascript">
        Login.FB_APP_ID = '{{ \App\Http\Controllers\Controller::$FB_APP_ID }}';


        window.fbAsyncInit = function() {
            FB.init({
                appId       : Login.FB_APP_ID,//'139520189890905', // Set YOUR APP ID - produçao azure  1685282121713164
                oauth       : true,
                status      : true, // check login status
                cookie      : true, // enable cookies to allow the server to access the session
                xfbml       : true,  // parse XFBML
                version     : 'v2.10',
                channelUrl  : '{{ env("APP_URL") }}' //custom channel
            });

            FB.getLoginStatus(function(response) {

                //Deslogar qualquer usuário que ja esteja logado
                if (response.status == 'connected') {
                    FB.logout();
                }
//                statusChangeCallback(response);
//                console.log("Response is: ", response);
            });
        };
    </script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    {{--<div id="facebook-jssdk"></div>--}}
    {{--{{ dd( env('APP_URL') ) }}--}}
    <div id="login">
        <img id="logo" src="/site/media/images/logo-cadastro.png">

        <div id="text">
            <span>Feito pela comunidade, para a comunidade, esté é o Startup Awards!</span>
            <br>
            <span>A premiação que você esperou o ano inteiro. Indique, vote e participe</span>
        </div>

        <div id="actions">

            {{--<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>--}}
            <div onclick="Login.fbLogin()" class="button light fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" data-scope="public_profile,email">
                <span></span>
                <span>
                    <div>FACEBOOK</div>
                </span>
            </div>

            <div class="_ou">OU</div>

            <div class="button light">
                <span></span>
                <span>
                    <div><a href="/registro">CADASTRE-SE</a></div>
                </span>
            </div>

        </div>
    </div>
@endsection
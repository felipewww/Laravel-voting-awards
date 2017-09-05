@extends('index')

@section('scripts')
    {{--<script type="text/javascript" src="/site/js/static.js"></script>--}}
    <script type="text/javascript">
        function agree() {
            $.ajax({
                url: '/indicacao/agree',
                data: { _token: window.csrfToken },
                dataType: 'json',
                success: function (data) {
                    if (data.status) {
                        window.location.href = '/indicacao'
                    }else{
                        Script._modal('Houve um erro ao aceitar, tente novamente.');
                    }
                },
                error: function () {
                    Script._modal('Houve um erro ao aceitar, Entre em contato conosco.');
                }
            })
        }
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="/site/css/sobre.css">
@endsection

@section('content')
    <div id="login">
        <img id="logo" src="/site/media/images/logo-cadastro.png">

        <div id="text">
            <h1>SOBRE O PRÊMIO</h1>
            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet libero odio. Aenean rutrum tellus id lorem cursus, quis maximus tellus condimentum. Vivamus nec iaculis magna. Nam at elit eu lorem porttitor vehicula suscipit vel dolor. Proin sed nibh a lectus fermentum sodales a sed risus. Nullam sed nisi nec diam mollis tempus. Maecenas mi ligula, facilisis semper ex sed, sodales rhoncus magna. Cras iaculis ante in convallis cursus. In hac habitasse platea dictumst.</span>
        </div>

        <div id="actions">
            <div  class="button light fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" data-scope="public_profile,email">
                <span></span>
                <span class="_link">
                    <a href="/"></a>
                    <div>ENTENDI</div>
                </span>
            </div>

            {{--<div class="button light">--}}
                {{--<span></span>--}}
                {{--<span class="_link">--}}
                    {{--<a href="javascript:agree();"></a>--}}
                    {{--<div><a href="/registro">EU ACEITO</a></div>--}}
                {{--</span>--}}
            {{--</div>--}}

        </div>
    </div>
@endsection
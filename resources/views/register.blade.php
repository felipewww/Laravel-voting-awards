@extends('index')

@section('scripts')
    <script type="text/javascript" src="/site/js/register.js"></script>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="/site/css/register.css">
@endsection

@section('content')
    @if($errors->has('userError'))
        <script>
            $(document).ready(function () {
                Script._modal('{{ $errors->get('userError')[0] }}');
            })
        </script>
    @endif
    <div id="login">
        <img id="logo" src="/site/media/images/logo-cadastro.png">

        <div id="text">
            <span>Cadastre-se e receba no e-mail o link para começar a indicar.</span>
        </div>

        <form name="reg" method="post" action="/registro">
            {{ csrf_field() }}
{{--            {!! Recaptcha::render() !!}--}}
            <label>
                <span></span>
                <input name="name">
            </label>

            <label>
                <span></span>
                <input name="email">
            </label>

            <div class="cleaner"></div>
        </form>

        <div id="actions">
            <div class="button light fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" data-scope="public_profile,email">
                <span></span>
                <span>
                    <div><a href="/">CANCELAR</a></div>
                </span>
            </div>

            <div class="_ou">OU</div>

            <div class="button light">
                <span></span>
                <span>
                    {{--<button type="submit">CADASTRAR</button>--}}
                    <div onclick="Register.submit()">CADASTRAR</div>
                </span>
            </div>

        </div>
    </div>
@endsection
@extends('index')

@section('scripts')
    <script type="text/javascript" src="/site/js/Login.js"></script>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="/site/css/login.css">
@endsection

@section('content')
    <div id="login">
        <img id="logo" src="/site/media/images/logo-cadastro.png">

        <div id="text">
            <span>Feito pela comunidade, para a comunidade, esté é o Startup Awards!</span>
            <br>
            <span>A premiação que você esperou o ano inteiro. Indique, vote e participe</span>
        </div>

        <div id="actions">

            <div class="button light">
                <span></span>
                <span>
                    <div>FACEBOOK</div>
                </span>
            </div>

            <div class="_ou">OU</div>

            <div class="button light">
                <span></span>
                <span>
                    <div>CADASTRE-SE</div>
                </span>
            </div>

        </div>
    </div>
@endsection
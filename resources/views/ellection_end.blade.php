@extends('index')

@section('scripts')
    <script type="text/javascript" src="/site/js/Login.js"></script>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="/site/css/login.css">
@endsection

@section('content')
    <div id="content">
        <div id="login">
            <img id="logo" src="/site/media/images/{{env('APP_LOGO')}}">
            <div id="text">
                <span class="yellow">O PERÍODO DE INDICAÇÃO TERMINOU.</span>
                <span>Acesse o site dia 29 de outubro para conferir os finalistas de cada categoria</span>
            </div>
        </div>
    </div>
@endsection
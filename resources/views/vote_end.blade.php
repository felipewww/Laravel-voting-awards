@extends('index')

@section('scripts')
    <script type="text/javascript">
        ellectionInfo = JSON.parse('<?= $v->info ?>');
    </script>
    <script type="text/javascript" src="/site/js/Pages.js"></script>
    <script type="text/javascript" src="/site/js/VoteEnd.js"></script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="/site/css/ellection.css">
    <link rel="stylesheet" type="text/css" href="/site/css/vencedores.css">
    <link rel="stylesheet" type="text/css" href="/site/css/fonts/icon/flaticon.css">
@endsection

@section('main_content')
    <div id="pagesBar"></div>
@endsection

@section('content')
    <div id="content" class="text">
        <div id="logo"></div>
        <div id="hero" style="background-image: url('/site/media/images/aceleradora.png')"></div>
        <div id="category" >
            <div></div>
            <div></div>
            <div></div>
        </div>


        <div id="publicInfo">

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
                <div class="req">O vencedor será anunciado</div>
            </div>
            <ul id="requl">
                <li>
                    <span>Dia 27/10 no evento CASE</span>
                </li>
            </ul>
        </div>
    </div>
@endsection
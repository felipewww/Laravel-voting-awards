@extends('index')

@section('scripts')
    {{--<script type="text/javascript" src="/js/enscroll-0.6.2.min.js"></script>--}}
    <script type="text/javascript" src="/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".nano").nanoScroller({
                alwaysVisible: true
            });
        });
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="/js/nanoscroller.css">
    <link rel="stylesheet" type="text/css" href="/site/css/sobre.css">
@endsection

@section('content')
    <div id="content" class="text">
        <div>
            <img id="logo" src="/site/media/images/{{ env('APP_LOGO') }}">

            <div class="nano">
                <div class="nano-content">
                    O Startup Awards é uma cerimônia de premiação para prestigiar os mais influentes agentes do cenário do empreendedorismo digital brasileiro através da entrega do prêmio Startup Awards, em 11 (onze) categorias, através de indicação e votação da Academia ABStartups.
                    <br>
                    <br>
                    O prêmio será entregue aos vencedores de cada categoria no dia 27 de outubro de 2017 durante o CASE – Conferência Anual de Startups e Empreendedorismo, no Espaço Pró-Magno, em São Paulo.
                    <br>
                    <br>
                    Consulte o regulamento.
                    <br>
                    <br>
                    Duvidas?
                    <br>
                    contato@abstartups.com.br
                </div>
            </div>
            <div id="actions">
                <div class="button light">
                    <span></span>
                    <span class="_link">
                            <a href="/indicacao"></a>
                            <div>VOLTAR</div>
                        </span>
                </div>
            </div>
        </div>
    </div>
@endsection
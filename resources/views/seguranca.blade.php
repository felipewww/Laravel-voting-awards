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
                    A plataforma de indicação e votação do Startup Awards 2017 foi desenvolvida utilizando as melhores práticas de segurança. Apesar deste fato, todas as indicações são verificadas e facilmente identificadas no caso de qualquer utilização indevida da plataforma.
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
@extends('index')

@section('scripts')
    <script type="text/javascript" src="/site/js/Vencedores.js"></script>
    <script type="text/javascript" src="/js/jquery.nanoscroller.min.js"></script>

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

        publicAppId = '{{ env("FB_APP_ID") }}';
        Vencedores.winners = JSON.parse('{!! json_encode($vars->winners) !!}');

        $(document).ready(function () {
            $(".nano").nanoScroller({
                alwaysVisible: true
            });
        });
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="/js/nanoscroller.css">
    <link rel="stylesheet" type="text/css" href="/site/css/vencedores.css">
@endsection

@section('content')
    <div id="content" class="text">
        <div>
            <img id="logo" src="/site/media/images/{{ env('APP_LOGO') }}">

            <div class="nano">
                <div class="nano-content">
                    FIM!!! Ganhadores a serem exibidos a partir do dia 28/10
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
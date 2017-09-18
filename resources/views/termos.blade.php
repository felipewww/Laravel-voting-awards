@extends('index')

@section('scripts')
    <script type="text/javascript" src="/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript" src="/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".nano").nanoScroller({
                alwaysVisible: true
            });
        });
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
    <link rel="stylesheet" type="text/css" href="/js/nanoscroller.css">
    <link rel="stylesheet" type="text/css" href="/site/css/termos.css">
@endsection

@section('content')
    <div id="login">
        <img id="logo" src="/site/media/images/{{ env('APP_LOGO') }}">

        <div class="nano">
            <div class="nano-content">
                Curabitur molestie, velit id dignissim luctus, eros ante pellentesque orci, ac pharetra dolor risus vitae lectus. Sed libero ante, imperdiet ut elit vestibulum, convallis commodo turpis. Nullam dapibus, mi eget egestas egestas, ligula risus fringilla lorem, vel fringilla quam mi vitae magna. Nullam finibus pharetra aliquam. Vestibulum nec turpis imperdiet, porta diam ut, auctor justo. Suspendisse potenti. Morbi sit amet nibh sed tellus lacinia egestas vitae vitae mi. Pellentesque lobortis diam augue, euismod gravida turpis vulputate mollis. Proin tortor nisi, pretium et iaculis nec, faucibus eget magna. Donec finibus pharetra ligula, eget consectetur ligula venenatis sed. Etiam feugiat leo ut auctor vestibulum. Praesent egestas nunc ac congue hendrerit. Aenean purus dui, rhoncus iaculis elit non, elementum vestibulum mi. Vivamus consequat urna at posuere malesuada. Praesent dapibus sollicitudin eros, elementum interdum tellus malesuada eu. Sed ut purus at magna imperdiet pharetra.
            </div>
        </div>
        <div id="actions">
            @if(Auth::user()->agreed!=1)

                    <div  class="button light fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" data-scope="public_profile,email">
                        <span style="border-color: #545454"></span>
                        <span class="_link">
                            <a href="/"></a>
                            <div>NÃO ACEITO</div>
                        </span>
                    </div>

                    <div class="button light">
                        <span></span>
                        <span class="_link">
                            <a href="javascript:agree();"></a>
                            <div>EU ACEITO</div>
                        </span>
                    </div>
            @else
                <div class="button light">
                    <span></span>
                        <span class="_link">
                            <a href="/indicacao"></a>
                            <div>VOLTAR</div>
                        </span>
                </div>
            @endif
        </div>

    </div>
@endsection
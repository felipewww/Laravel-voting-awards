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
    <div id="content">
        <div>
            <img id="logo" src="/site/media/images/{{ env('APP_LOGO') }}">
            <div id="text">
                <span class="yellow">Cadastre-se e receba no e-mail o link para começar a indicar.</span>
                    <form name="reg" method="post" action="/registro">
                    {{ csrf_field() }}
        {{--            {!! Recaptcha::render() !!}--}}
                    <label>
                        {{--<span></span>--}}
                        <input name="name" placeholder="nome">
                    </label>

                    <label>
                        {{--<span></span>--}}
                        <input name="email" placeholder="e-mail">
                    </label>

                    <div class="cleaner"></div>
                </form>
            </div>
            <div id="actions">
                <div class="button light" onclick="Register.submit()">
                    <span></span>
                    <span>
                        <div>CADASTRAR</div>
                    </span>
                </div>

                <div class="button light btn-cancel">
                    <span></span>
                    <span class="_link">
                        <a href="/"></a>
                        <div>CANCELAR</div>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
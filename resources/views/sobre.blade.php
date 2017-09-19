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

{{--@section('specific_content')--}}
@section('content')
    <div id="content" class="text">
        <div>
            <img id="logo" src="/site/media/images/{{env('APP_LOGO')}}">

            <div class="nano">
                <div class="nano-content">
                    Curabitur molestie, velit id dignissim luctus, eros ante pellentesque orci, ac pharetra dolor risus vitae lectus. Sed libero ante, imperdiet ut elit vestibulum, convallis commodo turpis. Nullam dapibus, mi eget egestas egestas, ligula risus fringilla lorem, vel fringilla quam mi vitae magna. Nullam finibus pharetra aliquam. Vestibulum nec turpis imperdiet, porta diam ut, auctor justo. Suspendisse potenti. Morbi sit amet nibh sed tellus lacinia egestas vitae vitae mi. Pellentesque lobortis diam augue, euismod gravida turpis vulputate mollis. Proin tortor nisi, pretium et iaculis nec, faucibus eget magna. Donec finibus pharetra ligula, eget consectetur ligula venenatis sed. Etiam feugiat leo ut auctor vestibulum. Praesent egestas nunc ac congue hendrerit. Aenean purus dui, rhoncus iaculis elit non, elementum vestibulum mi. Vivamus consequat urna at posuere malesuada. Praesent dapibus sollicitudin eros, elementum interdum tellus malesuada eu. Sed ut purus at magna imperdiet pharetra.
                </div>
            </div>

            <div id="actions">
                <div  class="button light">
                    <span style="border-color: #545454;"></span>
                    <span class="_link">
                        <a href="/indicacao"></a>
                        <div>VOLTAR</div>
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
    </div>
@endsection
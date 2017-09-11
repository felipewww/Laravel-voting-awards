@extends('index')

@section('scripts')
    <script type="text/javascript" src="/js/jquery.nanoscroller.min.js"></script>
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
            <div class="button light">
                <span></span>
                <span class="_link">
                    <a href="/indicacao"></a>
                    <div>ENTENDI</div>
                </span>
            </div>
        </div>
    </div>
@endsection
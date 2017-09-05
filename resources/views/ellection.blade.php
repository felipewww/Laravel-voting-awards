@extends('index')

@section('scripts')
    <script type="text/javascript">
        ellectionInfo = JSON.parse('{!! json_encode($v->info) !!}');
    </script>
    <script type="text/javascript" src="/site/js/Pages.js?{{ $v->rand }}"></script>
    <script type="text/javascript" src="/site/js/Ellection.js?{{ $v->rand }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="/site/css/ellection.css?{{ $v->rand }}">
@endsection

@section('bg_main_content')
    <div id="pagesBar"></div>
@endsection

@section('content')
    {{--{{ dd($v->cats) }}--}}

    {{--@foreach($v->cats as $cat)--}}
    {{--<div id="cat_{{$cat->id}}">--}}
        <div id="category" >
            <div>ACE</div>
            <div>LERA</div>
            <div>DORA</div>
        </div>

        <div id="hero" style="background-image: url(/site/media/images/aceleradora.png)"></div>

        <div id="form">
            <form id="mainform" name="mainform">
                <label>
                    <input type="text" name="indicated">
                </label>

                <label>
                    <input type="text" name="reference">
                </label>

                <div onclick="Ellection.send()" class="button">
                    <span></span>
                    <span>
                        <div>INDICAR</div>
                    </span>
                </div>
            </form>
        </div>

        <div id="req">
            <ul>
                <li>Estar ativo</li>
                <li>Planos específicos para Startups na cidade onde atua</li>
                <li>Ter sido host de no mínimo 3 eventos</li>
            </ul>
        </div>
    {{--</div>--}}
    {{--@endforeach--}}

@endsection
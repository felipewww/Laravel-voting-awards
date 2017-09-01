@extends('index')

@section('scripts')
    <script type="text/javascript" src="/site/js/Pages.js"></script>
    <script type="text/javascript" src="/site/js/Ellection.js"></script>
@endsection

@section('bg_main_content')
    <div id="pagesBar"></div>
@endsection

@section('content')
    {{--{{ dd($v->cats) }}--}}

    @foreach($v->cats as $cat)
    <div id="cat_{{$cat->id}}">
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

                <div class="button">
                    <span></span>
                    <span>
                        <div>INDICAR</div>
                    </span>
                </div>
            </form>
        </div>
    </div>
    @endforeach

@endsection
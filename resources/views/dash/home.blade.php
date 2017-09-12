@extends('dash.main')

@section('styles')
    <style>
        table.setDataTables td {
            padding: 10px 0;
            border-bottom: 1px solid #edf1f5;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title"><a href="">Aguardando Aprovação</a></h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash"></div>
                    </li>
                    <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">{{ \App\Nominateds::where('valid',0)->count() }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Votos Válidos</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash2"></div>
                    </li>
                    <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">{{ \App\Nominateds::where('valid',1)->count() }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Ações Estranhas</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash3"></div>
                    </li>
                    <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">{{ \App\WeirdTries::all()->count() }}</span></li>
                </ul>
            </div>
        </div>
    </div>

    {{--DATATABLES--}}
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <table class="setDataTables">
                    <tbody>
                    {{--The HTML into this TR represents the setup info where JS get and configure this datatables.--}}
                    <tr>
                        <td class="columns">{!! $dataTables['columns'] !!}</td>
                        <td class="info" data-orderby="2">{!! $dataTables['info'] !!}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--DATATABLES--}}
@endsection
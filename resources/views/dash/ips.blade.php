@extends('dash.main')

@section('content')
    A página de IPs mais usados.
    -> <a href="/panel/ips/byuser/192.168.0.1">Ir para filtro de usuarios naquele IP</a>

    {{--DATATABLES--}}
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                {{--<div class="col-md-3 col-sm-4 col-xs-6 pull-right">--}}
                <table class="setDataTables">
                    <tbody>
                    {{--The HTML into this TR represents the setup info where JS get and configure this datatables.--}}
                    <tr>
                        <td class="columns">{!! $dataTables['columns'] !!}</td>
                        <td class="info">{!! $dataTables['info'] !!}</td>
                    </tr>
                    </tbody>
                </table>
                {{--</div>--}}
            </div>
        </div>
    </div>
    {{--DATATABLES--}}
@endsection
@extends('dash.main')

@section('content')
    {{--DATATABLES--}}
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <br>
                <br>
                <table class="setDataTables">
                    <tbody>
                    <tr>
                        <td class="columns">{!! $dataTables['columns'] !!}</td>
                        <td class="info" data-orderby="1">{!! $dataTables['info'] !!}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--DATATABLES--}}
@endsection
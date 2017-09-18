@extends('dash.main')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box col s12">
                {{--Aqui vem um form para cadastrar Finalista na categoria via ajax--}}
                <form class="form-vertical form-material" method="post" action="/panel/app/status">
                    {{ csrf_field() }}
                    <div class="form-group col-md-10">
                        <label class="col-md-12">Status</label>
                        <div class="col-md-12">
{{--                                {{ dd($vars) }}--}}
                            <select class="form-control" name="status">
                                @foreach($vars->status as $status => $v)
                                    <option value="{{ $status }}" {{ ($status == $app['status']) ? 'selected="selected"' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 label-spacer">
                        <div class="label-spacer"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    {{--DATATABLES--}}
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                {{--Aqui vem a tabela dos usuarios aprovados para VOTAR em finalistas, qtde de votos, link para perfil do ssitema e facebook.--}}
                <table class="setDataTables">
                    <tbody>
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
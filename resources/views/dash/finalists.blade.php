@extends('dash.main')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box col s12">
                {{--Aqui vem um form para cadastrar Finalista na categoria via ajax--}}
                <form class="form-vertical form-material" method="post" action="/panel/finalista/store">
                    {{ csrf_field() }}
                    <div class="form-group col-md-5">
                        <label class="col-md-12">Nome do Finalista</label>
                        <div class="col-md-12">
                            <input type="text" name="name" placeholder="Startp Awards 2017" class="form-control form-control-line">
                        </div>
                    </div>

                    <div class="form-group col-md-5">
                        <label class="col-md-12">Categoria</label>
                        <div class="col-md-12">
                            <select class="form-control" name="categorie">
                                @foreach($vars->categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 label-spacer">
                        <div class="label-spacer"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Criar</button>
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
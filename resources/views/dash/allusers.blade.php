@extends('dash.main')

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.AjaxDataTables').DataTable({
                ajax: {
                    url: "/panel/users/all/ajax",
                    type: 'POST',
                },
                serverSide: true,
                order: [[ 1, "asc" ]]
            });


        });
    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <table class="AjaxDataTables">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Indicações</th>
                            <th>IP</th>
                            <th>Email</th>
                            <th>From</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    {{--DATATABLES--}}
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <table class="setDataTables_bak">
                    <tbody>
                    {{--The HTML into this TR represents the setup info where JS get and configure this datatables.--}}
                    <tr>
{{--                        <td class="columns">{!! $dataTables['columns'] !!}</td>--}}
                        {{--<td class="info" data-orderby="1" data-orderby-direction="asc">{!! $dataTables['info'] !!}</td>--}}
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--DATATABLES--}}
@endsection
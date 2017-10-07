@extends('dash.main')

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.AjaxDataTables').DataTable({
                ajax: {
                    url: "/panel/aguardando/ajax",
                    type: 'POST',
                },
                serverSide: true,
                order: [[ 1, "asc" ]],
                "columnDefs": [
                    { "orderable": false, "targets": [,3,4,5] }
                ]
            });

            // Call datatables, and return the API to the variable for use in our code
            // Binds datatables to all elements with a class of datatable
            var dtable = $(".AjaxDataTables").dataTable().api();


            $(".dataTables_filter input").unbind().on('keypress', function (event) {
                if (event.keyCode == 13) {
                    dtable.search(this.value).draw();
                }
            })

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
                            <th>Indicado</th>
                            <th>Referência</th>
                            <th>Categoria</th>
                            <th>Usuário</th>
                            <th>IP</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
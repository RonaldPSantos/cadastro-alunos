@extends('layouts.app')

@section('content')
    <hr>
    <a class="btn btn-primary" href="{{ route('admin.students.create') }}">{{ _('CADASTRAR') }}</a>
    <hr>
    <table class="data-table cell-border compact stripe hover">
        <thead>
            <tr>
                <th>CÓDIGO</th>
                <th>NOME</th>
                <th>SITUAÇÃO</th>
                <th>AÇÕES</th>
            </tr>
        </thead>
    </table>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.students.index') }}",
                columns: [{
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var status = 'ATIVO'
                            if (!data) {
                                var status = 'INATIVO'
                            }
                            return status;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                        targets: 0,
                        className: 'dt-body-center dt-head-center',
                    },
                    {
                        targets: 1,
                        className: 'dt-body-left dt-head-center',
                    },
                    {
                        targets: 2,
                        className: 'dt-body-center dt-head-center',
                    },
                    {
                        targets: 3,
                        className: 'dt-body-center dt-head-center',
                    }
                ],
                language: {
                    processing: "Carregando dados...",
                    search: "Pesquisar&nbsp;:",
                    lengthMenu: "Exibindo _MENU_ resultados",
                    infoFiltered: "Exibindo de _MAX_ resultados disponíveis",
                    info: "",
                    infoPostFix: "",
                    loadingRecords: "Carregando...",
                    zeroRecords: "Nenhum registro encontrado",
                    emptyTable: "Sem dados disponíveis na base de dados",
                    paginate: {
                        first: "Primeiro",
                        previous: "Anterior",
                        next: "Próximo",
                        last: "Último"
                    },
                    aria: {
                        sortAscending: ": ative para classificar a coluna em ordem crescente",
                        sortDescending: ": ative para classificar a coluna em ordem decrescente"
                    }
                }
            });

        });

    </script>
@endsection

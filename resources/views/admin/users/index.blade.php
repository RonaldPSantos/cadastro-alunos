@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-primary">CADASTRAR
            USUÁRIO</a> --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NOME</th>
                    <th>ROLES</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ implode(
                            ', ',
                            $user->roles()->get()->pluck('name')->toArray(),
                        ) }}</td>
                    <td>
                        <div class="btn-group">
                            @can('edit-users', Model::class)
                                <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                    class="btn btn-warning">EDITAR</a>
                            @endcan

                            @can('remove-users', Model::class)
                                <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST"
                                    class="float-left">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">REMOVER</button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
                </tr>
            </tbody>
        </table>


    </div>
@endsection()

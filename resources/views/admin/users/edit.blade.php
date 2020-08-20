@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Usuário</h1>
        <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method("PUT")

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" class="form-control" @error('email') is-invalid @enderror value="{{ $user->email }}">
            </div>
            <div class="form-group">
                @foreach ($roles as $role)
                    <div class="form-check">
                        <input type="checkbox" name="roles[]" id="roles" class="" value="{{ $role->id }}"
                        @if ($user->roles->pluck('id')->contains($role->id))
                            checked
                        @endif>
                        <label for="">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>
            <div>
                <button type="submit" class="btn btn-lg btn-success">SALVAR</button>
            </div>
        </form>
    </div>
@endsection

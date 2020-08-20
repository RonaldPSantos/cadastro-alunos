@extends('layouts.app')

@section('content')
    <hr>
    <h4>Cadastrar aluno</h4>
    <hr>
    <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="name">Código</label>
            <input type="text" name="code" id="name" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="">Cursos</label>
            <select name="courses[]" id="" class="form-control" multiple>
                @foreach ($courses as $course)
                    <option value="{{ @$course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Foto</label>
            <input type="file" name="photo" class="form-control @error('photo.*') is-invalid @enderror">
        </div>
        <hr>
        <div>
            <button type="submit" class="btn btn-md btn-success">SALVAR</button>
        </div>
    </form>

@endsection

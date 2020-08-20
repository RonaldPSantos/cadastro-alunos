@extends('layouts.app')

@section('content')
    <hr>
    <h4>Editar aluno</h4>
    <hr>
    <form action="{{ route('admin.students.update', ['student' => $student->id]) }}" method="POST"
        enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="name">Código</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $student->code }}">
        </div>
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $student->name }}">
        </div>
        <div class="form-group">
            <label for="">Cursos</label>
            <select name="courses[]" id="" class="form-control" multiple>
                @foreach ($courses as $course)
                    <option value="{{ @$course->id }}" @if ($student->courses->contains($course)) selected
                @endif>
                {{ $course->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Foto</label>
            <input type="file" name="photo" class="form-control @error('photo.*') is-invalid @enderror">
        </div>
        <hr>
        <div>
            <button type="submit" class="btn btn-md btn-success">ATUALIZAR</button>
        </div>
    </form>
    @if ($student->photo)
        <hr>
        <div class="row">
            <div class="col-4 text-center">
                <img src="{{ asset('storage/' . $student->photo) }}" alt="" class="img-fluid">
                <p></p>
                <form action="{{ route('admin.photo.remove', ['student' => $student->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="photoName" value="{{ $student->photo }}">
                    <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                </form>
            </div>
        </div>
    @endif

@endsection

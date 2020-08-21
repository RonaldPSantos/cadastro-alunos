@extends('layouts.app')

@section('content')
    <hr>
    <h4>Editar Curso</h4>
    <hr>
    <form action="{{ route('admin.courses.update', ['course' => $course->id]) }}" method="POST"
        enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="name">Código</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ $course->code }}">
        </div>
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $course->name }}">
        </div>
    
        <hr>
        <div>
            <button type="submit" class="btn btn-md btn-success">ATUALIZAR</button>
        </div>
    </form>

@endsection

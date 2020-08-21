@extends('layouts.app')

@section('content')
    <hr>
    <h4>Importar cursos</h4>
    <hr>
    <form action="{{ route('admin.coursesImport.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="">Arquivo XML</label>
            <input type="file" name="arquivo-xml" id="arquivo-xml" class="form-control @error('arquivo-xml.*') is-invalid @enderror">
        </div>
        <hr>
        <div>
            <button type="submit" class="btn btn-md btn-success">IMPORTAR</button>
        </div>
    </form>

@endsection

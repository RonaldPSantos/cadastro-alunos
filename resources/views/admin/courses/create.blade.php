@extends('layouts.app')

@section('content')
    <hr>
    <h4>Cadastrar curso</h4>
    <hr>
    <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="name">Código</label>
            <input type="text" name="code" id="code" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="">
        </div>
        <hr>
        <div>
            <button type="submit" class="btn btn-md btn-success">SALVAR</button>
        </div>
    </form>

@endsection

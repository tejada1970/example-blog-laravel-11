@extends('adminlte::page')

@section('title', 'Mi blog personal')

@section('content_header')
    <h1>Crear nueva categoría</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- creamos un 'form' con html normal --}}
            <form class="laravelForm" action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control name" autocomplete="off" placeholder="Ingrese el nombre de la categoría">
                    <span class="text-danger error-name"></span>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control slug" placeholder="Ingrese el slug de la categoría" readonly>
                    <span class="text-danger error-slug"></span>
                </div>
                <button type="submit" class="btn btn-primary">Crear categoría</button>
            </form>
        </div>
    </div>
@stop

@section('js')
    {{-- los componentes se encuentran en resources/views/components/ --}}
    <x-script-slug-autoCompleted />
    <x-script-submit-validateErrors />
@stop
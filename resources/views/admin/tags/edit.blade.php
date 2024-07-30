@props(['tag'])

@extends('adminlte::page')

@section('title', 'Mi blog personal')

@section('content_header')
    <h1>Editar etiqueta</h1>
@stop

@section('content')
    <div class="contentAlert">
        {{-- la alerta se incluye desde el componente 'script-submit-validateErrors.blade.php' --}}
    </div>
    <div class="card">
        <div class="card-body">
            {{-- creamos un 'form' con html normal --}}
            <form class="laravelForm" action="{{ route('admin.tags.update', $tag) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control name" value="{{ $tag->name }}" autocomplete="off" placeholder="Ingrese el nombre de la etiqueta">
                    <span class="text-danger error-name"></span>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control slug" value="{{ $tag->slug }}" placeholder="Ingrese el slug de la etiqueta" readonly>
                    <span class="text-danger error-slug"></span>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar etiqueta</button>
            </form>
        </div>
    </div>
@stop

@section('js')
    {{-- los componentes se encuentran en resources/views/components/ --}}
    <x-script-slug-autoCompleted />
    <x-script-submit-validateErrors />
@stop
@extends('adminlte::page')

@section('title', 'Mi blog personal')

@section('content_header')
    <a class="btn btn-secondary float-right" href="{{route('admin.categories.create')}}">
        Agregar categoría
    </a>
    <h1>Listado de categorías</h1>
@stop

{{-- la plantilla 'lte' esta hecha con 'bootstrap' --}}
{{-- así que para crear una 'tarjeta' con bootstrap, lo hacemos de esta forma --}}
{{-- y para la 'table' también utilizaremos bootstrap --}}
{{-- para más información ver videotutorial: Blog autoadministrable desde cero-laravel-jetstream (10-Crud de categorías) --}}

@section('content')
    {{-- alerta --}}
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    {{-- card --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td width="10px">
                                <a class="btn btn-primary btn-sm" href="{{route('admin.categories.edit', $category)}}">
                                    Editar
                                </a>
                            </td>
                            <td width="10px">
                                <form action="{{route('admin.categories.destroy', $category)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

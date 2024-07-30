@extends('adminlte::page')

@section('title', 'Mi blog personal')

@section('content_header')
    <h1>Editar post</h1>
@stop

@section('content')
    <div class="contentAlert">
        {{-- la alerta se incluye desde el componente 'script-submit-validateErrors.blade.php' --}}
    </div>
    <div class="card">
        <div class="card-body">
            {{-- creamos un 'form' con html normal --}}
            <form class="laravelForm" action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control name" value="{{ old('name', $post->name) }}" autocomplete="off" placeholder="Ingrese el nombre del post">
                    <span class="text-danger error-name"></span>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control slug" value="{{ old('slug', $post->slug) }}" placeholder="Ingrese el slug del post" readonly>
                    <span class="text-danger error-slug"></span>
                </div>
                <div class="form-group">
                    <label for="category_id">Categoría</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}" {{ $id == old('category_id', $post->category_id) ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error-category_id"></span>
                </div>
                <div class="form-group">
                    <p class="font-weight-bold">Etiquetas</p>
                    @foreach ($tags as $tag)
                        <label class="mr-2">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                            {{ $tag->name }}
                        </label>
                    @endforeach
                    <br />
                    <span class="text-danger error-tags"></span>
                </div>
                <div class="form-group mb-3">
                    <p class="font-weight-bold">Estado</p>
                    <label>
                        <input type="radio" name="status" value="1" {{ old('status', $post->status) == 1 ? 'checked' : '' }}>
                        Borrador
                    </label>
                    <label class="ml-3">
                        <input type="radio" name="status" value="2" {{ old('status', $post->status) == 2 ? 'checked' : '' }}>
                        Publicado
                    </label>
                    <br />
                    <span class="text-danger error-status"></span>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="image-wrapper">
                            @if ($post->image)
                                <img id="picture" class="w-full h-72 object-cover object-center" src="{{Storage::url($post->image->url)}}" alt="imagen del post">
                            @else
                                <img id="picture" class="w-full h-72 object-cover object-center" src="https://cdn.pixabay.com/photo/2020/04/02/22/55/santorini-4996901_1280.jpg" alt="imagen del post">
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="file">Imagen que se mostrará en el post</label>
                            <input type="file" name="file" id="file" class="form-control-file">
                            <span class="text-danger error-file"></span>
                        </div>
                        <span class="font-weight-bold">Caracteristicas de la imagen:</span>
                        <p>Tipo de archivo: El archivo debe ser una imagen.<br />Tipos MIME permitidos para el archivo: jpg, jpeg, png, jfif, webp.<br />Tamaño máximo permitido: El archivo no puede superar los 2048 KB.</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="extract">Extracto</label>
                    <textarea name="extract" id="extract" class="form-control">{{ old('extract', $post->extract) }}</textarea>
                    <span class="text-danger error-extract"></span>
                </div>
                <div class="form-group">
                    <label for="body">Cuerpo del post</label>
                    <textarea name="body" id="body" class="form-control">{{ old('body', $post->body) }}</textarea>
                    <span class="text-danger error-body"></span>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar post</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css" />
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%;
        }
        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@stop

@section('js')
    {{-- los componentes se encuentran en resources/views/components/ --}}
    <x-script-slug-autoCompleted />
    <x-script-submit-validateErrors />
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.1/"
            }
        }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph,
            Link,
            List,
            Table,
            BlockQuote
        } from 'ckeditor5';
    
        ClassicEditor
            .create( document.querySelector( '#extract' ), {
                plugins: [ Essentials, Bold, Italic, Font, Paragraph, Link, List, Table, BlockQuote ],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                        'link', 'bulletedList', 'numberedList', '|', 'insertTable', '|', 'blockQuote'
                    ]
                }
            } )
            .then( /* ... */ )
            .catch( /* ... */ );

        ClassicEditor
            .create( document.querySelector( '#body' ), {
                plugins: [ Essentials, Bold, Italic, Font, Paragraph, Link, List, Table, BlockQuote ],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                        'link', 'bulletedList', 'numberedList', '|', 'insertTable', '|', 'blockQuote'
                    ]
                }
            } )
            .then( /* ... */ )
            .catch( /* ... */ );
    </script>
    <x-script-selectFileImage />
@stop
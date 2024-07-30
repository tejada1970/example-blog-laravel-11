@extends('adminlte::page')

@section('title', 'Mi blog personal')

@section('content_header')
    <a class="btn btn-secondary float-right" href="{{route('admin.posts.create')}}">
        Agregar post
    </a>
    <h1>Listado de posts</h1>
@stop

@section('content')
    {{-- alerta --}}
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

    @livewire('admin.posts-index')

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro que deseas eliminar este post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            const modalBody = document.querySelector('#confirmDeleteModal .modal-body');
            let postIdToDelete = null;

            $(document).on('click', '.delete-button', function () {
                postIdToDelete = $(this).data('post-id');
                let postNameToDelete = $(this).data('post-name');
                modalBody.textContent = `¿Estás seguro que deseas eliminar el post "${postNameToDelete}"?`;
                confirmDeleteModal.show();
            });

            $('#confirmDeleteButton').on('click', function () {
                if (postIdToDelete) {
                    $('#delete-form-' + postIdToDelete).submit();
                }
            });
        });
    </script>
@stop

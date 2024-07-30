<div class="card">
    <div class="card-header">
        <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre de un post">
    </div>
    {{-- si existe una conincidencia como mínimo en el filtro de busqueda del input, se mostrarán los resultados --}}
    @if ($posts->count())
        <div class="card body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->name}}</td>
                            <td width="10px">
                                <a class="btn btn-primary btn-sm" href="{{route('admin.posts.edit', $post)}}">
                                    Editar
                                </a>
                            </td>
                            <td width="10px">
                                <form id="delete-form-{{ $post->id }}" action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-button" data-post-id="{{ $post->id }}" data-post-name="{{ $post->name }}">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{$posts->links()}}
        </div>
    @else
        {{-- en el caso de que no haya ninguna coincidencia --}}
        <div class="card-body">
            <strong>No se ha encontrado ninguna coincidencia</strong>
        </div>
    @endif
</div>
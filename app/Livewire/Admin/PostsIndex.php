<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class PostsIndex extends Component
{

    // para poder usar las paginaciones.
    use WithPagination;

    // para que muestre nuestra paginación con los estilos de 'bootstrap'.
    protected $paginationTheme = "bootstrap";

    // para que funcione correctamente nuestro buscador de posts.
    public $search;

    // esta función solo se activará cuando el valor de $search cambie.
    // dentro le diremos que nos resetee la paginación a medida que escribamos en el input de busqueda para que nos retorne a la página numero 1. Esto es para que la busqueda funcione correctamente desde todas las paginaciones.
    public function updatingSearch() {
        $this->resetPage();
    }

    public function render()
    {
        // devuelve el 'id' del usuario autenticado en la sesión activa.
        // esto devuelve solo todos los 'posts' del usuario autenticado.
        // latest-> nos los ordena de forma descencente para que nos muestre primero el último post creado.
        // paginate-> nos crea una paginación para navegar entre los posts. Es importante saber que la páginación solo aparecerá a partir de una cantidad miníma de 15 posts.
        
        $posts = Post::where('user_id', auth()->user()->id)
                        ->where('name', 'LIKE','%' . $this->search . '%')
                        ->latest('id')
                        ->paginate();

        return view('livewire.admin.posts-index', compact('posts'));
    }
}

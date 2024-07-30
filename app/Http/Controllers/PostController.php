<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // para la referencia del metodo 'published' de (app/Policies/PostPolicy.php)

class PostController extends Controller
{
    use AuthorizesRequests; // para la referencia del metodo 'published' de (app/Policies/PostPolicy.php)

    public function index() {
        $posts = Post::where('status', 2)->latest('id')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /* 
        En $similares recogemos lo siguiente:
        1. los 'posts' cuya 'categoría' coincida con el 'post' en el que nos encontremos.
        2. en los que el 'status' sea 2 (es decir, que esten publicados).
        3. en los que el 'id' sea distinto en el que nos encontremos.
        4. que los ordene de forma descendente (basandose en el campo id).
        5. que me muestre solo 4 'posts' de todos los que coincidan.
        6. por ultimo, ejecutamos el metodo 'get' para obtener todo lo especificado.
    */

    public function show(Post $post) {

        // Esta es la referencia del metodo 'published' de (app/Policies/PostPolicy.php).
        $this->authorize('published', $post);

        $similares = Post::where('category_id', $post->category_id)
                            ->where('status', 2)
                            ->where('id', '!=', $post->id)
                            ->latest('id')
                            // ->take(4)
                            ->get();
        return view('posts.show', compact('post', 'similares'));
    }

    public function category(Category $category) {
        $posts = Post::where('category_id', $category->id)
                        ->where('status', 2)
                        ->latest('id')
                        ->paginate(4);
        return view('posts.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag) {
        $posts = $tag->posts()->where('status', 2)->latest('id')->paginate(4);
        return view('posts.tag', compact('posts', 'tag'));
    }
}

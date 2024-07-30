<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    // Debemos agregar esta referencia de 'PostPolicy.php' en: (app/Htpp/Controllers/Admin/PostController.php/metodo 'edit').
    public function author(user $user, Post $post) {
        if ($user->id == $post->user_id) {
            return true;
        } else {
            return false;
        }
    }

    /* 
        - Debemos agregar esta referencia de 'PostPolicy.php' por fuera de 'Admin' en: (app/Htpp/Controllers/PostController.php/metodo 'show').
        - Ponemos ? delante de (user, $user), para que el parámetro sea opcional, y cuando cumpla con la 'Policy' no tenga en cuenta si el
        usuario esta o no esta autenticado, ya que no podemos suprimir (user, $user) porque 'Policy' nos obliga a declararlo.
    */
    public function published(?user $user, Post $post) {
        if ($post->status == 2) {
            return true;
        } else {
            return false;
        }
    }
}

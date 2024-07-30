<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // para la referencia del metodo 'author' de (app/Policies/PostPolicy.php)

class PostController extends Controller
{
    use AuthorizesRequests; // para la referencia del metodo 'author' de (app/Policies/PostPolicy.php)

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Category::all();
        // return $categories;
        /*
            El metodo all(): Nos devuelve un array de objetos con las categorías.
            Ejemplo de como se vería (categorías ficticias):
            [
                {
                    "id": 1,
                    "name": "aut",
                    "slug": "aut",
                    "created_at": "2024-06-13T21:02:03.000000Z",
                    "updated_at": "2024-06-13T21:02:03.000000Z"
                },
                {
                    "id": 2,
                    "name": "maiores",
                    "slug": "maiores",
                    "created_at": "2024-06-13T21:02:03.000000Z",
                    "updated_at": "2024-06-13T21:02:03.000000Z"
                },
                {
                    "id": 3,
                    "name": "debitis",
                    "slug": "debitis",
                    "created_at": "2024-06-13T21:02:03.000000Z",
                    "updated_at": "2024-06-13T21:02:03.000000Z"
                },
                {
                    "id": 4,
                    "name": "eaque",
                    "slug": "eaque",
                    "created_at": "2024-06-13T21:02:03.000000Z",
                    "updated_at": "2024-06-13T21:02:03.000000Z"
                }
            ]
        */
        
        $categories = Category::pluck('name', 'id');
        // return $categories;
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));

        /* 
            El metodo pluck(): Nos devuelve un objeto únicamente con el id y nombre de las categorías.
            Ejemplo de como se vería (categorías ficticias): 
            {
                "1": "aut",
                "2": "maiores",
                "3": "debitis",
                "4": "eaque"
            }
        */
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        // Crear un nuevo post con los datos recibidos del formulario
        $post = Post::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'extract' => $request->extract,
            'body' => $request->body,
            'user_id' => auth()->id(), // Asignar el user_id del usuario autenticado
        ]);

        if ($request->hasFile('file')) {

            // Obtén el archivo subido
            $file = $request->file('file');
                
            // Genera un nombre único para el archivo
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // // Almacena el archivo en el sistema de archivos en la carpeta 'public/posts'
            Storage::putFileAs('public/posts', $file, $fileName);

            // dd('El archivo es válido y su nombre es: ', $fileName, 'y se ha almacenado correctamente');
                        
            // Construye la URL relativa adecuada
            $url = 'posts/' . $fileName;

            //  Guarda la imagen con nombre único en la base de datos
            $post->image()->create([
                'url' => $url
            ]);

        } else {
            // Si no se proporciona una imagen, asigna una predeterminada
            $imageUrl = 'https://cdn.pixabay.com/photo/2020/04/02/22/55/santorini-4996901_1280.jpg';
            $baseFilename = 'post_default_image.jpg';
            $baseFilePath = 'storage/posts/' . $baseFilename;
    
            // Verifica si la imagen base ya existe para no descargarla múltiples veces
            if (!File::exists(public_path($baseFilePath))) {
                // Crear el directorio si no existe
                if (!File::exists(public_path('storage/posts'))) {
                    File::makeDirectory(public_path('storage/posts'), 0755, true);
                }
    
                // Descarga la imagen base y guárdala en la ubicación deseada
                $imageContent = file_get_contents($imageUrl);
                File::put(public_path($baseFilePath), $imageContent);
            }
    
            // Genera un nombre único para la nueva imagen basada en el post ID o un UUID
            $uniqueFilename = 'post_image_' . Str::uuid() . '.jpg';
            $uniqueFilePath = 'storage/posts/' . $uniqueFilename;
    
            // Copia la imagen base a la nueva ubicación con el nombre único
            File::copy(public_path($baseFilePath), public_path($uniqueFilePath));
    
            // Guarda la imagen predeterminada con nombre único en la base de datos
            $post->image()->create([
                'url' => 'posts/' . $uniqueFilename
            ]);
        }
      
        // Si tienes tags asociados al post, los puedes guardar también
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        } 

        // Redirigir a alguna vista o enviar una respuesta JSON, según tu necesidad
        return response()->json([
            'redirect' => route('admin.posts.edit', $post),
            'info' => 'El post se creó con éxito'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Esta es la referencia del metodo 'author' de (app/Policies/PostPolicy.php).
        $this->authorize('author', $post);

        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        // Esta es la referencia del metodo 'author' de (app/Policies/PostPolicy.php).
        $this->authorize('author', $post);

        $post->update($request->all());

        if ($request->hasFile('file')) {
            
            // Obtén el archivo subido
            $file = $request->file('file');
                                
            // Genera un nombre único para el archivo
            $fileName = time() . '_' . $file->getClientOriginalName();
                
            // Almacena el archivo en el sistema de archivos en la carpeta 'public/posts'
            Storage::putFileAs('public/posts', $file, $fileName);
                
            // Construye la URL relativa adecuada
            $url = 'posts/' . $fileName;

            /*
                Si el 'post' ya contiene una imagen cuando lo actualicemos,
                eliminamos la que tiene en ese momento y la sustituimos por
                la misma o por una nueva que haya escogido.
            */
            if ($post->image) {
                $image = $post->image;
                $path = 'public/' . $image->url;
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }
                $post->image->update([
                    'url' => $url
                ]);
            }else {
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        // Redirigir a alguna vista o enviar una respuesta JSON, según tu necesidad
        return response()->json([
            'redirect' => route('admin.posts.edit', $post),
            'info' => 'El post se actualizó con éxito'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Esta es la referencia del metodo 'author' (de app/Policies/PostPolicy.php).
        $this->authorize('author', $post);

        $image = $post->image;
        $path = 'public/' . $image->url;
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
        $image->delete();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('info', 'El post se eliminó con éxito');
    }
}

<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /*
        IMPORTANTE:
            En primer lugar, crear carpeta 'posts' manualmente en:
            (storage/app/public)
        */

        /* 
            - Una vez creada la carpeta 'posts', escribir el siguiente codigo
            para eliminar el contenido de la carpeta 'posts' si existe.
            
            - Esto es para que cada vez que se ejecuten los seeders no 
            acumule imagenes innecesariamente cuando se vuelvan a crear.
        */
        $postsDirectory = public_path('storage/posts');
        if (File::exists($postsDirectory)) {
            File::cleanDirectory($postsDirectory);
        } else {
            File::makeDirectory($postsDirectory, 0755, true);
        }

        $this->call(UserSeeder::class);
        Category::factory(4)->create();
        Tag::factory(8)->create();
        $this->call(PostSeeder::class);
    }
}

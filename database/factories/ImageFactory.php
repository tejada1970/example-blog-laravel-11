<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // URL de la imagen a descargar
        $imageUrl = 'https://cdn.pixabay.com/photo/2020/04/02/22/55/santorini-4996901_1280.jpg';
        
        // Nombre del archivo base
        $baseFilename = 'post_default_image.jpg';
        
        // Ruta donde se guardará la imagen base
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

        // Devuelve la ruta relativa de la imagen única
        return [
            'url' => 'posts/' . $uniqueFilename
        ];
    }
}

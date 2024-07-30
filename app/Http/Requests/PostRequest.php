<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // recupera la información del 'post'.
        $post = $this->route()->parameter('post');

        // Estas reglas son para el caso de que se escoga la opción 'borrador'.
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2',
            'file' => 'image|mimes:jpg,jpeg,png,jfif,webp|max:2048'
        ];

        // Cuando creemos un nuevo 'post' funcionará la regla de validación de arriba para el 'slug'.
        // Y cuando actualicemos un 'post' funcionará esta regla de validación 'condicional' para el 'slug'.
        if ($post) {
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }


        // Estas reglas son para el caso de que se escoga la opción 'publicado'.
        if ($this->status == 2) {
            $rules = array_merge($rules, [
                'category_id' => 'required',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required',
            ]);
        }

        return $rules;
    }
}

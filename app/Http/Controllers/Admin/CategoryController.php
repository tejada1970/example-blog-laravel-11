<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);

        $category = Category::create($request->all());

        // el 'return' se maneja desde el componente se encuentra en resources/views/components/slug-autocompleted.blade.php
        return response()->json([
            'redirect' => route('admin.categories.edit', $category),
            'info' => 'La categoría se creó con éxito'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        /*
            esta linea:
            'slug' => "required|unique:categories,slug,$category->id"

            es, para que ignore la validación, si se trata del 'slug'
            que tenga el mismo 'id' a la hora de pinchar en
            'Actualizar categoría'.
        */
        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:categories,slug,$category->id"
        ]);

        $category->update($request->all());

        // el 'return' se maneja desde el componente se encuentra en resources/views/components/slug-autocompleted.blade.php
        return response()->json([
            'redirect' => route('admin.categories.edit', $category),
            'info' => 'La categoría se actualizó con éxito'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        /*
            - este metodo: ->with('info', 'La categoría se eliminó con éxito')
            - es para mostrar un mensaje de sesión.
        */
        $category->delete();
        return redirect()->route('admin.categories.index', $category)->with('info', 'La categoría se eliminó con éxito');
    }
}

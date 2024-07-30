<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:tags',
        ]);

        $tag = Tag::create($request->all());

        // el 'return' se maneja desde el componente se encuentra en resources/views/components/slug-autocompleted.blade.php
        return response()->json([
            'redirect' => route('admin.tags.edit', $tag),
            'info' => 'La etiqueta se creó con éxito'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        /*
            esta linea:
            'slug' => "required|unique:tags,slug,$tag->id"

            es, para que ignore la validación, si se trata del 'slug'
            que tenga el mismo 'id' a la hora de pinchar en
            'Actualizar etiqueta'.
        */

        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:tags,slug,$tag->id"
        ]);

        $tag->update($request->all());

        // el 'return' se maneja desde el componente se encuentra en resources/views/components/slug-autocompleted.blade.php
        return response()->json([
            'redirect' => route('admin.tags.edit', $tag),
            'info' => 'La etiqueta se actualizó con éxito'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        /*
            - este metodo: ->with('info', 'La etiqueta se eliminó con éxito')
            - es para mostrar un mensaje de sesión.
        */
        $tag->delete();
        return redirect()->route('admin.tags.index', $tag)->with('info', 'La etiqueta se eliminó con éxito');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use LVR\Colour\Hex;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ? Pasamos todos los tags ordenados con el nombre y paginando por 10  

        $tags = Tag::orderBy('nombre') -> paginate(10);
        return view('tags.index' , compact('tags')); //? Devolvemos la ruta con todos los tags
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tags.create'); //? Devolvemos la vista
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request -> validate([
            'nombre' => ['required' , 'string' , 'min:3' , 'unique:tags,nombre'],
            'color' => ['required' , 'string' , new Hex()] //? Validacion del color
        ]);

        //? Ahora lo creamos

        //todo Si queremos crear el tag sin cambiar mayuscula minuscula ni mierdas de esas podemos hacerlo asi, para que tal como llegue del formulario se crea.

        Tag::create($request -> all());
        
        return redirect() -> route('tags.index') -> with('mensaje' , 'Etiqueta creada');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        // 
        return view('tags.update' , compact('tag')); //? Paso la vista y el tag que estamos editando
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
        $request -> validate([
            'nombre' => ['required' , 'string' , 'min:3' , 'unique:tags,nombre,'. $tag -> id],
            'color' => ['required' , 'string' , new Hex()] //? Validacion del color
        ]);

        $tag -> update($request -> all());
        
        return redirect() -> route('tags.index') -> with('mensaje' , 'Etiqueta actualizada');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //? Vamos a borrar

        $tag -> delete();

        return redirect() -> route('tags.index') -> with('mensaje' , 'Tag ' . $tag -> nombre . ' eliminado correctamente');
    }
}

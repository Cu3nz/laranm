<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
        $posts = Post::orderBy('id' , 'desc') -> paginate(10);
        return view('posts.index' , compact('posts')); //* Devolvemos la vista con los posts que hay en la base de datos
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //? Nos traemos todos los tag que tenemos en la base de datos, esto es para el formulario. 
        $tags = Tag::select( 'id' , 'nombre') -> orderBy('nombre') -> get(); //* Recogemos el id y el nombre de los tag y lo ordenamos por nombre
        return view('posts.create' , compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ? Validaciones 

        $request -> validate([
            'titulo'=>['required','string','min:3','unique:posts,titulo'],
            'contenido'=>['required','string','min:5'],
            'imagen'=>['nullable','image','max:2048'],
            'estado'=>['nullable'],
            'tags'=>['required','array' , 'min:1' , 'exists:tags,id'],//como mín se marca 1 tag. De tags me llega un array, min 1 elemento, 
            //Cuando marque un tag, mando el id de ese tag. Los valores q le lleguen tienen que existir
            'titulo' => ['required' , 'string' , 'min:3' , 'unique:post,titulo'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

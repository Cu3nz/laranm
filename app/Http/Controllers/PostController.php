<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // ? Validaciones para crear posts 

        $request -> validate([
            'titulo'=>['required','string','min:3','unique:posts,titulo'],
            'contenido'=>['required','string','min:5'],
            'imagen'=>['nullable','image','max:2048'],
            'estado'=>['nullable'],
            'tags'=>['required','array' , 'min:1' , 'exists:tags,id'],//como mín se marca 1 tag. De tags me llega un array, min 1 elemento, 
            //Cuando marque un tag, mando el id de ese tag. Los valores q le lleguen tienen que existir
            'titulo' => ['required' , 'string' , 'min:3' , 'unique:posts,titulo'],
        ]);

        //? Guardamos el posts 

       $post =  Post::create([
            'titulo' => $request -> titulo,
            'contenido' => $request -> contenido,
            'imagen' => ($request -> imagen) ? $request -> imagen -> store('posts') : "posts/default.png", //? Si esite $request -> imagen es porque he subido una imagen, por lo tanto si existe guardamos la imagen con el metodo store en la carpeta posts y si no existe, le ponemos la imagen que tenemos por defecto.
        ]);

        //? Le asignamos al post que acabamos de crear los tags. Esto ya lo hicimos en el seeder.

        $post -> tags() -> attach($request -> tags);

        return redirect() -> route('post.index') -> with('mensaje' , 'Post creado correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // devolvemos la vista y el posts mediante el compact 

        return view('posts.show' , compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tagPost = $post -> getPostTagsId();
        $tags = Tag::select( 'id' , 'nombre') -> orderBy('nombre') -> get();
        return view('posts.edit' , compact('post' , 'tags', 'tagPost')); //? Le pasamos los post , los tags (para los checked) y los tagPost
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
        //? Borrar el posts.

        //* Primero tenemos que comprobar que si es distinta a la default borramos la imagen si no nada

        if (basename($post -> imagen) != 'default.png'){ //? Comprobamos que si el nombre de la imagen es distinta a la default borramos la imagen
            Storage::delete($post -> imagen); //? Borramos la imagen 
        }
        $post -> delete();

        return redirect() -> route('post.index') -> with('mensaje' , 'Posts ' . $post -> titulo . ' eliminado correctamente'); //? A la hora de borrar nos vamos a la pagina principal y mostramos un mnesaje por pantalla donde indicamos que hemos eliminado el posts con x nombre de forma correcta: 


    }
}

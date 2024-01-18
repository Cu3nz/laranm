<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['titulo' , 'contenido' , 'estado' , 'imagen'];

    //* Relacion N:M con tags, porque un post puede tener varias tag (etiquetas)

    public function tags(){
        return $this -> belongsToMany(Tag::class);
    }

    //* Esto son los accesors y muttators 

    //? Transformar el titutlo con la primera en mayuscula

    public function titulo(): Attribute{
        return Attribute::make(
            set : fn($v) => ucfirst($v), //? Esto es una funcion collable como en javascript
        );
    }

    //? Transformar el contenido la primera letra en mayuscula

    public function contenido(): Attribute{
        return Attribute::make(
            set : fn($v) => ucfirst($v), //? Esto es una funcion collable como en javascript
        );
    }


    //? Devolvemos todos los id de los tags de imn òst en forma de array 

    public function getPostTagsId():array{
          // ? Me traigo todos los tag del post y  voy guardando los id de esos posts y lo almaceno en tagPost.
          $tagPost = [];
          foreach($this -> tags as $item){ //* $this Para que sea el post que estoy llamando es como si fuera $post 
              $tagPost[] = $item -> id;
          }

          return $tagPost;
    }

   
}

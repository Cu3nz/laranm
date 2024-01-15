<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
   
    use HasFactory;
     //? Definimos que apartados podemos rellenar borrar editar etc
     protected $fillable = ['nombre' , 'color'];

     //* Tendremos que poner la relacion N:M,k porque una etiqueta puede estar definida en varias posts

     public function posts(){
        return $this -> belongsToMany(Post::class); //! En todas las N:M tenemos que poner el belongsToMany
     }


     //* Accesor y muttors

     public function nombre(): Attribute{
        return Attribute::make(
            get: fn($v) => "#".$v, //? Esto lo que hace es poner un # delante del nombre de la etiqueta
            set : fn($v) => strtolower($v) //? Da igual como me pasen el nombre de la etiqueta que siempre la voy a poner en minuscula
        );
     }

}

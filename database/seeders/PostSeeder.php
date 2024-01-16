<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $post = Post::factory(50) -> create(); //? Genera 50 posts con la imagen y demas y me los guarda en $posts
        //? Para cada posts voy a asignar 1 tag, 2 tag o los que sea son aleatorios


        //* Asignamos a cada posts un numero aleatorio de tags y lo guardamos en post_tag
       foreach($post as $item){
        $item -> tags() -> attach($this -> devolverIdTagRandom());
       }
    }

    //? Metodo que devuelve un numero aleatorio de ids de tag.

    private function devolverIdTagRandom(): array{
        $tags = [];

        $arrayTags = Tag::pluck('id') -> toArray(); //? Esto devuelve [1,2,3,4,5] tantos indice como tags tenga la base de datos -> indices del array 0,1,2,3,4
        $ArrayIndices = array_rand($arrayTags , random_int(2, count($arrayTags))); //? esto devuelve un indice entre 1 y 5 (por el count($arrayTags)) el indice del array [0,3] , [0,3,4] , [1,3,4]; 
        //* Por ejemplo si devolvemos [0,3,4] -> estamos haciendo un array con el id de tag 1 , 4 y 5.
        foreach($ArrayIndices as $indice){
            $tags[] = $arrayTags[$indice]; //? Devolvemos el id de los tags segun el indice que se le pase.
        }
        return $tags;
    }
}

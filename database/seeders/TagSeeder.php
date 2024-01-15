<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //? Nos creamos un array de etiquetas; 

        $tag = [
            'informatica' => "#F4ECF7",
            'paisajes' => "#D4AC0D",
            'viajes' => "#E74C3C",
            'programacion' => "#7B7D7D",
            'ocio' => "#D35400",
        ];

        foreach($tag as $n => $c){
            Tag::create([
                'nombre' => $n,
                'color' => $c
            ]);
        }
    }
}

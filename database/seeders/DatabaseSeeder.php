<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this -> call(TagSeeder::class); // creamos las categorias 
            Storage::deleteDirectory('posts');
            Storage::makeDirectory('posts');
            $this -> call(PostSeeder::class); //* Esto se encarga de crear posts y de rellenar la tabla post_tag con ella. 
    }
}

<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = Post::where('estado' , 'PUBLICADO') -> orderBy('id', 'desc') -> paginate(5); //? Sube todos los posts que esten publicados 
    return view('welcome' , compact('posts'));
});

Route::resource('post', PostController::class);
Route::resource('tags', TagController::class);

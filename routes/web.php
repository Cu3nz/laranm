<?php

use App\Http\Controllers\ContactoController;
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
    $posts = Post::where('estado' , 'PUBLICADO') -> orderBy('id', 'desc') -> paginate(5); //? Sube todos los posts que  solo esten publicados 
    return view('welcome' , compact('posts'));
}) -> name('home'); //? Le doy el nombre a la ruta welcome

Route::resource('post', PostController::class);
Route::resource('tags', TagController::class) -> except('show');

//? Hacemos dos rutas para el correo

Route::get('contacto' , [ContactoController::class , 'pintarFormulario']) -> name('mail.pintar');
Route::post('contacto' , [ContactoController::class , 'procesarFormulario']) -> name('mail.enviar');

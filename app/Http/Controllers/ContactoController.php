<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMaillabe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    //

    public function pintarFormulario(){
        return view('contactoform.formulario');
    }

    public function procesarFormulario( Request $request){

        $request -> validate([
            'nombre' => ['required' , 'string' , 'min:4'],
            'email' => ['required' , 'email'],
            'contenido' => ['required' , 'string' , 'min:10']
        ]);

        try {

            //todo ucword lo que hace es poner en mayuscula la primera letra de las palabras y envia los siguientes datos sacados de la validacion
            //! admin@correo.es te lo puedes inventar

            Mail::to("admin@correo.es") -> send( new ContactoMaillabe(ucwords($request -> nombre) , $request -> email , ucfirst($request -> contenido)));
            return redirect() -> route('home') -> with('mensaje' , ' Correo enviado, gracias por sus comentarios ');
        } catch (\Exception $ex) {
            dd("Error " . $ex -> getMessage());
            return redirect() -> route('home') -> with('mensaje' , ' No se puedo enviar el correo, intentelo más tarde');
        }

    }


}

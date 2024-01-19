<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactoMaillabe extends Mailable
{
    use Queueable, SerializesModels;

    //public string $nombre , $email , $contenido;

    /**
     * Create a new message instance.
     */
    public function __construct( public string $nombre , public string $email ,  public string  $contenido)
    {
        // ! Esto es al modo clasico, pero haciendo lo que hay dentro de los parametros, estamos haciendo lo mismo que lo de abajo
        // $this -> nombre = $nombre;
        //$this -> email = $email;
        //$this -> contenido = $contenido;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this -> email , $this -> nombre), //? Addres espera la direccion de correo y el nombre, por lo tanto lo cogemos del constructor.
            subject: 'Formulario de contacto', //? El asunto
        );
    }

    /**
     * Get the message content definition.
     */

     //todo Con markdown con las vistas publicadas: 

   /*   public function content(): Content
     {
         return new Content(
             markdown: 'plantillasmail.plantillasLaravel',
             with:[
                 'nombre' => $this -> nombre,
                 'email' => $this -> email, 
                 'contenido' => $this -> contenido 
             ]
         );
     } */

    public function content(): Content
    {
        return new Content(
            view: 'plantillasmail.contacto',
            with:[
                'nombre' => $this -> nombre,
                'email' => $this -> email, 
                'contenido' => $this -> contenido 
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

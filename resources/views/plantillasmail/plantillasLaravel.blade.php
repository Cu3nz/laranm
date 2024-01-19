@component('mail::message')

    # Formulario de contacto

    ## Enviado por:
    {{$nombre}}
    ## Email de remitente: 
    __{{$email}}__
    ## Mensaje: 
    > {{$contenido}}

@endcomponent
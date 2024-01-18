@extends('plantilla.principal')
@section('titulo')

Inicio Sergio

@endsection

@section('cabecera')

Posts Al-Andalus

@endsection

@section('contenido')

<div class="p-2 border-2 border-gray-500 shadow-xl rounded-xl w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
    @foreach ($posts as $item ) <!-- El $posts proviene de web.php-->
    <!--Atendo a lo de la foto se tiene que poner asi-->
    <article style="background-image:url({{Storage::url($item -> imagen)}})"  
        @class([
                    "h-72 bg-cover bg-center bg-no-repeat",
                    "md:col-span-2"=>$loop->first
                    ])>
                    <a href="{{route('post.show' , $item)}}">
    <div class="w-full h-full flex flex-col justify-around items-center p-2 bg-gray-200 bg-opacity-50">
        <div class="text-xl font-bold text-black">
            {{$item -> titulo}}
        </div>
        <div class="flex">
            @foreach ($item -> tags as $tag ) <!--$item -> tags Esto lo hacemos poerque un posts puede tener mas de 1 tag. por lo tanto quiero poner todos los tag que tenga ese posts  -->
            <div class="py-2 px-1 rounded-xl mr-1" style="background-color:{{$tag -> color}}"> <!--Para que tenga los colores del tag-->
                {{$tag -> nombre}}
            </div>
            @endforeach
           </div>
        </a>
    </div>
    </article>

    @endforeach
</div>
<div class="mt 2">
    {{$posts -> links()}}
</div>
@endsection
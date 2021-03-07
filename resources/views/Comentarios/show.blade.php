@extends('layouts.app')

@section('title', 'Usuarios')
@section('content')
<div class="container">
    
        <h5><strong>Titulo:</strong>  {{$comentario->titulo}}</h5>
        <br/>
        <h5><strong>Comentario:</strong>  {{$comentario->comentario}}</h5><br>
        <h5><strong>Users:</strong>  {{$comentario->users_id}}</h5><br>
        <h5><strong>Creado:</strong>  {{$comentario->created_at}}</h5><br>
        <h5><strong>Actualizado:</strong>  {{$comentario->updated_at}}</h5><br>
   

</div>
   
@endsection
    
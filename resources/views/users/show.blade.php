@extends('layouts.app')

@section('title', $user->nombre1)
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title"><strong>Usuario</strong> {{ $user->apellido_paterno }} {{ $user->apellido_materno }} {{ $user->nombre1 }} {{ $user->nombre2 }}</h1>
                	<br>               	
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-lg-4">
                            <h5><strong>Usuario:</strong> {{ $user->usuario }}</h5>
                            <h5><strong>Cédula:</strong> {{ $user->cedula }}</h5>
                            <h5><strong>Nombres:</strong> {{ $user->nombre1 }} {{ $user->nombre2 }}</h5>
                            <h5><strong>Apellidos:</strong> {{ $user->apellido_paterno }} {{ $user->apellido_materno }}</h5>
                            <h5><strong>Última actualización:</strong> {{ $user->updated_at }}</h5>    
                            <h5><strong>Roles</strong></h5>
                            <ul>
                                @if(sizeof($user->usuarioRoles) > 0)
                                    @foreach($user->usuarioRoles as $rol)
                                        <li>{{ $rol->rol->name }}</li>
                                    @endforeach
                                @else
                                    <li>El usuario {{ $user->nombre1 }} {{ $user->apellido_paterno }} no tiene roles asignados</li>
                                @endif
                            </ul> 
                        </div>

                        
                    </div>

                </div>         
                
                <div class="card-footer">
                  
                </div>
            </div>
        </div>
    </div>

@endsection

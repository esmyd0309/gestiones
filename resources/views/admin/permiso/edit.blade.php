@extends('layouts.app')

@section('title', 'Editar permiso')
@section('content')
	
	<div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    
                    @if(session('msg'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Excelente</h5>                                     
                            <ul>                         
                                <li>{{ session("msg") }}</li>                            
                            </ul>
                        </div>
                    @endif
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Error</h5>  
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h1 class="card-title"><strong>Ediar permiso:</strong> {{ $permiso->name }}</h1>
                    <br>                
                </div>
                <div class="card-body">
                    {!! Form::model($permiso, ['route' => ['permissions.update', $permiso->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {{ Form::label('name', 'Nombre (name)') }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del permiso']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('slug', 'Ruta amigable (slug)') }}
                        {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ruta amigable para el permiso']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', 'Descripci??n') }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descripci??n del permiso']) }}
                    </div>                   
                    
                    <div class="card-footer">
                        {{ Form::submit('Enviar', ['class' => 'btn btn-sm btn-primary']) }}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
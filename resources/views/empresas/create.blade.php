@extends('layouts.app')

@section('title', 'Crear empresa')
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

                    <h1 class="card-title">Crear una nueva <a href="{{ route('empresas.index') }}">empresa</a></h1>
                    <br>                
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'empresas.store']) !!}
                    <div class="form-group">
                        {{ Form::label('nombre_empresa', 'Nombre') }}
                        {{ Form::text('nombre_empresa', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la empresa']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('descripcion_empresa', 'Descripci??n') }}
                        {{ Form::textarea('descripcion_empresa', null, ['class' => 'form-control', 'placeholder' => 'Descripci??n de la empresa']) }}
                    </div>              
                    <div class="card-footer">
                        {{ Form::submit('Enviar', ['class' => 'btn btn-sm btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
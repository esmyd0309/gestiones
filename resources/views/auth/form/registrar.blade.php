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
                        @if($error == 'validation.ecuador')
                            <li>La cédula no es válida</li>
                        @else
                            <li> {{ $error }} </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="card-title">Crear nuevo usuario</h1>
        <br>                
    </div>
    
    <div class="card-body">
        {!! Form::open(['route' => 'users.store']) !!}
        <div class="row">
            <div class="col-lg-6">
               
                <div class="form-group">
                    {{ Form::label('nombre1', 'Nombre(*)') }}
                    {{ Form::text('nombre1', null, ['placeholder'=>'Primer nombre', 'class' => 'form-control']) }}
                </div>


                <div class="form-group">
                    {{ Form::label('apellido_paterno', 'Apellido (*)') }}
                    {{ Form::text('apellido_paterno', null, ['placeholder'=>'Apellido paterno', 'class' => 'form-control']) }}
                </div> 
                <div class="form-group">
                    {{ Form::label('usuario', 'Usuario (*)') }}
                    {{ Form::text('usuario', null, ['placeholder'=>'Apellido paterno', 'class' => 'form-control']) }}
                </div> 


                <div class="form-group">
                    {{ Form::label('email', 'Correo del usuario') }}
                    {{ Form::email('email', null, ['placeholder'=>'Correo', 'class' => 'form-control']) }}
                </div> 

              
            </div>
        </div>                                
      

        {!! Form::close() !!}
    </div>
</div>
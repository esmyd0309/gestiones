@extends('layouts.app')

@section('title', 'inicio')
@section('content')

<div class="col-lg-12">
  <div class="card">
      <div class="card-header">
          <h1 class="card-title">Comentarios</h1>
        <br>
        <div>        		
         
        </div>

        <br>
        @if(session('msg'))
          <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i>Excelente</h5>					  				    
        <ul>				         
            <li>{{ session("msg") }}</li>              				        
        </ul>
    </div>
        @endif

          @if(session('error'))
              <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i>Error</h5>                                     
                  <ul>                         
                      <li>{{ session("error") }}</li>                                   
                  </ul>
              </div>
          @endif
       
      </div>
      <div class="card-body table-responsive">
          <table class="table table-bordered table-hover table-striped">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Titulo</th>
                      <th>Comentario</th>
                      <th>Usuario</th>
                      <th>Fecha</th>
                     
                     
                               

                      @if(Auth::user()->can('comentarios.show') || Auth::user()->can('comentarios.position') || Auth::user()->can('comentarios.edit') || Auth::user()->can('comentarios.destroy'))
                          <th colspan="4">Acciones</th>
                      @endif

                  </tr>
              </thead>
            <tbody>
                @foreach ($comentarios as $key => $comentarioss)
                    <tr>
                      <td>{{ ($key + 1) }}</td>
                      <td>{{ $comentarioss->titulo }}</td>
                      <td>{{ $comentarioss->comentario }} </td>
                      <td>{{ $comentarioss->users_id }}</td>
                      <td>{{ $comentarioss->created_at }}</td>
                      
                 
                      @can('comentarios.show')
                          <td>    
                              <a href="{{ route('comentarios.show', $comentarioss->id) }}" class="btn btn-sm btn-info">
                                  <i class="fa fa-eye"></i>
                              </a>
                          </td>
                      @endcan
                 
                      @can('comentarios.edit')
                          <td>
                              <a href="{{ route('comentarios.edit', $comentarioss->id) }}" class="btn btn-sm btn-warning">
                                   <i class="fa fa-pen"></i>
                              </a>
                          </td>
                      @endcan
                      @can('comentarios.destroy')
                          <td>    
                              {!! Form::open(['route' => ['comentarios.destroy', $comentarioss->id], 'method' => 'DELETE']) !!}
                                  <button class="btn btn-sm btn-danger" onclick="return confirm('¿ ESTAS SEGURO QUE DESEAS ELIMINAR ?')"><i class="fa fa-trash" ></i></button>
                              {!! Form::close() !!}
                          </td>        
                      @endcan 
                                            
                    </tr>
                @endforeach
            </tbody>
          </table> 
             
      </div>
    
      <div class="card-footer">
          {{ $comentarios->render() }}
      </div>

  </div>
</div>
@endsection
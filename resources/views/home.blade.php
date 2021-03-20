@extends('layouts.app')

@section('title', 'inicio')
@section('content')

<div class="col-lg-12">
  <div class="card">
      <div class="card-header">
          <h1 class="card-title">Clientes Registrados</h1>
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
                      <th>Nombres</th>
                      <th>Cedula</th>
                      <th>telefono Whatsapp</th>
                      <th>Fecha</th>
                     
                     
                               

                      @if(Auth::user()->can('comentarios.show') || Auth::user()->can('comentarios.position') || Auth::user()->can('comentarios.edit') || Auth::user()->can('comentarios.destroy'))
                          <th colspan="4">Acciones</th>
                      @endif

                  </tr>
              </thead>
            <tbody>
                @foreach ($clientes as $key => $clientess)
                    <tr>
                      <td>{{ ($key + 1) }}</td>
                      <td>{{ $clientess->nombres }} {{ $clientess->apellidos }}<</td>
                      <td>{{ $clientess->cedula }} </td>
                      <td>{{ $clientess->telefonoWhatsapp }}</td>
                      <td>{{ $clientess->created_at }}</td>
                      
                 
                    
                          <td>    
                              <a href="#" class="btn btn-sm btn-info">
                                  <i class="fa fa-eye"></i>
                              </a>
                          </td>
               
                 
             
                          <td>
                              <a href="#" class="btn btn-sm btn-warning">
                                   <i class="fa fa-pen"></i>
                              </a>
                          </td>
                     
                              
                    
                                            
                    </tr>
                @endforeach
            </tbody>
          </table> 
             
      </div>
    
      <div class="card-footer">
          {{ $clientes->render() }}
      </div>

  </div>
</div>
@endsection
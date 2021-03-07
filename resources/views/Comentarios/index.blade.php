@extends('layouts.app')

@section('title', 'Usuarios')
@section('content')

    <div class="row">
        
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Comentarios</h1>
                	<br>
                	<div>        	
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i></button>
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
                                <th>Datos</th>
                                <th>Numero</th>
                                <th>Numero2</th>
                                <th>Organización</th>
                            

                            </tr>
                        </thead>
                      <tbody>
                          @foreach ($data as $key => $comentarioss)
                              <tr>
                                <td>{{ ($key + 1) }}</td>
                                <td>{{ $comentarioss->datos }}</td>
                                <td>{{ $comentarioss->telefono1 }} </td>
                                <td>{{ $comentarioss->telefono2 }}</td>
                                <td>{{ $comentarioss->organizacion }}</td>
                                
                                <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="far fa-edit"></i></button></td>          
                              </tr>
                          @endforeach
                      </tbody>
                    </table> 
                       
                </div>
              
                <div class="card-footer">
                    {{ $data->render() }}
                </div>

            </div>
        </div>
        <div class="row">
        <!-- Modal crear -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agregar </h4>
                        </div>
                        {!! Form::open(['route' => ['comentarios.store']]) !!}
                        {{csrf_field()}}
                        <div class="modal-body">
                            @include('Comentarios.form')
                        </div>
                       
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            
        </div>
    </div>

@endsection

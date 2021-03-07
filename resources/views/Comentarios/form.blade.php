    <div class="card-header">
        <h3 class="card-title">Crea Nuevo Comentario</h3>
    </div>

        <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      {!! Form::label('telefono1' , 'telefono1 *') !!}
                      {!! Form::text('telefono1' , null, ['id'=>'telefono1','class' =>'form-control my-colorpicker1',  'placeholder' => ' Min 9 - Max 10 caracteres', 'maxlength' => '50' ]) !!}
                  </div>
              </div>

                
            </div>
        </div>
      
      <center><button id="registro" class="btn btn-primary" type="#"> Registrar </button></center>
   
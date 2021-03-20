<?php

namespace App\Models\Clientes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DetalleCampania;

class Clientes extends Model
{
    protected $table = "clientes";
    protected $fillable = [
                            'nombres   ',     
                            'apellidos ',    
                            'cedula    ',     
                            'telefonoWhatsapp',     
                            'telefonoCelular ',    
                            'telefonoCasa    ',     
                            'direccion ',     
                            'provincia ',     
                            'canton    ',   
                            'sector    ',     
                            'villa     ',    
                            'mz        ',     
                            'referencia',    
                            'idActualizado', ];
}	
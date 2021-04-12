<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DetalleCampania;

class Producto extends Model
{
    protected $table = "productos";
 
    protected $fillable = ['id',
                            'nombre   ',     
                            'precio ',    
                            'cantidad    ',     
                            'descripcion',     
                            'categoria_id ',    
                            'puntos    ',     
                        ];
   
    public function scopeNombre($query, $nombre)
     {
         if($nombre)
         return $query->where('nombre', 'LIKE', "%$nombre%"); 
     }
}	
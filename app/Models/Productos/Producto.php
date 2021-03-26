<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DetalleCampania;

class Producto extends Model
{
    protected $table = "prductos";
    protected $primaryKey = 'id';
    public $timestamps = false;

   
}	
<?php

namespace App\Models\Categorias;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DetalleCampania;

class Categoria extends Model
{
    protected $table = "categorias";
    protected $primaryKey = 'id';
    public $timestamps = false;

   
}	
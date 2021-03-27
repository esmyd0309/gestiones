<?php

namespace App\Http\Controllers\Categorias;
use App\Http\Controllers\Controller;
use App\Models\Categorias\Categoria;
use Illuminate\Http\Request;
use DB;
class ApiCategoriaController extends Controller
{
    public function all(Request $request)
    {   

        if ($request) 
        {
            //$data = Categoria::get();
        
            $data = DB::connection('mysql')->select("SELECT COUNT(a.id) AS cantidad,b.nombre,b.id FROM productos AS a, categorias AS b WHERE a.categoria_id=b.id
            GROUP BY b.nombre,b.id");
            return response()->json($data, 200);
        }

        return response()->json([], 200);
    }

    
  
}
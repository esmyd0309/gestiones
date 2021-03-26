<?php

namespace App\Http\Controllers\Productos;
use App\Http\Controllers\Controller;
use App\Models\Productos\Producto;
use Illuminate\Http\Request;

class ApiProductoController extends Controller
{
    public function getproductos(Request $request,$id)
    {   

        if ( $request) 
        {
            $data = Producto::where('categoria_id',$id)->get();
        

            return response()->json($data, 200);
        }

        return response()->json([], 200);
    }

    
  
}
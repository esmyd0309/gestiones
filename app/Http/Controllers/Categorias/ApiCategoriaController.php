<?php

namespace App\Http\Controllers\Categorias;
use App\Http\Controllers\Controller;
use App\Models\Categorias\Categoria;
use Illuminate\Http\Request;

class ApiCategoriaController extends Controller
{
    public function all(Request $request)
    {   

        if ($request) 
        {
            $data = Categoria::get();
        

            return response()->json($data, 200);
        }

        return response()->json([], 200);
    }

    
  
}
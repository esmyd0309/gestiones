<?php

namespace App\Http\Controllers\Productos;
use App\Http\Controllers\Controller;
use App\Models\Productos\Producto;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
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

    public function listaproductos(Request $request)
    {   

        if ($request) 
        {
            
            $data = DB::connection('mysql')->select("SELECT * FROM productos ORDER BY id desc  ");
            return response()->json($data, 200);

          
        }else {
            
           
            $nombre = $request->get('nombre');
            $data = Producto::orderBy('categoria_id', 'DESC')
            ->nombre($nombre)
            ->paginate(10);
            return response()->json($data, 200);
        
        }
       
     
       
    }


    
    public function index()
    {   

        return view('Productos.index');
       
    }

    public function guardarproducto(Request $request)
    {   

       
        $producto = new Producto;
        $producto->nombre                =   $request->producto; 
        $producto->descripcion           =   $request->descripcion; 
        $producto->precio                =   $request->precio; 
        $producto->puntos                =   $request->puntos; 
        $producto->cantidad              =   $request->cantidad; 
        $producto->categoria_id          =   $request->categoria; 
     
      
        $producto->save();

        

        
         return response()->json($producto);
    }

    public function actualizarproducto(Request $request)
    {   
        
     
        $producto = Producto::findOrFail($request->id);
        $producto->nombre                =   $request->producto; 
        $producto->descripcion           =   $request->descripcion; 
        $producto->precio                =   $request->precio; 
        $producto->puntos                =   $request->puntos; 
        $producto->cantidad              =   $request->cantidad; 
        $producto->categoria_id          =   $request->categoria; 
        
        $producto->update();
        return response()->json($producto);
    }

    public function deleteproducto( $id)
    {   
        DB::connection('mysql')->statement("DELETE FROM productos WHERE id='$id' ");
        return response()->json([], 200);
    }

    
  
}
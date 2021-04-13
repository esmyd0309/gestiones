<?php

namespace App\Http\Controllers\Carrito;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Data;
use App\Models\Clientes\Clientes;
use App\Models\Carrito\Carrito;
use App\Models\Carrito\Carritodetalle;
use DateTime;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;

class CarritoController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	} 
   
    public function guardarcarrito(Request $request)
    {   
       
        $productosAll[]='';
        $puntosAll[]='';
        foreach($request->carrito as $producto){
            $productosAll[]=$producto['nombre'];
            $puntosAll[]=$producto['puntos'];
        }

       
        $totalpuntos= array_sum($puntosAll);
        
         $puntos =DB::table('clientes')->where('id', $request->cliente_id)->first();
     // dd($puntos->puntos);
        if ($puntos->puntos) {
            $totalpuntos=$puntos->puntos+$totalpuntos;
        }
        
       
        Clientes::where('id',$request->cliente_id)->update(['puntos'         =>  $totalpuntos ]);

        $carritodetalle = new Carritodetalle;
        $carritodetalle->productos = implode(",", $productosAll);
        $carritodetalle->cliente_id = $request->cliente_id;
        $carritodetalle->total = $request->total;
        $carritodetalle->puntos = array_sum($puntosAll);
        $carritodetalle->save();
       
       
        foreach($request->carrito as $carritox){
            $carrito = new Carrito;
            $carrito->cliente_id =$request->cliente_id;
            $carrito->producto =$carritox['nombre'];
            $carrito->producto_id =$carritox['producto_id'];
            $carrito->categoria_id =$carritox['categoria_id'];
            $carrito->precio =$carritox['precio'];
            $carrito->puntos =$carritox['puntos'];
            $carrito->carritodetalle_id =$carritodetalle->id;
            $carrito->save();
           
        }
       
        return response()->json([], 200);
    }

    public function clientecarrito( $id)
    {  
        
        $data = DB::connection('mysql')->select("SELECT * FROM carritodetalle WHERE cliente_id='$id' ORDER BY updated_at desc");

        return response()->json($data, 200);

     }

    public function clientecarritodetalle( $id)
    {  
        
        $data = DB::connection('mysql')->select("SELECT b.nombre AS categoria,a.producto,a.precio,a.puntos,a.created_at AS fecha FROM carrito AS a, categorias AS b
                                            WHERE a.carritodetalle_id='$id'
                                            AND a.categoria_id=b.id ORDER BY updated_at desc");

        return response()->json($data, 200);

     }

    
}
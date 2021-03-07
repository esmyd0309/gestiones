<?php

namespace App\Http\Controllers\Proceso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proceso\Productos;
use App\Models\Proceso\Proevedor;
use App\Models\Proceso\Categoria;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\User;
use Auth;
use DB;
class ProductoController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	} 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
            $producto = Productos::orderBy('id','desc')->paginate(10);
            
       //dd($producto);
        return view('proceso.producto.index',compact('producto'));
    }

    public function buscadorProducto(Request $request)
    {
     
        
        $datos = DB::connection('mysql')->table('_productos')
        
        ->select('_productos.id',
                 '_productos.nombre',
                  '_productos.modelo',
                  '_productos.marca',
                  '_productos.total',
                  '_productos.created_at'
                  )
        ->where("_productos.nombre",'like',$request->texto."%")
        ->orwhere("_productos.modelo",'like',"%".$request->texto."%")
        ->orwhere("_productos.marca",'like',"%".$request->texto."%")
        ->take(5)->get();
        return view('proceso.producto.buscador', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $date = Carbon::now();
        $fecha= $date->format('Y-m-d H:i');
        $ano= $date->format('Y');
        $mes= $date->format('m');
        $dia= $date->format('d');
  
  
              $producto = new Productos();
              $producto->proveedor_id = $request->proveedor_id;
              $producto->categoria_id = $request->categoria_id;
              $producto->nombre = $request->nombre;
              $producto->descripcion = $request->descripcion;
              $producto->precio = $request->precio;
              $producto->preciocomprado = $request->preciocomprado;
              $producto->inversion = $request->inversion;
              $producto->iva = $request->iva;
              $producto->total = $request->total;
              $producto->marca = $request->marca;
              $producto->modelo = $request->modelo;
              $producto->color =  $request->color;
              $producto->peso =  $request->peso;
              $producto->cantidad =  $request->cantidad;
              $producto->restante =  $request->cantidad;
              $producto->nota =  $request->nota;
              $producto->tamano =  $request->tamano;
              $producto->usuario = \Auth::user()->usuario;
           
  
          
              $producto->save();
  
            
  
              return redirect()
                              ->back()
                              ->with('info', 'Producto Agregada Correctamente..!');  
    }
    public function addimagen(Request $request )
    {   
      $id = $request->id;

      $datos =  Productos::where('id',$id)->first();

      $date = Carbon::now();
      $fecha= $date->format('Y-m-d H:i');
      $ano= $date->format('Y');
      $mes= $date->format('m');
      $dia= $date->format('d');


      if ($request->file) {
        $nombre = time().'_'.$request->file->getClientOriginalName();
       
        
        $destination = base_path() . '/public/imagenes/productos/'.$ano.'/'.$mes.'/'.$dia;//armo la ruta para la imagen
        $subirarchivo = $request->file('file')->move($destination, $nombre);//subo la imagen a la carpeta

        $archivo        = Productos::where('id',$id)->update(['archivo' => 'imagenes/productos/'.$ano.'/'.$mes.'/'.$dia.'/'.$nombre]);// 
        $nombreArchivo  = Productos::where('id',$id)->update(['nombreArchivo' => $nombre]);// 
        $agenteArchivo   = Productos::where('id',$id)->update(['agenteArchivo' => \Auth::user()->usuario]);// 
        $fechaArchivo  = Productos::where('id',$id)->update(['fechaArchivo' => $fecha]);// 
        
        return response()->json(['success' => 'Imagen Cargada Correctamente'], 200);


      }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pago = Productos::findOrFail($id);
        $pago->delete();
        return response()->json(['success' => 'Se ha eliminado el Producto!!']);
       
    }
}


<?php

namespace App\Http\Controllers\Proceso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proceso\Ventas;
use App\Models\Proceso\Productos;
use App\Models\Proceso\Pagos;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\Proceso\Cuotas;
use App\Models\Proceso\Cuotasdetalle;

use Carbon\Carbon;
use App\User;
use Auth;
use DB;
class PagosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function getPagos()
    {  
      $gestiones = DB::connection('mysql')->table('_pagos')
     
              ->join('bancos','_pagos.origen_id','bancos.id')
              ->join('bancosdestino','_pagos.destino_id','bancosdestino.id')
              ->select ('_pagos.*','bancos.nombre as origen','bancosdestino.nombre as destino')
            
              ->get();
      
       return response()->json($gestiones);
    }
    public function getProductosCliente($id)
    {
        $productos =DB::connection('mysql')
            ->table('_ventas')
            ->join('_productos','_ventas.producto_id','_productos.id')
            ->select ('_ventas.*','_productos.modelo','_productos.marca','_productos.archivo')
            ->where('_ventas.saldoDeuda' ,'>',0)
            ->where('_ventas.cliente_id',$id)
            ->get()->toArray();

            return response()->json($productos);
    

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        return view('proceso.pagos.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $clientes_id = $request->clientes_id;
        $venta_id = $request->venta_id;
        $valorPago = $request->valor;

        $datos =  Ventas::where('id',$venta_id)->first();
        $saldo_anterior = floatval($datos->saldoDeuda+$datos->abono);
       
        if ($datos->tipoVenta_id==1) { ///si es credito
          
            if ( $datos->estado_abono==1) ///si es credito y el abono esta activo
            {
                

                    if($datos->saldo_abono <= $request->valor) ///si saldo abono es menor al valor ingresado
                    {
                        Ventas::where('id',$venta_id)->update(['saldo_abono' => 0]);
                        Ventas::where('id',$venta_id)->update(['estado_abono' => 0]);
                        Cuotas::where('venta_id',$venta_id)->update(['saldo_abono' => 0]);
                        Cuotas::where('venta_id',$venta_id)->update(['estado_abono' => 0]);
                        
                        $request->valor =  $request->valor - $datos->saldo_abono;

                    
                    }else{// si el abono es mayor al valor

                        Ventas::where('id',$venta_id)->update(['saldo_abono' => $datos->saldo_abono - $request->valor]);
                        Ventas::where('id',$venta_id)->update(['estado_abono' => 1]);
                        Cuotas::where('venta_id',$venta_id)->update(['saldo_abono' => $datos->saldo_abono - $request->valor]);
                        Cuotas::where('venta_id',$venta_id)->update(['estado_abono' => 1]);

                        $request->valor = 0;
                    }

                    if ($request->file) 
                    {
                        $nombrear = $request->file->getClientOriginalName();//obtengo el nombre del archivo
                        $filename = pathinfo($nombrear, PATHINFO_FILENAME);//obtengo el nombre sin la extension
                        $extension = pathinfo($nombrear, PATHINFO_EXTENSION);//obtengo la extension del archivo
                        $nombre = $request->documento.'_'.$request->fechapago.'_'.$request->venta_id.'.'.$extension;//armo el nombre del archivo
            
                    
                        $destination = base_path() . '/public/recibos/clientes/'.$ano.'/'.$mes.'/'.$dia;//armo la ruta para la imagen
                        $subirarchivo = $request->file('file')->move($destination, $nombre);//subo la imagen a la carpeta
                    }
            
                    $pagos = new Pagos();
                    $pagos->clientes_id =$clientes_id;
                    $pagos->ventas_id =$venta_id;
                    $pagos->documento =$request->documento;
                    $pagos->fecha =$fecha;
                    $pagos->agente =\Auth::user()->usuario;
                    $pagos->formapago =$request->formapago;
                    $pagos->origen_id =$request->origen_id;
                    $pagos->destino_id =$request->destino_id;
                    $pagos->saldo_anterior =$saldo_anterior;
                    $pagos->valor =$valorPago;
                    $pagos->fechapago =$request->fechapago;
                    $pagos->comentario =$request->comentario;
                    $pagos->tipopago =$request->tipopago;
                    if ($request->file) {
                        $pagos->archivo ='recibos/clientes/'.$ano.'/'.$mes.'/'.$dia.'/'.$nombre;
                    $pagos->nombreArchivo =$nombre;
                    }
                    $pagos->save();

                    if ($request->valor > 0) 
                    {
                     
                        $total = ($datos->saldoDeuda+$datos->saldo_abono) - $request->valor;

                        if ($datos->saldoDeuda <= $request->valor) {

                            Ventas::where('id',$venta_id)->update(['saldoDeuda' => 0]);
                            Ventas::where('id',$venta_id)->update(['estado_abono' => 0]);
        
                            $devolucion =    $request->valor - $datos->saldoDeuda;
                            Ventas::where('id',$venta_id)->update(['devolucion' =>  $devolucion]);
                        }else{
                            Ventas::where('id',$venta_id)->update(['saldoDeuda' => $datos->saldoDeuda - $request->valor]);
                            Ventas::where('id',$venta_id)->update(['estado_abono' => 1]);
                        }
                        
                        

                        if ($total<0) {
                            Ventas::where('id',$venta_id)->update(['estadoVenta_id' => 5]);// 
                        }else{
                            Ventas::where('id',$venta_id)->update(['estadoVenta_id' => 2]);// 

                        }
                        if ($datos->saldoDeuda =0) {
                            Ventas::where('id',$venta_id)->update(['estadoVenta_id' => 6]);// 
                        }

                        //////////
                        $cuotasSaldo =  Cuotas::where('venta_id',$venta_id)->first();

                        $ActuaizarcuotasSaldo  = Cuotas::where('venta_id',$venta_id)->update(['saldodeuda' => $total]);// 

                        ////// cuotas detalle
                        $cuota_id = $cuotasSaldo->id;
                        $credito = floatval($request->valor);

                        while ($credito > 0):
                            $cuotasDetalle =  Cuotasdetalle::where('cuota_id',$cuota_id)->where('saldo_cuota','>',0)->first();

                            if (!empty($cuotasDetalle->saldo_cuota)) {
                            
                                if($cuotasDetalle->saldo_cuota <= $credito){ //50.13 es menor a 50.00 ----no entra
                                    Cuotasdetalle::where('id',$cuotasDetalle->id)->update(['saldo_cuota' => 0]);
                                    Cuotasdetalle::where('id',$cuotasDetalle->id)->update(['estado' => 'CANCELADA']);
                                }elseif ($cuotasDetalle->saldo_cuota>$credito ) {
                                        Cuotasdetalle::where('id',$cuotasDetalle->id)->update(['saldo_cuota' => $cuotasDetalle->saldo_cuota - $credito]);
                                        Cuotasdetalle::where('id',$cuotasDetalle->id)->update(['estado' => 'PENDIENTE']);
                                }
                                $credito = $credito - $cuotasDetalle->saldo_cuota; 

                            }else{
                                $credito =0;
                            }
                            
                        endwhile;

                    }

                    return response()->json(['success' => 'Pago Registrado con un Abono'], 200);
            }else
            {


                if ($request->file) 
                {
                    $nombrear = $request->file->getClientOriginalName();//obtengo el nombre del archivo
                    $filename = pathinfo($nombrear, PATHINFO_FILENAME);//obtengo el nombre sin la extension
                    $extension = pathinfo($nombrear, PATHINFO_EXTENSION);//obtengo la extension del archivo
                    $nombre = $request->documento.'_'.$request->fechapago.'_'.$request->venta_id.'.'.$extension;//armo el nombre del archivo
        
                
                    $destination = base_path() . '/public/recibos/clientes/'.$ano.'/'.$mes.'/'.$dia;//armo la ruta para la imagen
                    $subirarchivo = $request->file('file')->move($destination, $nombre);//subo la imagen a la carpeta
                }
        
                $pagos = new Pagos();
                $pagos->clientes_id =$clientes_id;
                $pagos->ventas_id =$venta_id;
                $pagos->documento =$request->documento;
                $pagos->fecha =$fecha;
                $pagos->agente =\Auth::user()->usuario;
                $pagos->formapago =$request->formapago;
                $pagos->origen_id =$request->origen_id;
                $pagos->destino_id =$request->destino_id;
                $pagos->saldo_anterior =$saldo_anterior;
                $pagos->valor =$request->valor;
                $pagos->fechapago =$request->fechapago;
                $pagos->comentario =$request->comentario;
                $pagos->tipopago =$request->tipopago;
                if ($request->file) {
                    $pagos->archivo ='recibos/clientes/'.$ano.'/'.$mes.'/'.$dia.'/'.$nombre;
                $pagos->nombreArchivo =$nombre;
                }
                $pagos->save();

                
               
                $total = ($datos->saldoDeuda+$datos->saldo_abono) - $request->valor;

                if ($datos->saldoDeuda <= $request->valor) {

                    Ventas::where('id',$venta_id)->update(['saldoDeuda' => 0]);
                    Ventas::where('id',$venta_id)->update(['estado_abono' => 0]);

                    $devolucion =  $request->valor - $datos->saldoDeuda;
                    Ventas::where('id',$venta_id)->update(['devolucion' =>  $devolucion]);
                }else{
                    Ventas::where('id',$venta_id)->update(['saldoDeuda' => $datos->saldoDeuda - $request->valor]);
                    Ventas::where('id',$venta_id)->update(['estado_abono' => 1]);
                }
                
                

                if ($total<0) {
                    Ventas::where('id',$venta_id)->update(['estadoVenta_id' => 5]);// 
                }else{
                    Ventas::where('id',$venta_id)->update(['estadoVenta_id' => 2]);// 

                }
                if ($datos->saldoDeuda =0) {
                    Ventas::where('id',$venta_id)->update(['estadoVenta_id' => 6]);// 
                }

                //////////
                $cuotasSaldo =  Cuotas::where('venta_id',$venta_id)->first();
                $ActuaizarcuotasSaldo  = Cuotas::where('venta_id',$venta_id)->update(['saldodeuda' => $total]);// 

                ////// cuotas detalle
                $cuota_id = $cuotasSaldo->id;
                $credito = floatval($request->valor);

                while ($credito > 0):
                    $cuotasDetalle =  Cuotasdetalle::where('cuota_id',$cuota_id)->where('saldo_cuota','>',0)->first();

                    if (!empty($cuotasDetalle->saldo_cuota)) {
                    
                        if($cuotasDetalle->saldo_cuota <= $credito){ //50.13 es menor a 50.00 ----no entra
                            Cuotasdetalle::where('id',$cuotasDetalle->id)->update(['saldo_cuota' => 0]);
                            Cuotasdetalle::where('id',$cuotasDetalle->id)->update(['estado' => 'CANCELADA']);
                        }elseif ($cuotasDetalle->saldo_cuota>$credito ) {
                                Cuotasdetalle::where('id',$cuotasDetalle->id)->update(['saldo_cuota' => $cuotasDetalle->saldo_cuota - $credito]);
                                Cuotasdetalle::where('id',$cuotasDetalle->id)->update(['estado' => 'PENDIENTE']);
                        }
                        $credito = $credito - $cuotasDetalle->saldo_cuota; 

                    }else{
                        $credito =0;
                    }
                    
                endwhile;

                return response()->json(['success' => 'Pago Registrado Correctamente'], 200);
            }
  
        }else{
            $request->valor = floatval($request->valor);
            
              
                if ($datos->saldoDeuda <= $request->valor) {
                    Ventas::where('id',$venta_id)->update(['saldoDeuda' => 0]);
                    Ventas::where('id',$venta_id)->update(['estado_abono' => 0]);

                    $devolucion =  $request->valor - $datos->saldoDeuda;
                    Ventas::where('id',$venta_id)->update(['devolucion' =>  $devolucion]);
                }else{
                    Ventas::where('id',$venta_id)->update(['saldoDeuda' => $datos->saldoDeuda - $request->valor]);
                    Ventas::where('id',$venta_id)->update(['estado_abono' => 1]);
                }
               
               
            if ($datos->saldo_abono <1) {
                Ventas::where('id',$venta_id)->update(['estado_abono' => 0]);
            }
               
            

            if ($request->file) 
            {
                $nombrear = $request->file->getClientOriginalName();//obtengo el nombre del archivo
                $filename = pathinfo($nombrear, PATHINFO_FILENAME);//obtengo el nombre sin la extension
                $extension = pathinfo($nombrear, PATHINFO_EXTENSION);//obtengo la extension del archivo
                $nombre = $request->documento.'_'.$request->fechapago.'_'.$request->venta_id.'.'.$extension;//armo el nombre del archivo
    
            
                $destination = base_path() . '/public/recibos/clientes/'.$ano.'/'.$mes.'/'.$dia;//armo la ruta para la imagen
                $subirarchivo = $request->file('file')->move($destination, $nombre);//subo la imagen a la carpeta
            }
    
            $pagos = new Pagos();
            $pagos->clientes_id =$clientes_id;
            $pagos->ventas_id =$venta_id;
            $pagos->documento =$request->documento;
            $pagos->fecha =$fecha;
            $pagos->agente =\Auth::user()->usuario;
            $pagos->formapago =$request->formapago;
            $pagos->origen_id =$request->origen_id;
            $pagos->destino_id =$request->destino_id;
            $pagos->saldo_anterior =$saldo_anterior;
            $pagos->valor =$valorPago;
            $pagos->fechapago =$request->fechapago;
            $pagos->comentario =$request->comentario;
            $pagos->tipopago =1;
            if ($request->file) {
                $pagos->archivo ='recibos/clientes/'.$ano.'/'.$mes.'/'.$dia.'/'.$nombre;
            $pagos->nombreArchivo =$nombre;
            }
            $pagos->save();

            return response()->json(['success' => 'Se registro el Pago con Exito.'], 200);
        }
      
        return response()->json(['success' => 'Error'], 200);
    }

    public function addrecibo(Request $request )
    {   
      $id = $request->id;

      $date = Carbon::now();
      $fecha= $date->format('Y-m-d H:i');
      $ano= $date->format('Y');
      $mes= $date->format('m');
      $dia= $date->format('d');

      $datos =  Pagos::where('id',$id)->first();

     

            if ($request->file) 
            {
                $nombrear = $request->file->getClientOriginalName();//obtengo el nombre del archivo
                $filename = pathinfo($nombrear, PATHINFO_FILENAME);//obtengo el nombre sin la extension
                $extension = pathinfo($nombrear, PATHINFO_EXTENSION);//obtengo la extension del archivo
                $nombre = $datos->documento.'_'.$datos->fechapago.'_'.$datos->venta_id.'.'.$extension;//armo el nombre del archivo
    
             
                $destination = base_path() . '/public/recibos/clientes/'.$ano.'/'.$mes.'/'.$dia;//armo la ruta para la imagen
                $subirarchivo = $request->file('file')->move($destination, $nombre);//subo la imagen a la carpeta
            }
     
            Pagos::where('id',$id)->update(['archivo' => 'recibos/clientes/'.$ano.'/'.$mes.'/'.$dia.'/'.$nombre]);// 
            Pagos::where('id',$id)->update(['nombreArchivo' => $nombre]);// 
            Pagos::where('id',$id)->update(['agenteRecibo' => \Auth::user()->usuario]);// 
            Pagos::where('id',$id)->update(['fechaRecibo' => $fecha]);// 
        
            return response()->json(['success' => 'Recibo Cargado Correctamente'], 200);


      
     

       
         
       
    }
}

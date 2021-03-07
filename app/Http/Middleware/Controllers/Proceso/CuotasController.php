<?php

namespace App\Http\Controllers\Proceso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proceso\Ventas;
use App\Models\Proceso\Clientes;
use App\Models\Proceso\Productos;
use App\Models\Proceso\Proevedor;
use App\Models\Proceso\Cuotas;
use App\Models\Proceso\Cuotasdetalle;
use DB;
use Carbon\Carbon;
class CuotasController extends Controller
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
       
        // return view('proceso.cuotas.index');
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
        //dd($request);

        try
        {     
            $productovalor = Productos::where('id',$request->producto_id)->first();
            $cliente = Clientes::where('id',$request->cliente_id)->first();
            if ($request->tipoventa_id==1) 
            {
            
                $date = Carbon::now();
                $fecha= $date->format('Y-m-d H:i');

                $ventas = new Ventas();
                $ventas->cliente_id = $request->cliente_id;
                $ventas->producto_id = $request->producto_id;
                $ventas->tipoVenta_id = $request->tipoventa_id;
                $ventas->interes = $request->interes;

                $ventas->valorDeuda = $request->montodeuda;
                $ventas->abono = $request->abono;
                $ventas->saldo_abono = $request->abono;
                $ventas->estado_abono = 1;
                $ventas->adicional = $request->adicional;
                $ventas->descuento = $request->descuento;
                $ventas->monto_cobrar = $request->monto_cobrar;


                $ventas->contrato = $request->contrato;
                $ventas->cantidadproducto = $request->cantidadproducto;
                $ventas->users_id = \Auth::user()->usuario;
                $ventas->estadoVenta_id = 3;

                $ventas->porcentajeVenta = $request->porcentajeVenta;
                $ventas->save();
                


                $cuota = new Cuotas();
                $cuota->cliente_id = $request->cliente_id;
                $cuota->venta_id = $ventas->id;
                //$cuota->saldodeuda = $request->monto_cobrar;
                $cuota->periodo = $request->periodo;
                $cuota->interes = $request->interes;
                $cuota->cuota = $request->cuota;
                $cuota->abono = $request->abono;
                $cuota->saldo_abono = $request->abono;
                $cuota->estado_abono = 1;
                $cuota->fecha_pago = $request->fecha_pago;
                $cuota->user_id = \Auth::user()->id;
                $cuota->fecha_registro = $fecha;
                $cuota->save();
                

                    


                $data = $request->detalleCuota;

                for($i = 0; $i < count($data); $i++){
                    
                    $cuotadetalle = new Cuotasdetalle();
                    $cuotadetalle->cuota_id = $cuota->id;
                    $cuotadetalle->venta_id = $ventas->id;
                    $cuotadetalle->periodo = $data[$i]['id'];
                    $cuotadetalle->saldo_inicial = $data[$i]['saldo_inicial'];
                    $cuotadetalle->interes = $data[$i]['interes'];
                    $cuotadetalle->cuota = $data[$i]['cuota'];
                    $cuotadetalle->saldo_cuota = $data[$i]['cuota'];
                    $cuotadetalle->abono = $data[$i]['abono'];
                    $cuotadetalle->fecha_pago = $data[$i]['fecha_pago'];
                    $cuotadetalle->saldo_final = $data[$i]['saldo_final'];
                    $cuotadetalle->asesor = \Auth::user()->usuario;
                    $cuotadetalle->fecha_registro = $fecha;
                    $cuotadetalle->estado = 'PENDIENTE';
                    $cuotadetalle->save();

                }

                
                    $cuotas_ventas_id  = Ventas::where('id',$ventas->id)->update(['cuota_id' => $cuota->id]);// actualizar el id de la cuota

                    $llenarValores = DB::connection('mysql')->statement("UPDATE _ventas AS T1,
                                (SELECT SUM(interes) AS intereses, SUM(cuota) AS SaldoDeuda,cuota_id
                                    FROM _cuotasdetalle 
                                    WHERE cuota_id=$cuota->id) AS T2 
                                    SET T1.intereses=T2.intereses,T1.saldodeuda=T2.SaldoDeuda,T1.totalPagar=T2.SaldoDeuda
                                WHERE 
                                        T1.cuota_id = T2.cuota_id 
                                    AND T1.id=$ventas->id 
                                                    ");

                        $SALDOCUOTA = DB::connection('mysql')->statement("UPDATE _cuotas AS T1,
                                                                            (SELECT saldoDeuda,cuota_id
                                                                                FROM _ventas 
                                                                                WHERE id=$ventas->id) AS T2 
                                                                                SET T1.saldodeuda=T2.saldoDeuda
                                                                            WHERE 
                                                                                    T1.id = T2.cuota_id 
                                                                                AND T1.venta_id=$ventas->id 
                                                                        ");
                            $menoscantidad = $productovalor->cantidad - $request->cantidadproducto; 
                         
                            Productos::where('id',$request->producto_id)->update(['restante' => $menoscantidad]);// actualizar el id de la cantidad de stop

                return response()->json(['success' => 'Estimado usuario, el cliente '.$cliente->apellidoPaterno.' '.$cliente->nombre1.' tiene una deuda con el Producto de '.$productovalor->nombre.' con un saldo de $'.$request->montodeuda.' menos el abono $'.($request->montodeuda - $cuota->abono).', los pagos los efectuará al cabo de '.$cuota->periodo.' mes(es), con una cuota de $'.round($cuota->cuota, 3).', su primer pago lo debe realizar a partir del '.date('d/m/Y', strtotime($cuota->fecha_pago."+ 1 month"))], 202);
            }else
            {
                $ventas = new Ventas();

                $ventas->cliente_id = $request->cliente_id;
                $ventas->producto_id = $request->producto_id;
                $ventas->tipoVenta_id = $request->tipoventa_id;
                $ventas->valorDeuda = $request->saldoDeuda;
                //$ventas->abono = $request->saldoDeuda;
                $ventas->saldoDeuda = $request->saldoDeuda;
                $ventas->totalPagar = $request->saldoDeuda;
                //$ventas->saldo_abono = $request->saldoDeuda;
                $ventas->estado_abono = 1;
                $ventas->monto_cobrar = $request->saldoDeuda;
                $ventas->contrato = $request->contrato;
                $ventas->cantidadproducto = 1;
                $ventas->users_id = \Auth::user()->usuario;
                $ventas->estadoVenta_id = 3;
                $ventas->porcentajeVenta = $request->porcentajeVenta;
                $ventas->save();

                $menoscantidad = $productovalor->cantidad - $request->cantidadproducto; 
               
                Productos::where('id',$request->producto_id)->update(['restante' => $menoscantidad]);// actualizar el id de la cantidad de stop
                            
                
                return response()->json(['success' => 'Su venta Registrada DESCONTADO fue guardada con Exito..!'], 202);

            }

        }
        catch(Exception $e)
        {
           return response()->json(['errores' => 'Lo sentimos se ha presentado un problema interno en el servidor'], 500);
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
        //
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
        //
    }
}

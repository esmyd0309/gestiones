<?php

namespace App\Http\Controllers\Proceso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proceso\Clientes;
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
class ClientesController extends Controller
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
           
            return view('proceso.cliente.index');
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
        //dd( $request);

        
        $date = Carbon::now();
        $fecha= $date->format('Y-m-d H:i');
        $ano= $date->format('Y');
        $mes= $date->format('m');
        $dia= $date->format('d');
  
  
              $clientes = new Clientes();
              $clientes->cedula = $request->cedula;
              $clientes->nombre1 = $request->nombre1;
              $clientes->nombre2 = $request->nombre2;
              $clientes->apellidoPaterno = $request->apellidoPaterno;
              $clientes->apellidoMaterno = $request->apellidoMaterno;
              $clientes->fechaNacimiento = $request->fechaNacimiento;
              $clientes->prefijo = $request->prefijo;
              $clientes->numero = $clientes->prefijo.$request->numero;
              $clientes->salario = $request->salario;
              $clientes->email = $request->email;
              $clientes->nombreDocumento = $request->nombreDocumento;
              // $clientes->telefonoConvencional =  $request->telefonoConvencional;
              $clientes->prefijotrabajo =  $request->prefijotrabajo;
              $clientes->telefonoTrabajo =  $clientes->prefijotrabajo.$request->telefonoTrabajo;
              $clientes->extension =  $request->extension;
              $clientes->direccionDomicilio =  $request->direccionDomicilio;
              $clientes->direccionTrabajo =  $request->direccionTrabajo;
              $clientes->nombreEmpresa =  $request->nombreEmpresa;
              $clientes->cargo =  $request->cargo;
              $clientes->usuario = \Auth::user()->usuario;
           
  
          
              $clientes->save();
  
            
  
              return redirect()
                              ->back()
                              ->with('info', 'Cliente Agregada Correctamente..!');  
    }

    public function adddocumento(Request $request )
    {   
      $id = $request->id;

      $datos =  Clientes::where('id',$id)->first();

      $date = Carbon::now();
      $fecha= $date->format('Y-m-d H:i');
      $ano= $date->format('Y');
      $mes= $date->format('m');
      $dia= $date->format('d');


      if ($request->file) {
        $nombre = time().'_'.$request->file->getClientOriginalName();
       
        
        $destination = base_path() . '/public/ducumentos/clientes/'.$ano.'/'.$mes.'/'.$dia;//armo la ruta para la imagen
        $subirarchivo = $request->file('file')->move($destination, $nombre);//subo la imagen a la carpeta

        $documento        = Clientes::where('id',$id)->update(['documento' => 'ducumentos/clientes/'.$ano.'/'.$mes.'/'.$dia.'/'.$nombre]);// 
        $nombreDocumento  = Clientes::where('id',$id)->update(['nombreDocumento' => $nombre]);// 
        $agenteDocumetno   = Clientes::where('id',$id)->update(['agenteDocumetno' => \Auth::user()->usuario]);// 
        $fechadocumento  = Clientes::where('id',$id)->update(['fechadocumento' => $fecha]);// 
        
        return response()->json(['success' => 'Documento Cargado Correctamente'], 200);


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
        $cliente = Clientes::findOrFail($id);
        $cliente->delete();
        return response()->json(['success' => 'Se ha eliminado el Cliente!!']);
       
    }
}

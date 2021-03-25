<?php

namespace App\Http\Controllers\Clientes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Data;
use App\Models\Provincia;
use App\Models\Canton;
use App\Models\Sector;
use App\Models\Clientes\Clientes;
use DateTime;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;


class ClientesController extends Controller
{

    public function listaclientes(Request $request)
    {   

       
        if ($request) 
        {
            $cedula = $request->get('cedula');
            $data = Clientes::orderBy('id', 'DESC')
            ->cedula($cedula)
            ->paginate(10);
        

            return response()->json($data, 200);
        }

        return response()->json([], 200);
    }

    public function guardarcliente(Request $request)
    {   

       
        $provincia = Provincia::where('codigo',$request->provincia)->first();
        $canton = Canton::where('codigo',$request->canton)->first(); 
        $sector = Sector::where('codigo',$request->sector)->first();  
       

        
        $cliente = new Clientes;
        $cliente->nombres               =   $request->nombres; 
        $cliente->apellidos             =   $request->apellidos; 
        $cliente->cedula                =   $request->cedula; 
        $cliente->telefonoWhatsapp      =   $request->telefonoWhatsapp; 
        $cliente->telefonoCelular       =   $request->telefonoCelular; 
        $cliente->telefonoCasa          =   $request->telefonoConvencional; 
        $cliente->direccion             =   $request->direccion; 
        $cliente->provincia             =   $provincia->Provincia ; 
        $cliente->canton                =   $canton->canton; 
        $cliente->sector                =   $sector->sector; 
        $cliente->codigo_provincia             =   $request->provincia ; 
        $cliente->codigo_canton                =   $request->canton; 
        $cliente->codigo_sector                =   $request->sector; 
        $cliente->villa                 =   $request->villa; 
        $cliente->email                 =   $request->email; 
        $cliente->ubicacion             =   $request->ubicacion; 
        $cliente->mz                    =   $request->mz; 
        $cliente->referencia            =   $request->referencia;
       
        $cliente->save();

        

        
         return response()->json($cliente);
    }

    public function actualizarcliente(Request $request)
    {   
        
        $provincia = Provincia::where('codigo',$request->provincia)->first();
        $canton = Canton::where('codigo',$request->canton)->first(); 
        $sector = Sector::where('codigo',$request->sector)->first();  
       
        $cliente = Clientes::findOrFail($request->id);
        
        $cliente->nombres               =   $request->nombres; 
        $cliente->apellidos             =   $request->apellidos; 
        $cliente->cedula                =   $request->cedula; 
        $cliente->telefonoWhatsapp      =   $request->telefonoWhatsapp; 
        $cliente->telefonoCelular       =   $request->telefonoCelular; 
        $cliente->telefonoCasa          =   $request->telefonoConvencional; 
        $cliente->direccion             =   $request->direccion; 

        $cliente->provincia             =   $provincia->Provincia; 
        $cliente->canton                =   $canton->canton; 
        $cliente->sector                =   $sector->sector;  

        $cliente->codigo_provincia             =   $request->provincia; 
        $cliente->codigo_canton                =   $request->canton; 
        $cliente->codigo_sector                =   $request->sector; 

        $cliente->email                 =   $request->email; 
        $cliente->ubicacion             =   $request->ubicacion; 
        $cliente->villa                 =   $request->villa; 
        $cliente->mz                    =   $request->mz; 
        $cliente->referencia            =   $request->referencia;
        
        $cliente->update();
        return response()->json($cliente);
    }

    public function deletecliente(Clientes $id)
    {   

        $id->delete();
        return response()->json([], 200);
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Data;
use App\Models\Clientes\Clientes;
use DateTime;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller
{
    public function listacontactos(Request $request)
    {   

       
        if ($request) 
        {
            $data = Data::whereNull('actualizado')->orderBy('id')->paginate(10);
        

            return response()->json($data, 200);
        }

        return response()->json([], 200);
    }

    
    public function consultarcontacto($id)
    {   
        
       
        if ($id) 
        {
            $data = Data::where('id',$id)->get();

            return response()->json($data, 200);
        }

        return response()->json([], 200);
    }


    public function getcanton($provincia){
        $canton = DB::connection('mysql')->select("SELECT * FROM canton where provincia_id='$provincia'");
        return response()->json($canton);
    }

    public function getprovincia(){
        
        $provincia = DB::connection('mysql')->select("SELECT * FROM provincia");
        
        return response()->json($provincia);
    }

    
    public function getprovinciaid($id){
        
        $provincia = DB::connection('mysql')->select("SELECT * FROM provincia where codigo='$id'");
        
        return response()->json($provincia);
    }

    public function getSector($canton){
        $sector = DB::connection('mysql')->select("SELECT * FROM sector where canton_id='$canton'");
        return response()->json($sector);
    }

   
}
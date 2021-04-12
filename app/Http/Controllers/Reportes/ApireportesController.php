<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ApireportesController extends Controller
{
    public function clientes()
    {   

        $data = DB::connection('mysql')->select("SELECT COUNT(DISTINCT(cedula)) AS cantidad FROM clientes");

            return response()->json($data, 200);
       
    }
}

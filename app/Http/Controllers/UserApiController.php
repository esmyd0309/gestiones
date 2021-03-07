<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Cargo;
use App\Models\Admin\Genero;
use App\Models\Admin\Empresa;
use App\Models\Admin\Departamento;
use App\Models\Admin\CargoDepartamento;
use App\Models\Admin\DepartamentoEmpresa;
use App\Imports\ImportUsers;
use App\Imports;
use Excel;
use DateTime;
use DB;
use Illuminate\Support\Facades\Input;
class UserApiController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usuariosActuales($usuario)
    {   
        $usuario = User::searchWhere('usuario', '=', $usuario)->select('usuario')->first();
       
        return $usuario;
    }

    public function store(Request $request)
    {   
       
       
          
            $user = new User();
            $user->nombres = $request->nombres;
            $user->apellidos = $request->apellidos;
            $user->email = $request->email;
            $user->usuario = $request->usuario;
            $user->password =  bcrypt($request->contrasena);

            
            $user->save();
            return $user;  
        
       
    }

    


  

}

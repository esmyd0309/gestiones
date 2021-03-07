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
class UserController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        dd($request);
        $users = User::with('genero')->searchWhere('cedula', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('nombre1', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('nombre2', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('apellido_paterno', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('apellido_materno', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('usuario', 'LIKE', '%'.$request->get('search').'%')
    
            ->orderBy('id', 'desc')->paginate(30);

        return view('users.index', ['users' => $users]);
    }


    public function otro(Request $request)
    {   
        dd($request);
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('users.create');
    }




    public function sanear_string($string)
    {
 
            $string = trim($string);
        
            $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                $string
            );
        
            $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                $string
            );
        
            $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                $string
            );
        
            $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                $string
            );
        
            $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                $string
            );
        
            $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'),
                array('n', 'N', 'c', 'C',),
                $string
            );
 
    
 
 
        return $string;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();

        $validate = \Validator::make($request->all(), [          
            'cedula' => 'required|unique:users',
            'nombre1' => 'required',
            'nombre2' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
           
         
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }


      

       

        $user->cedula = $request->cedula;
        $user->nombre1 = $request->nombre1;
        $user->nombre2 = $request->nombre2;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;

        $user->email = $request->email;
        $user->foto = 'user.png';    
        $usuariogenerado = $this->getNickname(strtolower($request->nombre1), strtolower($request->nombre2), strtolower($request->apellido_paterno), strtolower($request->apellido_materno));
        
        $user->usuario = $this->sanear_string($usuariogenerado);
        $user->password = bcrypt($request->cedula);
        $user->enabled = $request->enabled;
        if (empty($request->direccion) || empty($request->celular) || empty($request->telefono) || empty($request->estado_civil) || empty($request->email) || empty($request->genero_id) || empty($request->discapacidad) || empty($request->extension) || empty($request->fecha_nacimiento))  
        {
            $user->perfil_actualizado = false;
        }
        else
        {
            $user->perfil_actualizado = true;
        }

       
      $user->save();



        return redirect()->route('users.edit', $user->id)->with('msg', 'Usuario registrado !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('usuarioRoles')
                    
                    ->findOrFail($id);
                    
        return view('users.show', ['user' => $user]);
    }


    public function getNickname($nombre1, $nombre2, $apellido_paterno, $apellido_materno)
    {
        $nick = $nombre1[0].''.$apellido_paterno;
        
        $findUserNick1 = User::searchWhere('usuario', '=', $nick)->first();

        if (!empty($findUserNick1)) 
        {
            $nick .= $apellido_materno[0];

            $findUserNick2 = User::searchWhere('usuario', '=', $nick)->first();

            if (!empty($findUserNick2)) 
            {
                $nick .= $nombre2[0];
            }
        }

        return $nick;
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $generos = Genero::orderBy('id', 'asc')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        $user = User::with(['usuarioRoles', 'genero'])->findOrFail($id);

        return view('users.edit', ['user' => $user, 'roles' => $roles, 'generos' => $generos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //DD($request);
        $validate = \Validator::make($request->all(), [          
            'cedula' => ['required','unique:users,cedula,'.$user->id],
            'nombre1' => 'required',
            'nombre2' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'genero_id' => 'required',
           
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $user->cedula = $request->cedula;
        $user->nombre1 = $request->nombre1;
        $user->nombre2 = $request->nombre2;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->direccion = $request->direccion;
        $user->celular = $request->celular;
        $user->telefono = $request->telefono;        
        $user->estado_civil = $request->estado_civil;
        $user->email = $request->email;
        $user->genero_id = $request->genero_id;
        $user->enabled = $request->enabled;
        $user->update();

        $user->roles()->sync($request->get('roles'));

        return redirect()->route('users.edit', $user->id)->with('msg', 'Usuario actualizado !!');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('msg', 'Usuario borrado !!');
    }




    public function import()
    {   
      

        return view('Import.user');
    }

    public function importUsers(Request $request)
    {
        //dd($request);

        Excel::import(new ImportUsers,request()->file('file'));

        return redirect()->route('inicio')
        ->with('info', 'Archivo Guardada con Éxito');


       
    }

  

  

}

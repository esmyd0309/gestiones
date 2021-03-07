<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Admin\Role;
use App\Models\Data;
use DateTime;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;

class DatatelefonoController extends Controller
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
      
        $data = Data::orderBy('id', 'desc')->paginate(10);
        //dd($data );
        return view('comentarios.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request)
    {   
       dd($request);
    }







    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $usuario = Auth::user()->usuario;
        //dd($request);
        $comentarios = new Data();
        $comentarios->titulo = $request->titulo;
        $comentarios->comentario = $request->comentario;
        $comentarios->users_id = $usuario;
       
        $comentarios->save();



        return redirect()->route('comentarios.index')->with('msg', 'Comentario registrado !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comentario = Data::where('id',$id)->first();
                    
        return view('Comentarios.show', ['comentario' => $comentario]);
    }


    public function reportes()
    {
       dd('construcción');
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
      

        return view('Comentarios.edit', ['user' => $user, 'roles' => $roles, 'generos' => $generos]);
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
        
        $user->cedula = $request->cedula;
        $user->nombre1 = $request->nombre1;
        $user->nombre2 = $request->nombre2;
 
        $user->update();

       

        return redirect()->route('comentarios.edit')->with('msg', 'Comentario actualizado !!');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Data::findOrFail($id);
        $user->delete();
        return back()->with('msg', 'Comentario borrado !!');
    }


  

}

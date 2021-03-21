<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes\Clientes;
use App\Models\Data;
use App\User;
use Auth;
class HomeController extends Controller
{
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuario = Auth::user()->usuario;
        $cliente = Clientes::orderBy('id', 'desc')->paginate(15);

        
        return view('Clientes.index');
    	
        //return view('home', ['clientes' => $cliente]);
    }

    public function inicio()
    {
      
        return view('inicio');
    }
}

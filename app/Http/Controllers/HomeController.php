<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $comentario = Data::orderBy('id', 'desc')->paginate(3);

        

    	
        return view('home', ['comentarios' => $comentario]);
    }

    public function inicio()
    {
      
        return view('inicio');
    }
}

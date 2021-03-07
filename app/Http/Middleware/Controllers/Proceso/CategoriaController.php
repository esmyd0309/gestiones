<?php

namespace App\Http\Controllers\Proceso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proceso\Categoria;
use DataTables;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Categoria::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                       
                        $btn =  '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit  editProeevedor"><i class="fas fa-edit"></i></a>&nbsp;';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class=" deleteProeevedor"><i class="fas fa-trash-alt"></i></a>';

     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            return response()->json($categoria, 200);

        }
       
        return view('proceso.categorias.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($request->estado)){
            $request->estado="of";
        }else{
            $request->estado="on";
        }
        Categoria::updateOrCreate([
                                        'id' => $request->id
                                    ],
                                    [
                                        'nombre' => $request->nombre, 
                                        'descripcion' => $request->descripcion,
                                        'nota' => $request->nota,
                                        'estado' => $request->estado,

        ]);        

    return response()->json(['success'=>'Creada con Exito.',$request->estado]);
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
        
        $categoria = Categoria::find($id);
        return response()->json($categoria);
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
        
        Categoria::find($id)->delete();
     
        return response()->json(['success'=>'Registro Borrado.']);
    }
}

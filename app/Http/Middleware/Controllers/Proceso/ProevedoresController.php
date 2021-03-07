<?php

namespace App\Http\Controllers\Proceso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proceso\Proevedor;
use DataTables;

class ProevedoresController extends Controller
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
        
        if($request->ajax()){
            $data = Proevedor::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                       
                        $btn =  '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit  editProeevedor"><i class="fas fa-edit"></i></a>&nbsp;';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class=" deleteProeevedor"><i class="fas fa-trash-alt"></i></a>';

     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            return response()->json($proevedores, 200);

        }
       
        return view('proceso.proevedores.index');
    }

    public function store(Request $request)
    {
      
        Proevedor::updateOrCreate([
                                    'id' => $request->id
                                ],
                                [
                                    'nombre' => $request->nombre, 
                                    'descripcion' => $request->descripcion,
                                    'direccion' => $request->direccion,
                                    'tipo' => $request->tipo,
                                    'telefono' => $request->telefono,
                                    'comentario' => $request->comentario,

                                ]);        
   
        return response()->json(['success'=>'Persona Creada con Exito.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proeevedor = Proevedor::find($id);
        return response()->json($proeevedor);
    }

    public function show($id)
    {
        $proeevedor = Proevedor::find($id);
        
        return response()->json($proeevedor);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Proevedor::find($id)->delete();
     
        return response()->json(['success'=>'Registro Borrado.']);
    }
}

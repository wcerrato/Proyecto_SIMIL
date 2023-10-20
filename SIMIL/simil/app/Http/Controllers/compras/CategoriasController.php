<?php

namespace App\Http\Controllers\compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class CategoriasController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $categorias = HTTP::get('http://127.0.0.1:9000/api/simil/compras/CATEGORIAS');
            $categorias_array = $categorias->json();
            return view('/compras/categorias', compact('categorias_array'));
        
        }else{
            
            return view('login');
            
        }
        
    }
    
    public function editar_categoria(Request $request){

        $validator = Validator::make($request->all(),[
            
            'editar_descripcion_categoria' => 'required|min:5|max:50'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/compras/',[
                'PV_ACCION' => 'CATEGORIAS', 
                'PV_NOM_CATEGORIA' => $request->editar_descripcion_categoria,
                'PE_ESTADO' => $request->editar_estado_categoria, 
                'PB_COD_CATEGORIA' => $request->editar_codigo_categoria
            ]);

            return back()->with('mensaje_guardado','Categoria editado correctamente.');
            
        }
        
    }
    
    public function guardar_categoria(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'descripcion_categoria' => 'required|min:5|max:50'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/compras/',[
                        'PV_ACCION' => 'CATEGORIAS', 
                        'PE_ESTADO' => 'A', 
                        'PV_NOM_CATEGORIA' => $request->descripcion_categoria
            ]);
            
            return back()->with('mensaje_guardado','Categoria guardado correctamente.');
            
        }
        
    }
    
}

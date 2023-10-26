<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class ParametrosGeneralesController extends Controller
{
    
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $parametros = HTTP::get('http://127.0.0.1:9000/api/simil/parametros');
            $parametros_array = $parametros->json();
            return view('/usuarios/parametros_generales', compact('parametros_array'));
            
        }else{
            
            return view('login');
            
        }
        
    }
    
    public function editar_parametro(Request $request){

        $validator = Validator::make($request->all(),[
            
            'editar_descripcion_parametro' => 'required|min:5|max:50',
            'editar_valor_parametro' => 'required|min:1|max:50'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/',[
                'PV_ACCION' => 'parametros', 
                'PV_PARAMETRO' => $request->editar_descripcion_parametro,
                'PV_VALOR' => $request->editar_valor_parametro,
                'PE_ESTADO' => $request->editar_estado_parametro, 
                'PB_COD_PARAMETRO' => $request->editar_codigo_parametro
            ]);

            return back()->with('mensaje_guardado','Parametro editado correctamente.');
            
        }
        
    }
    
    public function guardar_parametro(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'descripcion_parametro' => 'required|min:5|max:50',
            'valor_parametro' => 'required|min:1|max:50'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/',[
                        'PV_ACCION' => 'parametros', 
                        'PE_ESTADO' => 'A', 
                        'PV_PARAMETRO' => $request->descripcion_parametro, 
                        'PV_VALOR' => $request->valor_parametro
            ]);
            
            return back()->with('mensaje_guardado','Parametro guardado correctamente.');
            
        }
        
    }
    
}

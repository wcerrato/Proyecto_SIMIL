<?php

namespace App\Http\Controllers\inventarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class AjustesController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $ajustes = HTTP::get('http://127.0.0.1:9000/api/simil/Inventario/ajustes');
            $ajustes_array = $ajustes->json();

            return view('/inventarios/ajustes', compact('ajustes_array'));
            
        }else{
            
            return view('login');
            
        }    
        
    }
    
    public function guardar_ajuste(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'fecha_ajuste' => 'required',
            'tipo_ajuste' => 'required',
            'producto_ajuste' => 'required|integer',
            'cantidad_ajuste' => 'required|integer|between:0,100000'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{  
            
            HTTP::post('http://127.0.0.1:9000/api/simil/Inventario/',[
                        'PV_ACCION' => 'ajuste',
                        'PE_ESTADO' => 'A',
                        'PI_FECHA' => $request->fecha_ajuste, 
                        'PE_TIPO_MOVIMIENTO' => $request->tipo_ajuste, 
                        'PB_COD_PRODUCTO' => $request->producto_ajuste, 
                        'PI_CANTIDAD' => $request->cantidad_ajuste
            ]);
            
            if($request->tipo_ajuste == 'ENT'){
                
                HTTP::put('http://127.0.0.1:9000/api/simil/Inventario/',[
                
                    'PV_ACCION' => 'sumar_existencia', 
                    'PB_COD_PRODUCTO' => $request->producto_ajuste,
                    'PI_CANTIDAD' => $request->cantidad_ajuste

                ]);
                
            }elseif($request->tipo_ajuste == 'SAL'){
                
                HTTP::put('http://127.0.0.1:9000/api/simil/Inventario/',[
                
                    'PV_ACCION' => 'restar_exitencia', 
                    'PB_COD_PRODUCTO' => $request->producto_ajuste,
                    'PI_CANTIDAD' => $request->cantidad_ajuste

                ]);
                
            }

            return back()->with('mensaje_guardado','Ajuste aplicado correctamente.');
            
        }
        
    }
    
}

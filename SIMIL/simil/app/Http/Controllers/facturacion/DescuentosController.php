<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class DescuentosController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $descuentos = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/descuento');
            $descuentos_array = $descuentos->json();
            return view('/facturacion/descuentos', compact('descuentos_array'));
            
        }else{
            
            return view('login');
            
        }
        
    }
    
    public function editar_descuento(Request $request){

        $validator = Validator::make($request->all(),[
            
            'editar_descripcion_descuento' => 'required|min:5|max:50',
            'editar_porcentaje_descuento' => 'required|integer|between:0,100'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/facturas/',[
                'PV_ACCION' => 'descuento', 
                'PV_NOM_DESC' => $request->editar_descripcion_descuento,
                'PD_PORCENTAJE_DESCONTAR' => $request->editar_porcentaje_descuento,
                'PE_ESTADO' => $request->editar_estado_descuento, 
                'PB_COD_DESCUENTO' => $request->editar_codigo_descuento
            ]);

            return back()->with('mensaje_guardado','Descuento editado correctamente.');
            
        }
        
    }
    
    public function guardar_descuento(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'descripcion_descuento' => 'required|min:5|max:50',
            'porcentaje_descuento' => 'required|integer|between:0,100'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/facturas/',[
                        'PV_ACCION' => 'descuento', 
                        'PE_ESTADO' => 'A', 
                        'PV_NOM_DESC' => $request->descripcion_descuento, 
                        'PD_PORCENTAJE_DESCONTAR' => $request->porcentaje_descuento
            ]);
            
            return back()->with('mensaje_guardado','Descuento guardado correctamente.');
            
        }
        
    }
    
}

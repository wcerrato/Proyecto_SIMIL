<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class TipoFacturaController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $tipo_factura = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/tipo_factura');
            $tipo_factura_array = $tipo_factura->json();
            return view('/facturacion/tipo_factura', compact('tipo_factura_array'));
            
        }else{
            
            return view('login');
            
        }

        
    }

    public function editar_tipo_factura(Request $request){

        $validator = Validator::make($request->all(),[
            'editar_cod_tipo_factura' => 'required',
            'editar_nombre_tipo_factura' => 'required|min:5|max:150',
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/facturas/',[
                'PV_ACCION' => 'tipo_factura', 
                'PV_NOM_TIPO_FACTURA' => $request->editar_nombre_tipo_factura,
                'PE_ESTADO' => $request->editar_estado_tipo_factura, 
                'PB_COD_TIPO_FACTURA' => $request->editar_cod_tipo_factura
            ]);

            return back()->with('mensaje_guardado','Tipo de factura editada correctamente.');
            
        }
        
    }


    public function guardar_tipo_factura(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'nombre_tipo_factura' => 'required|min:5|max:150',
            
          
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/facturas/',[
                        'PV_ACCION' => 'tipo_factura', 
                        'PE_ESTADO' => 'A', 
                        'PV_NOM_TIPO_FACTURA' => $request->nombre_tipo_factura, 
                       
            ]);
            
            return back()->with('mensaje_guardado','Tipo de factura guardada correctamente.');
            
        }
        
    }

}
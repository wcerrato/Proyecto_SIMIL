<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class NumeracionesSARController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $numeracion_sar = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/talonario');
            $numeracion_sar_array = $numeracion_sar->json();
            return view('/facturacion/numeraciones_sar', compact('numeracion_sar_array'));
            
        }else{
            
            return view('login');
            
        }    
        
    }
    
    public function editar_numeracion_sar(Request $request){

        $validator = Validator::make($request->all(),[
         
            'editar_rango_inicial_numeracion_sar' => 'required|integer|between:0,1000000',
            'editar_rango_final_numeracion_sar' => 'required|integer|between:0,1000000',
            'editar_rango_actual_numeracion_sar' => 'required|integer|between:0,1000000',
            'editar_fecha_vencimiento_numeracion_sar' => 'required|date',
            'editar_num_cai_numeracion_sar' => 'required|integer|between:0,1000000'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/facturas/',[
                'PV_ACCION' => 'talonario',
                'PI_RANGO_INICIAL' => $request->editar_rango_inicial_numeracion_sar,
                'PI_RANGO_FINAL' => $request->editar_rango_final_numeracion_sar,
                'PI_RANGO_ACTUAL' => $request->editar_rango_actual_numeracion_sar, 
                'PF_FEC_VENCIMIENTO' => $request->editar_fecha_vencimiento_numeracion_sar, 
                'PI_NUM_CAI' => $request->editar_num_cai_numeracion_sar, 
                'PE_ESTADO' => $request->editar_estado_numeracion_sar, 
                'PB_COD_TALONARIO_CAI' => $request->editar_codigo_numeracion_sar
            ]);

            return back()->with('mensaje_guardado','Numeración sar editada correctamente.');
            
        }
        
    }
    
    public function guardar_numeracion_sar(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'rango_inicial_numeracion_sar' => 'required|integer|between:0,1000000',
            'rango_final_numeracion_sar' => 'required|integer|between:0,1000000',
            'rango_actual_numeracion_sar' => 'required|integer|between:0,1000000',
            'fec_vencimiento_numeracion_sar' => 'required|date',
            'num_cai_numeracion_sar' => 'required|integer|between:0,1000000'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/facturas/',[
                'PV_ACCION' => 'talonario', 
                'PI_RANGO_INICIAL' => $request->rango_inicial_numeracion_sar,
                'PI_RANGO_FINAL' => $request->rango_final_numeracion_sar,
                'PI_RANGO_ACTUAL' => $request->rango_actual_numeracion_sar, 
                'PF_FEC_VENCIMIENTO' => $request->fec_vencimiento_numeracion_sar, 
                'PI_NUM_CAI' => $request->num_cai_numeracion_sar, 
                'PE_ESTADO' => 'A'

            ]);
            
            return back()->with('mensaje_guardado','Numeración sar guardada correctamente.');
            
        }
        
    }
    
}

<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class FormaPagoController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $forma_pago = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/forma_pago');
            $forma_pago_array = $forma_pago->json();
            return view('/facturacion/forma_pago', compact('forma_pago_array'));
        
        }else{
            
            return view('login');
            
        }
        
    }
    
    public function editar_forma_pago(Request $request){

        $validator = Validator::make($request->all(),[

            'editar_codigo_forma_pago' => 'required',
            'editar_descripcion_forma_pago' => 'required|min:5|max:150'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/facturas/',[
                'PV_ACCION' => 'forma_pago', 
                'PV_NOM_FORMA_PAGO' => $request->editar_descripcion_forma_pago,
                'PE_ESTADO' => $request->editar_estado_forma_pago, 
                'PB_COD_FORMA_PAGO' => $request->editar_codigo_forma_pago
            ]);

            return back()->with('mensaje_guardado','Forma de pago editada correctamente.');
            
        }
        
    }
    
    public function guardar_forma_pago(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'descripcion_forma_pago' => 'required|min:5|max:150'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/facturas/',[
                        'PV_ACCION' => 'forma_pago', 
                        'PE_ESTADO' => 'A', 
                        'PV_NOM_FORMA_PAGO' => $request->descripcion_forma_pago
            ]);
            
            return back()->with('mensaje_guardado','Forma de pago guardada correctamente.');
            
        }
        
    }
    
}

<?php

namespace App\Http\Controllers\compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;
use Illuminate\Validation\Rule;





class ComprasController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $compras = HTTP::get('http://127.0.0.1:9000/api/simil/compras/ENC_COMPRAS');
            $compras_array = $compras->json();
            

            $proveedores = HTTP::get('http://127.0.0.1:9000/api/simil/compras/PROVEEDOR');
            $proveedores_array = $proveedores->json();
            
            
            $forma_pago = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/forma_pago');
            $forma_pago_array = $forma_pago->json();
            


            return view('/compras/compras', compact('compras_array','proveedores_array','forma_pago_array'));


            
        }else{
            
            return view('login');
            
        }
        
    }

    public function editar_compra(Request $request){

        $validator = Validator::make($request->all(),[
            
            'editar_fecha_compra' => 'required|min:8|max:10',
            'editar_total_compra' => 'required|min:1|max:20',
            'editar_factura_compra' => 'required|min:1|max:20'

        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/',[
                'PV_ACCION' => 'ENC_COMPRAS', 
                'PT_FEC_COMPRA' => $request->editar_fecha_compra,
                'PD_TOT_COMPRA' => $request->editar_total_compra, 
                'PV_FACTURA_NO' => $request->editar_factura_compra,
                'PB_COD_PROVEEDOR' => $request->editar_proveedor_compra, 
                'PB_COD_FORMA_PAGO' => $request->editar_pago_compra,                                               
                'PE_ESTADO' => $request->editar_estado_compra,
                'PB_COD_ENC_COMPRA' => $request->editar_codigo_enc_compra
                
                
            ]);

            return back()->with('mensaje_guardado','Compra editada correctamente.');
            
        }
        
    }
    
    public function guardar_compra(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'fecha_compra' => 'required|min:8|max:10',
            'total_compra' => 'required|min:1|max:20',
            'factura_compra' => 'required|min:1|max:20'

            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            
            
            HTTP::post('http://127.0.0.1:9000/api/simil/',[
                        'PV_ACCION' => 'ENC_COMPRAS', 
                        'PE_ESTADO' => 'A', 
                        'PT_FEC_COMPRA' => $request->fecha_compra,
                        'PD_TOT_COMPRA' => $request->total_compra,
                        'PV_FACTURA_NO' => $request->factura_compra, 
                        'PB_COD_PROVEEDOR' => $request->proveedor_compra,
                        'PB_COD_FORMA_PAGO' => $request->pago_compra
            ]);
            
            return back()->with('mensaje_guardado','Compra guardada correctamente.');
            
        }
        
    }
    
}

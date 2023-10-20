<?php

namespace App\Http\Controllers\compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class ProveedoresController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $proveedores = HTTP::get('http://127.0.0.1:9000/api/simil/compras/PROVEEDOR');
            $proveedores_array = $proveedores->json();
            return view('/compras/proveedores', compact('proveedores_array'));
        
        }else{
            
            return view('login');
            
        }
        
    }
    
    public function editar_proveedor(Request $request){

        $validator = Validator::make($request->all(),[
            
            'editar_descripcion_proveedor' => 'required|min:5|max:50',
            'editar_rtn_proveedor' => 'required|min:14|max:14',
            'editar_direccion_proveedor' => 'required|min:5|max:50',
            'editar_telefono_proveedor' => 'required|min:8|max:8',
            'editar_correo_proveedor' => 'required|email:rfc'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/compras/',[
                'PV_ACCION' => 'PROVEEDOR', 
                'PV_NOM_PROVEEDOR' => $request->editar_descripcion_proveedor,
                'PV_DNI_RTN' => $request->editar_rtn_proveedor,
                'PB_COD_DIRECCION' => $request->editar_direccion_proveedor, 
                'PB_COD_TELEFONO' => $request->editar_telefono_proveedor,
                'PB_COD_CORREO' => $request->editar_correo_proveedor,
                'PE_ESTADO' => $request->editar_estado_proveedor,
                'PB_COD_PROVEEDOR' => $request->editar_codigo_proveedor
            ]);

            return back()->with('mensaje_guardado','Proveedor editado correctamente.');
            
        }
        
    }
    
    public function guardar_proveedor(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'descripcion_proveedor' => 'required|min:5|max:50',
            'rtn_proveedor' => 'required|min:14|max:14',
            'direccion_proveedor' => 'required|min:5|max:50',
            'telefono_proveedor' => 'required|min:8|max:8',
            'correo_proveedor' => 'required|email:rfc'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            
            
            HTTP::post('http://127.0.0.1:9000/api/simil/compras/',[
                        'PV_ACCION' => 'PROVEEDOR', 
                        'PE_ESTADO' => 'A', 
                        'PV_NOM_PROVEEDOR' => $request->descripcion_proveedor, 
                        'PV_DNI_RTN' => $request->rtn_proveedor,
                        'PV_PRO_DIRECCION' => $request->direccion_proveedor,
                        'PV_PRO_TELEFONO' => $request->telefono_proveedor,
                        'PV_PRO_CORREO' => $request->correo_proveedor
            ]);
            
            return back()->with('mensaje_guardado','Proveedor guardado correctamente.');
            
        }
        
    }
    
}

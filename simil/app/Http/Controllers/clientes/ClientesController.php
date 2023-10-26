<?php

namespace App\Http\Controllers\clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class ClientesController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $clientes = HTTP::get('http://127.0.0.1:9000/api/simil/Persona/CLIENTE');
            $clientes_array = $clientes->json();

            $personas = HTTP::get('http://127.0.0.1:9000/api/simil/Persona/PERSONAS');
            $personas_array = $personas->json();

            return view('/clientes/clientes', compact('clientes_array','personas_array'));
            
        }else{
            
            return view('login');
            
        }    
        
    }

    public function editar_cliente(Request $request){

        $validator = Validator::make($request->all(),[
            
                'editar_nombre_cliente' => 'required|min:5|max:100',
                'editar_rtn_cliente' => 'required|min:14|max:14',
                'editar_persona_clientes' => 'required|min:1|max:100',
                'editar_telefono_cliente' => 'required|min:8|max:8',
                'editar_correo_cliente' => 'required|email:rfc',
                'editar_region_cliente' => 'required|min:1|max:100',
                'editar_direccion_cliente' => 'required|min:1|max:100'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/Persona/',[
                    'PV_ACCION' => 'CLIENTE',  
                    'PI_CODIGO_PERSONA' => $request->editar_codigo_persona, 
                    'PV_NOM_EMPRESA' => $request->editar_nombre_cliente,
                    'PI_RTN' => $request->editar_rtn_cliente,
                    'PV_REGION' => $request->editar_region_cliente,
                    'PC_ESTADO' => $request->editar_estado_cliente,
                    'PI_COD_CLIENTE' => $request->editar_codigo_cliente
            ]);

            return back()->with('mensaje_guardado','Cliente editado correctamente.');
            
        }
        
    }

public function guardar_cliente(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'nombre_empresa' => 'required|min:5|max:100',
            'rtn_cliente' => 'required|min:14|max:14',
            'region_cliente' => 'required|min:1|max:100',
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::put('http://127.0.0.1:9000/api/simil/Persona/',[
                'PV_ACCION' => 'CLIENTE',  
                'PI_CODIGO_PERSONA' => $request->codigo_persona, 
                'PV_NOM_EMPRESA' => $request->nombre_cliente,
                'PI_RTN' => $request->rtn_cliente,
                'PV_REGION' => $request->region_cliente,
                'PC_ESTADO' => $request->estado_cliente,
                'PI_COD_CLIENTE' => $request->codigo_cliente
        ]);
            
            return back()->with('mensaje_guardado','Cliente guardado correctamente.');
            
        }
        
    }


}
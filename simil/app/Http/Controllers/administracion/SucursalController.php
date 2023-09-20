<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class SucursalController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
            
        
            $sucursales = HTTP::get('http://127.0.0.1:9000/api/simil/Persona/SUCURSAL');
            $sucursal_array = $sucursales->json();
            return view('/administracion/sucursal', compact('sucursal_array'));
            
        }else{
            
            return view('login');
            
        }
        
    }
    
    public function editar_sucursal(Request $request){

        $validator = Validator::make($request->all(),[
            
            'editar_nombre_sucursal' => 'required|min:5|max:50'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/Persona/',[
                'PV_ACCION' => 'SUCURSAL', 
                'PV_NOM_SUCURSAL' => $request->editar_nombre_sucursal,
                'PI_COD_PERSONA' => 1,
                'PC_ESTADO' => $request->editar_estado_sucursal, 
                'PI_COD_SUCURSAL' => $request->editar_codigo_sucursal
            ]);

            return back()->with('mensaje_guardado','Sucursal editado correctamente.');
            
        }
        
    }
    
    public function guardar_sucursal(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'nombre_sucursal' => 'required|min:5|max:50'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/Persona/',[
                        'PV_ACCION' => 'SUCURSAL', 
                        'PC_ESTADO' => 'A', 
                        'PI_COD_PERSONA' => 1, 
                        'PV_NOM_SUCURSAL' => $request->nombre_sucursal
            ]);
            
            return back()->with('mensaje_guardado','Sucursal guardado correctamente.');
            
        }
        
    }
    
}

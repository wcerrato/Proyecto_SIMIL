<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class RolesController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $roles = HTTP::get('http://127.0.0.1:9000/api/simil/roles');
            $Roles_array = $roles->json();

            return view('/usuarios/roles', compact('Roles_array'));
            
        } else {
            
            return view('login');
            
        }    
        
    }
    
    public function editar_roles(Request $request){

        $validator = Validator::make($request->all(),[
            
            'editar_nombre_rol' => [
                'required',
                'min:5',
                'max:30',
                'regex:/^[A-Z]+$/',
            ],
            'editar_descripcion_rol' => 'required|min:5|max:100',

            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/',[
                
                'PV_ACCION' => 'roles', 
                'PE_ESTADO' => $request->editar_estado_rol, 
                'PV_NOM_ROL' => $request->editar_nombre_rol, 
                'PV_DES_ROL' => $request->editar_descripcion_rol,
                'PB_COD_ROL' => $request->editar_codigo_rol

            ]);

            return back()->with('mensaje_guardado','Rol editado correctamente.');
            
        }
        
    }
    
    public function guardar_roles(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'nombre_rol' => [
                'required',
                'min:5',
                'max:30',
                'regex:/^[A-Z]+$/',
            ],
            'descripcion_rol' => 'required|min:5|max:100',

            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/',[
                        'PV_ACCION' => 'roles', 
                        'PE_ESTADO' => 'A', 
                        'PV_NOM_ROL' => $request->nombre_rol, 
                        'PV_DES_ROL' => $request->descripcion_rol

            ]);
            
            return back()->with('mensaje_guardado','Rol guardado correctamente.');
            
        }
        
    }
    
}

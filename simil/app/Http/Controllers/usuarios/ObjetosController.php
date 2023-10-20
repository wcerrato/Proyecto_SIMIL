<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class ObjetosController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $objetos = HTTP::get('http://127.0.0.1:9000/api/simil/objetos');
            $Objetos_array = $objetos->json();

            return view('/usuarios/objetos', compact('Objetos_array'));
            
        } else {
            
            return view('login');
            
        }    
        
    }
    public function editar_objetos(Request $request){

        $validator = Validator::make($request->all(),[
            
            'editar_nombre_objeto' => 'required|alpha|min:5|max:100',
            'editar_descripcion_objeto' => 'required|min:5|max:100',
            'editar_tipo_objeto' => 'required|min:5|max:15',

            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/',[
                
                'PV_ACCION' => 'objetos', 
                'PE_ESTADO' => $request->editar_estado_objeto, 
                'PV_OBJETO' => $request->editar_nombre_objeto, 
                'PV_DES_OBJETO' => $request->editar_descripcion_objeto,
                'PV_TIP_OBJETO' => $request->editar_tipo_objeto,  
                'PB_COD_OBJETO' => $request->editar_codigo_objeto

            ]);

            return back()->with('mensaje_guardado','Objeto editado correctamente.');
            
        }
        
    }
    
    public function guardar_objetos(Request $request){
        
       

        $validator = Validator::make($request->all(), [
            'nombre_objeto' => 'required|alpha|min:5|max:100',
            //'nombre_objeto' => 'required|alpha|min:5|max:100|unique:TBL_MS_OBJETOS,OBJETO',
            'descripcion_objeto' => 'required|min:5|max:100',
            'tipo_objeto' => 'required|min:5|max:15',
                
    
        ]);


        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/',[
                        'PV_ACCION' => 'objetos', 
                        'PE_ESTADO' => 'A', 
                        'PV_OBJETO' => $request->nombre_objeto, 
                        'PV_DES_OBJETO' => $request->descripcion_objeto,
                        'PV_TIP_OBJETO' => $request->tipo_objeto


            ]);
            
            return back()->with('mensaje_guardado','Objeto guardado correctamente.');
            
        }
        
    }





    
    
}

//onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"
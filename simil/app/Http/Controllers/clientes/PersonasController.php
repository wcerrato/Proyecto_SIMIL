<?php

namespace App\Http\Controllers\clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class PersonasController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $personas = HTTP::get('http://127.0.0.1:9000/api/simil/Persona/PERSONAS');
            $personas_array = $personas->json();
            return view('/clientes/personas', compact('personas_array'));
            
        }else{
            
            return view('login');
            
        }
        
    }
    
    public function editar_persona(Request $request){

        $validator = Validator::make($request->all(),[
            
                'editar_identidad_persona' => 'required|min:13|max:13',
                'editar_nombre_persona' => 'required|min:5|max:100',
                'editar_sexo_persona' => 'required|min:1|max:1',
                'editar_edad_persona' => 'required|integer|between:0,150',
                'editar_tipo_persona' => 'required|min:1|max:1'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/Persona/',[
                    'PV_ACCION' => 'PERSONA',  
                    'PV_IDENTIDAD' => $request->editar_identidad_persona, 
                    'PV_NOM_PERSONA' => $request->editar_nombre_persona,
                    'PC_SEX_PERSONA' => $request->editar_sexo_persona,
                    'PI_EDA_PERSONA' => $request->editar_edad_persona,
                    'PC_TIP_PERSONA' => $request->editar_tipo_persona,
                    'PC_ESTADO' => $request->editar_estado_persona,
                    'PI_COD_PERSONA' => $request->editar_codigo_persona
            ]);

            return back()->with('mensaje_guardado','Persona editada correctamente.');
            
        }
        
    }
    
    public function guardar_persona(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'identidad_persona' => 'required|min:13|max:13',
            'nombre_persona' => 'required|min:5|max:100',
            'sexo_persona' => 'required|min:1|max:1',
            'edad_persona' => 'required|integer|between:0,150',
            'tipo_persona' => 'required|min:1|max:1'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/Persona/',[
                    'PV_ACCION' => 'PERSONA', 
                    'PE_ESTADO' => 'A', 
                    'PV_IDENTIDAD' => $request->identidad_persona, 
                    'PV_NOM_PERSONA' => $request->nombre_persona,
                    'PC_SEX_PERSONA' => $request->sexo_persona,
                    'PI_EDA_PERSONA' => $request->edad_persona,
                    'PC_TIP_PERSONA' => $request->tipo_persona
            ]);
            
            return back()->with('mensaje_guardado','Persona guardada correctamente.');
            
        }
        
    }
}

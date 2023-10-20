<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class UsuariosController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $usuarios = HTTP::get('http://127.0.0.1:9000/api/simil/usuario');
            $usuarios_array = $usuarios->json();

            $personas = HTTP::get('http://127.0.0.1:9000/api/simil/Persona/PERSONAS');
            $personas_array = $personas->json();

            $roles = HTTP::get('http://127.0.0.1:9000/api/simil/roles');
            $roles_array = $roles->json();


            $preguntas = HTTP::get('http://127.0.0.1:9000/api/simil/preguntas');
            $preguntas_array = $preguntas->json();

            return view('/usuarios/usuarios', compact('usuarios_array','personas_array','roles_array', 'preguntas_array'));
            
        }else{
            
            return view('login');
            
        }    
        
    }
    
    public function editar_usuario(Request $request){

        $validator = Validator::make($request->all(),[
            
            'editar_cod_usuario' => 'required|min:5|max:8',
            'editar_contrasena_usuario' => 'required|min:5|max:8'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/',[
                
                'PV_ACCION' => 'usuario', 
                'PE_ESTADO' => $request->editar_estado_usuario, 
                'PB_COD_ROL' => $request->editar_rol_usuario,
                'PB_COD_PERSONA' => $request->editar_persona_usuario,
                'PB_COD_USUARIO' => $request->editar_cod_usuario,
                'PV_CONTRASEÑA' => $request->editar_contrasena_usuario,
                'PE_ESTADO_USUARIO' => $request->editar_estado_usuario,
                'PT_FEC_ULTIMA_CONECCION' => date('Y-m-d',strtotime(now())), 
                'PI_PREGUNTAS_CONTESTADAS' => 1,
                'PT_PRIMER_INGRESO' => date('Y-m-d',strtotime(now())),
                'PD_FEC_VENCIMIENTO' => date('Y-m-d',strtotime(now()))
            ]);

            return back()->with('mensaje_guardado','Usuario editado correctamente.');
            
        }
        
    }
    
    public function guardar_usuario(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'cod_usuario' => 'required|min:5|max:50',
            'contrasena' => 'required|min:5|max:50'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/',[
                        'PV_ACCION' => 'usuario', 
                        'PE_ESTADO' => 'A', 
                        'PB_COD_ROL' => $request->rol_usuario,
                        'PB_COD_PERSONA' => $request->persona_usuario,
                        'PV_COD_USUARIO' => $request->cod_usuario,
                        'PV_CONTRASEÑA' => $request->contrasena,
                        'PE_ESTADO_USUARIO' => 'A',
                        'PT_FEC_ULTIMA_CONECCION' => date('Y-m-d',strtotime(now())), 
                        'PI_PREGUNTAS_CONTESTADAS' => 1,
                        'PT_PRIMER_INGRESO' => date('Y-m-d',strtotime(now())),
                        'PD_FEC_VENCIMIENTO' => date('Y-m-d',strtotime(now())),
                        'PB_COD_PREGUNTA'=> $request->pregunta_usuario,
                        'PV_RESPUESTA'=> $request->respuesta
            ]);
            
            return back()->with('mensaje_guardado','Usuario guardado correctamente.');
            
        }
        
    }
    
}

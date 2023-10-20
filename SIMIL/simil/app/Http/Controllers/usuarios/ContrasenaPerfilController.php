<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class ContrasenaPerfilController extends Controller
{
    
    public function index() {
        
        if(session('login')=='TRUE'){

            $preguntas = HTTP::get('http://127.0.0.1:9000/api/simil/preguntas');
            $preguntas_array = $preguntas->json();
        
            return view('/usuarios/contrasenaPerfil', compact('preguntas_array'));
            
        }else{
            
            return view('login');
            
        }
        
    }
    
    public function cambiar_contrasena_Perfil(Request $request){
        
        if($request->contrasena <> $request->confirmar_contrasena){
            
            return back()->with('mensaje_guardado','Las contraseñas deben ser la misma para poder realizar el cambio.');
            
        }
        
        $validator = Validator::make($request->all(),[
            'contrasena' => [
                'required',
                'min:5',
                'max:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!]).*$/',
            ],
        ]);
        
        $validator->setAttributeNames([
            'contrasena' => 'Contraseña', // Cambia 'contrasena' por el nombre deseado para el campo.
        ]);
        
        $validator->setCustomMessages([
            'regex' => 'La :attribute debe contener al menos una letra minúscula, una letra mayúscula, un número y un carácter especial.',
        ]);
        
        if($validator->fails()){

            return back()
                ->with('mensaje_guardado', $validator->errors()->first('contrasena'))
                ->withInput()
                ->withErrors($validator);
        
            
        }else{
            
            $usuarios = HTTP::get('http://127.0.0.1:9000/api/simil/usuario');
            $usuarios_array = $usuarios->json();
            foreach($usuarios_array[0] AS $usuario){

                $contrasena_actual = ''; // Inicializar con un valor vacío
                foreach ($usuarios_array[0] as $usuario) {
                    if ($usuario['COD_USUARIO'] == session('user')) {
                        $contrasena_actual = $usuario['CONTRASEÑA'];
                        break; // Terminar el bucle una vez encontrada la contraseña
                    }
                }
                
                // Verificar que la contraseña sea la misma que la contraseña actual
                if ($contrasena_actual != $request->contrasena_anterior) {
                    return back()->with('mensaje_guardado', 'La contraseña actual no es correcta.');
                }

                // Verificar que la nueva contraseña sea diferente de la contraseña actual
                if ($contrasena_actual == $request->contrasena) {
                    return back()->with('mensaje_guardado', 'La contraseña debe ser diferente de la contraseña actual.');
                }
                
                if($usuario['COD_USUARIO'] == session('user')){
                    $rol = $usuario['COD_ROL'];
                    $persona = $usuario['COD_PERSONA'];
                    $primer_ingreso = date('Y-m-d',strtotime($usuario['PRIMER_INGRESO']));
                    $ultima_conexion = date('Y-m-d',strtotime($usuario['FEC_ULTIMA_CONECCION']));
                    $fecha_vencimiento = date('Y-m-d',strtotime($usuario['FEC_VENCIMIENTO']));
                }
                
            }
            
            HTTP::put('http://127.0.0.1:9000/api/simil/',[
                
                'PV_ACCION' => 'usuario', 
                'PE_ESTADO' => 'A', 
                'PB_COD_ROL' => $rol,
                'PB_COD_PERSONA' => $persona,
                'PB_COD_USUARIO' => session('user'),
                'PV_CONTRASEÑA' => $request->contrasena,
                'PE_ESTADO_USUARIO' => 'A',
                'PT_FEC_ULTIMA_CONECCION' => $ultima_conexion, 
                'PI_PREGUNTAS_CONTESTADAS' => 1,
                'PT_PRIMER_INGRESO' => $primer_ingreso,
                'PD_FEC_VENCIMIENTO' => $fecha_vencimiento
            ]);
            
            $request->session()->forget('login');
            $request->session()->forget('user');
            $request->session()->forget('cod_factura');
            $request->session()->forget('producto');
            return view('login');
            
        }
    
    }
}

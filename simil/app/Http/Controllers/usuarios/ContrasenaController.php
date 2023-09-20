<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class ContrasenaController extends Controller
{
    
     public function index() {
        
        if(session('login')=='TRUE'){
        
            return view('/usuarios/contrasena');
            
        }else{
            
            return view('login');
            
        }
        
    }
    
    public function cambiar_contrasena(Request $request){
        
        if($request->contrasena <> $request->confirmar_contrasena){
            
            return back()->with('mensaje_guardado','Las contraseñas deben ser la misma para poder realizar el cambio.');
            
        }
        
        $validator = Validator::make($request->all(),[
            
            'contrasena' => 'required|min:5|max:50',
            'confirmar_contrasena' => 'required|min:5|max:50'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            $usuarios = HTTP::get('http://127.0.0.1:9000/api/simil/usuario');
            $usuarios_array = $usuarios->json();
            foreach($usuarios_array[0] AS $usuario){
                
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

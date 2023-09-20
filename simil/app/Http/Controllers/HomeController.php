<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class HomeController extends Controller
{
    public function index() {
        
        if(session('login') == 'TRUE'){
            
            return view('home');
         
        }else if(session('login') == 'FALSE'){    
         
            return view('login');
            
        }else{
            
            return view('login');
            
        }
        
    }
    
    public function logout(Request $request){
        
        $request->session()->forget('login');
        $request->session()->forget('user');
        $request->session()->forget('cod_factura');
        $request->session()->forget('producto');
        return view('login');
        
    }
    
    public function login(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'usuario' => 'required',
            'contrasena' => 'required'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            $usuario = HTTP::get('http://127.0.0.1:9000/api/simil/usuario');
            $usuarios_array = $usuario->json();
            session(['login'=>'FALSE']);

            foreach($usuarios_array[0] as $usuarios){
                
                if($usuarios['COD_USUARIO'] == $request->usuario && $usuarios['CONTRASEÑA'] == $request->contrasena){
                    
                    session(['login'=>'TRUE']);
                    session(['user'=>$usuarios['COD_USUARIO']]);
                    return view('home');
                    
                }
                
            }
            
            session(['login'=>'FALSE']);
            return back()->with('mensaje_guardado','Usuario o contraseña incorrectos.');
            
        }
        
    }
    
}

<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermisosController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $var = 'Soy el modulo de permisos y estoy en desarrollo.';
            return view('/usuarios/permisos')->with('leyenda',$var);
        
        }else{
            
            return view('login');
            
        }
        
    }
}

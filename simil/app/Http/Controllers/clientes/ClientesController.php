<?php

namespace App\Http\Controllers\clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $var = 'Soy el modulo de clientes y estoy en desarrollo.';
            return view('/clientes/clientes')->with('leyenda',$var);
            
         }else{
            
            return view('login');
            
        }

    }
}

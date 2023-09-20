<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecibosController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $var = 'Soy el modulo de recibos y estoy en desarrollo.';
            return view('/facturacion/recibos')->with('leyenda',$var);
        
        }else{
            
            return view('login');
            
        }
        
    }
}

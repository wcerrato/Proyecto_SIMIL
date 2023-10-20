<?php

namespace App\Http\Controllers\inventarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoMovimientoController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $var = 'Soy el modulo de tipo de movimientos y estoy en desarrollo.';
            return view('/inventarios/tipo_movimiento')->with('leyenda',$var);
            
        }else{
            
            return view('login');
            
        }
        
    }
}

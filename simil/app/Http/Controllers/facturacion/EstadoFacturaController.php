<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstadoFacturaController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $var = 'Soy el modulo de estados de facturas y estoy en desarrollo.';
            return view('/facturacion/estado_factura')->with('leyenda',$var);
        
        }else{
            
            return view('login');
            
        }
        
    }
}

<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class DiasCreditoController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $dias_credito = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/descuento');
            $dias_credito_array = $dias_credito->json();
            return view('/facturacion/dias_credito', compact('dias_credito_array'));
            
        }else{
            
            return view('login');
            
        }    
        
    }
    
    public function guardar_descuentos(){
        
        return view();
        
        
    }
    
}

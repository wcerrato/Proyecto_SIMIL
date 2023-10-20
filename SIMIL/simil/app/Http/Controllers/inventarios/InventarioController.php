<?php

namespace App\Http\Controllers\inventarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $var = 'Soy el modulo de inventiros y estoy en desarrollo.';
            return view('/inventarios/inventario')->with('leyenda',$var);
            
        }else{
            
            return view('login');
            
        }
        
    }
}

<?php

namespace App\Http\Controllers\compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $var = 'Soy el modulo de compras y estoy en desarrollo.';
            return view('/compras/compras')->with('leyenda',$var);
            
        }else{
            
            return view('login');
            
        }
        
    }
}

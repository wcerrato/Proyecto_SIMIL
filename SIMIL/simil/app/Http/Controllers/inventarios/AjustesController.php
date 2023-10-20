<?php

namespace App\Http\Controllers\inventarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjustesController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
            
            $var = 'Soy el modulo de ajustes y estoy en desarrollo.';
            return view('/inventarios/ajustes')->with('leyenda',$var);
            
        }else{
            
            return view('login');
            
        }
        
    }
}

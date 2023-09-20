<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class BitacoraController extends Controller
{
    public function index() {
        
        if(session('login') == 'TRUE'){
        
            $roles = HTTP::get('http://127.0.0.1:9000/api/simil/bitacora');
            $Bitacora_array = $roles->json(); // Cambia $Roles_array a $Bitacora_array

            return view('/usuarios/bitacora', compact('Bitacora_array'));
            
        } else {
            
            return view('login');
            
        }    
        
    }
}
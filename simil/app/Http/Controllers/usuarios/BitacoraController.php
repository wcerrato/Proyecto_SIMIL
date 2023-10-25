<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class BitacoraController extends Controller
{
    public function index(Request $request) {

      /* $buscarpor=$request->get('buscarpor');*/
        
    
        if(session('login') == 'TRUE'){ 


            /*$roles = HTTP::get('http://127.0.0.1:9000/api/simil/bitacora');*/
            $roles = HTTP::get('http://127.0.0.1:9000/api/simil/bitacora');
            
            $busqueda= $request->busqueda;
            $categorias= BitacoraController::middleware('NOM_OBJETO','like','%'.$busqueda.'%')
                        ->orwhere('COD_BITACORA','like','%'.$busqueda.'%')
                        ->paginate(2); 



            /*compact('Bitacora_array','categorias','busqueda') */
           /*where('NOM_OBJETO','like',"%$buscarpor%")*/
            return view('/usuarios/bitacora',['Bitacora_array'=>$Bitacora_array,'busqueda'=>$busqueda,'categorias'=>$categorias]); /*['Bitacora_array'=>$Bitacora_array,'buscarpor'=>$buscarpor]);
           /* return view('/usuarios/bitacora', compact('Bitacora_array','buscarpor')); >where('Objeto','like','%'.$buscarpor.'%') */
        
        } else {
            
            return view('login');
            
        }    
        
    }
}
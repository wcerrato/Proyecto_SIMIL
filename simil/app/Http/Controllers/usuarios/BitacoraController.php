<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class BitacoraController extends Controller
{
    public function index(Request $request) {
        if (session('login') == 'TRUE') {
            $busqueda = $request->input('busqueda');
    
            $query = DB::table('TBL_MS_BITACORA');
    
            // Aplica la condición de búsqueda si se proporciona un valor no vacío
            if (!empty($busqueda)) {
                $query->where(function ($query) use ($busqueda) {
                    $query->where('NOM_OBJETO', 'like', '%' . $busqueda . '%')
                          ->orWhere('FECHA', 'like', '%' . $busqueda . '%')
                          ->orWhere('COD_USUARIO', 'like', '%' . $busqueda . '%')
                          ->orWhere('ACCION', 'like', '%' . $busqueda . '%');
                });
            }
    
            // Ordena los registros por la columna COD_BITACORA en orden descendente (de mayor a menor)
            $query->orderBy('COD_BITACORA', 'desc');
    
            $porPagina = $request->input('perPage',05); // Obtén el valor de 'perPage' de la solicitud o usa 10 como valor predeterminado
            $categorias = $query->paginate($porPagina);
    
            // Obtén los roles desde la API
            $bitacora = Http::get('http://127.0.0.1:9000/api/simil/bitacora')->json();
    
            return view('usuarios.bitacora', [
                'Bitacora_array' => $bitacora,
                'busqueda' => $busqueda,
                'categorias' => $categorias,
            ]);
        } else {
            return view('login');
        }
    }
    
}

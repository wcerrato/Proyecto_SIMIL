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

        // No apliques la condición de búsqueda si el campo de búsqueda está vacío
        if (!empty($busqueda)) {
            $query->where('ACCION', 'like', '%' . $busqueda . '%');
        }

        // Obtiene todos los registros sin paginación
        $categorias = $query->get();

        $porPagina = 10; // Cantidad de registros por página
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

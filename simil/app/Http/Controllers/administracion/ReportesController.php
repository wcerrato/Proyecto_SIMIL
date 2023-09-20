<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportesController extends Controller
{
    
    public function index() {

        if(session('login')=='TRUE'){
        
            return view('administracion/reportes');
            
         }else{
            
            return view('login');
            
        }
        
    }
    
    public function imprimir(Request $request){
        
        if($request->tipo_reporte == 'producto'){
        
            $productos = HTTP::get('http://127.0.0.1:9000/api/simil/compras/PRODUCTOS');
            $productos_array = $productos->json();
            $data = compact('productos_array');

            $pdf = Pdf::loadView('pdf.productos', $data);
            return $pdf->download('productos.pdf');
        
        }elseif($request->tipo_reporte == 'venta'){
            
            $ventas = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/factura');
            $ventas_array = $ventas->json();
            $data = compact('ventas_array');

            $pdf = Pdf::loadView('pdf.ventas', $data);
            return $pdf->download('ventas.pdf');
            
        }elseif($request->tipo_reporte == 'cliente'){
            
            $clientes = HTTP::get('http://127.0.0.1:9000/api/simil/Persona/CLIENTE');
            $clientes_array = $clientes->json();
            $data = compact('clientes_array');

            $pdf = Pdf::loadView('pdf.clientes', $data);
            return $pdf->download('clientes.pdf');
            
        }elseif($request->tipo_reporte == 'compra'){
            
            $compras = HTTP::get('http://127.0.0.1:9000/api/simil/compras/ENC_COMPRAS');
            $compras_array = $compras->json();
            $data = compact('compras_array');

            $pdf = Pdf::loadView('pdf.compras', $data);
            return $pdf->download('compras.pdf');
            
        }
        
    }
    
}

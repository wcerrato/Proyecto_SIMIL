<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturasController extends Controller
{
    
    public function index() {
        
        if(session('login')=='TRUE'){
            
            $numeracion_sar = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/talonario');
            $numeracion_sar_array = $numeracion_sar->json();
            foreach($numeracion_sar_array[0] AS $numeracion){
                $cai = $numeracion['NUM_CAI'];
                $factura_no = $numeracion['RANGO_ACTUAL'] + 1;
                $cod_talonario_cai = $numeracion['COD_TALONARIO_CAI'];
            }

            $clientes = HTTP::get('http://127.0.0.1:9000/api/simil/Persona/CLIENTE');
            $clientes_array = $clientes->json();
            
            $tipo_factura = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/tipo_factura');
            $tipo_factura_array = $tipo_factura->json();
            
            $forma_pago = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/forma_pago');
            $forma_pago_array = $forma_pago->json();
            
            $descuento = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/descuento');
            $descuento_array = $descuento->json();
            
            $produccion = HTTP::get('http://127.0.0.1:9000/api/simil/compras/PRODUCTOS');
            $produccion_array = $produccion->json();
        
            return view('/facturacion/facturas', compact('clientes_array','tipo_factura_array','forma_pago_array','descuento_array','produccion_array'))->with('cai',$cai)->with('factura_no',$factura_no)->with('cod_talonario_cai',$cod_talonario_cai);
            
        }else{
            
            return view('login');
            
        }
        
    }
    
    public function guardar_factura(Request $request){
        
        if($request->guardar_encabezado == 'SI'){
            
            $dias_credito = '0';
            
            if($request->tipo_factura == '1'){
                
                $dias_credito = '30';
                
            }

            HTTP::post('http://127.0.0.1:9000/api/simil/facturas/',[
                        'PV_ACCION' => 'factura',
                        'PE_ESTADO' => 'A',
                        'PB_COD_TIPO_FACTURA' => $request->tipo_factura,
                        'PB_COD_CLIENTE' => $request->cliente,
                        'PV_COD_USUARIO'  => session('user'),
                        'PB_NUM_FACTURA' => $request->factura_no,
                        'PE_ESTADO_FACTURA' => 'NO_VENCIDA',
                        'PB_COD_FORMA_PAGO' => $request->forma_pago,
                        'PE_DIAS_CREDITO' => $dias_credito,
                        'PB_COD_TALONARIO_CAI' => $request->cai,
                        'PB_COD_DESCUENTO' => $request->descuento,
                        'PI_NUM_ORDEN_COMPRA_EXENTA' => 0,
                        'PI_NUM_CONSTANCIA_REGISTRO_EXONERADOS' => 0,
                        'PI_NUM_REGISTRO_SAG' => 0
            ]);
            
            $cod_factura = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/max_factura');
            $cod_factura_array = $cod_factura->json();
            foreach($cod_factura_array[0] AS $cod){
                session(['cod_factura'=>$cod['COD_FACTURA']]);
            }
            
            $numeracion_sar = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/talonario');
            $numeracion_sar_array = $numeracion_sar->json();
            foreach($numeracion_sar_array[0] AS $numeracion){
                $cod_talonario_cai = $numeracion['COD_TALONARIO_CAI'];
                $cod_usuario = $numeracion['COD_USUARIO'];
                $rango_inicial = $numeracion['RANGO_INICIAL'];
                $rango_actual = $numeracion['RANGO_ACTUAL'];
                $rango_final = $numeracion['RANGO_FINAL'];
                $fecha_vencimiento = date('Y-m-d',strtotime($numeracion['FEC_VENCIMIENTO']));
                $cai = $numeracion['NUM_CAI'];
                $estado = $numeracion['ESTADO'];
            }
            
            HTTP::put('http://127.0.0.1:9000/api/simil/facturas/',[
                        'PV_ACCION' => 'talonario',
                        'PB_COD_TALONARIO_CAI' => $cod_talonario_cai,
                        'PV_COD_USUARIO' => $cod_usuario,
                        'PI_RANGO_INICIAL'  => $rango_inicial,
                        'PI_RANGO_FINAL' => $rango_final,
                        'PI_RANGO_ACTUAL' => $rango_actual + 1,
                        'PF_FEC_VENCIMIENTO' => $fecha_vencimiento,
                        'PI_NUM_CAI' => $cai,
                        'PE_ESTADO' => $estado
            ]);
            
            $encabezado = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/factura');
            $encabezado_array = $encabezado->json();

            foreach($encabezado_array[0] AS $encabezados){

                if($encabezados['COD_FACTURA'] == session('cod_factura')){

                    $enc_tipo_factura = $encabezados['NOM_TIPO_FACTURA'];
                    $enc_forma_pago = $encabezados['NOM_FORMA_PAGO'];
                    $enc_descuento = $encabezados['NOM_DESC'];
                    $enc_persona = $encabezados['NOM_PERSONA'];

                }
                
            }
            
            session(['encabezado_tipo_factura'=> $enc_tipo_factura]);
            session(['encabezado_forma_pago'=> $enc_forma_pago]);
            session(['encabezado_descuento'=> $enc_descuento]);
            session(['encabezado_persona'=> $enc_persona]);
            
            return back()->with('mensaje_guardado','Factura guardada correctamente, agrega los productos.');

            
        }elseif($request->guardar_lineas == 'SI'){
            
            list($cod_producto,$precio) = explode("@", $request->producto);
            
            HTTP::post('http://127.0.0.1:9000/api/simil/facturas/',[
                        'PV_ACCION' => 'detalle_factura',
                        'PE_ESTADO' => 'A',
                        'PV_COD_FACTURA' => session('cod_factura'),
                        'PB_COD_PRODUCCION' => $cod_producto,
                        'PD_PRECIO_VENTA'  => $precio,
                        'PI_CAN_PRODUCTO' => $request->cantidad,
                        'PD_IMPORTE' => $precio * $request->cantidad
            ]);
            
            $productos_factura = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/detalle_factura');
            $productos_factura_array = $productos_factura->json();
            
            $contador = 0;
            $subtotal_venta = 0;
            $impuesto_venta = 0;
            $descuento_venta = 0;
            $total_venta = 0;
            
            foreach($productos_factura_array[0] AS $lineas){

                if($lineas['COD_FACTURA'] == session('cod_factura')){

                    $lns_nombre = $lineas['NOM_PRODUCTO'];
                    $lns_precio = $lineas['PRECIO_VENTA'];
                    $lns_cantidad = $lineas['CAN_PRODUCTO'];
                    $lns_importe = $lineas['IMPORTE'];
                    
                    $subtotal_venta = $subtotal_venta + ($lns_precio * $lns_cantidad);
                    
                    $myarray[$contador] = array(
                            'nombre_producto' => $lns_nombre,
                            'precio_producto' => $lns_precio,
                            'cantidad_producto' => $lns_cantidad,
                            'importe_producto' => $lns_importe
                    );

                }
                
                $contador++;
                
            }
            
            $impuesto_venta = $subtotal_venta*0.15;
            $total_venta = $subtotal_venta + $impuesto_venta;
            
            session(['subtotal_venta'=>$subtotal_venta]);
            session(['impuesto_venta'=>$impuesto_venta]);
            session(['descuento_venta'=>$descuento_venta]);
            session(['total_venta'=>$total_venta]);
            
            session(['listado_producto'=>$myarray]);
            session(['producto'=>'SI']);
            
            return back()->with('mensaje_guardado','Producto guardado correctamente.');
        
        }elseif($request->imprimir == 'SI'){
            
            $factura = HTTP::get('http://127.0.0.1:9000/api/simil/facturas/factura');
            $factura_array = $factura->json();
            $data = compact('factura_array');

            $pdf = Pdf::loadView('pdf.factura', $data);
            
            $request->session()->forget('cod_factura');
            $request->session()->forget('producto');
            $request->session()->forget('encabezado_persona');
            $request->session()->forget('encabezado_tipo_factura');
            $request->session()->forget('encabezado_forma_pago');
            $request->session()->forget('encabezado_descuento');
            $request->session()->forget('listado_producto');
            $request->session()->forget('subtotal_venta');
            $request->session()->forget('impuesto_venta');
            $request->session()->forget('descuento_venta');
            $request->session()->forget('total_venta');
            
            return $pdf->download('factura.pdf');
            
        }else{
            
            return back();
            
        }
        
    }
    
}

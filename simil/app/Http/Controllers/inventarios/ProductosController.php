<?php

namespace App\Http\Controllers\inventarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class ProductosController extends Controller
{
    public function index() {
        
        if(session('login')=='TRUE'){
        
            $productos = HTTP::get('http://127.0.0.1:9000/api/simil/compras/PRODUCTOS');
            $productos_array = $productos->json();

            $categorias = HTTP::get('http://127.0.0.1:9000/api/simil/compras/CATEGORIAS');
            $categorias_array = $categorias->json();

            return view('/inventarios/productos', compact('productos_array','categorias_array'));
            
        }else{
            
            return view('login');
            
        }    
        
    }
    
    public function editar_producto(Request $request){

        $validator = Validator::make($request->all(),[
            
            'editar_nombre_producto' => 'required|min:5|max:50',
            'editar_descripcion_producto' => 'required|min:5|max:50',
            'editar_cantidad_producto' => 'required|integer|between:0,100000',
            'editar_precio_producto' => 'required|integer|between:0,100000'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('EditInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{

            HTTP::put('http://127.0.0.1:9000/api/simil/compras/',[
                
                'PV_ACCION' => 'PRODUCTOS', 
                'PE_ESTADO' => $request->editar_estado_producto, 
                'PV_NOM_PRODUCTO' => $request->editar_nombre_producto, 
                'PV_DESC_PRODUCTO' => $request->editar_descripcion_producto, 
                'PI_CANTIDAD' => $request->editar_cantidad_producto, 
                'PD_PRECIO_UNITARIO' => $request->editar_precio_producto, 
                'PB_COD_CATEGORIA' => $request->editar_categoria_producto,
                'PB_COD_PRODUCTO' => $request->editar_codigo_producto

            ]);

            return back()->with('mensaje_guardado','Producto editado correctamente.');
            
        }
        
    }
    
    public function guardar_producto(Request $request){
        
        $validator = Validator::make($request->all(),[
            
            'nombre_producto' => 'required|min:5|max:50',
            'descripcion_producto' => 'required|min:5|max:50',
            'cantidad_producto' => 'required|integer|between:0,100000',
            'precio_producto' => 'required|integer|between:0,100000'
            
        ]);
        
        if($validator->fails()){
            
            return back()
                    ->withInput()
                    ->with('ErrorInsert','Llenar todos los campos con la estructura correcta')
                    ->withErrors($validator);
            
        }else{
            
            HTTP::post('http://127.0.0.1:9000/api/simil/compras/',[
                        'PV_ACCION' => 'PRODUCTOS', 
                        'PE_ESTADO' => 'A', 
                        'PV_NOM_PRODUCTO' => $request->nombre_producto, 
                        'PD_DESC_PRODUCTO' => $request->descripcion_producto, 
                        'PI_CANTIDAD' => $request->cantidad_producto, 
                        'PD_PRECIO_UNITARIO' => $request->precio_producto, 
                        'PB_COD_CATEGORIA' => $request->categoria_producto
            ]);
            
            return back()->with('mensaje_guardado','Producto guardado correctamente.');
            
        }
        
    }
    
}

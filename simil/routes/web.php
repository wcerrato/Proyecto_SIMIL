<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('/', [App\Http\Controllers\HomeController::class, 'login']);
Route::put('/', [App\Http\Controllers\HomeController::class, 'logout']);


//RUTAS MODULO DE SEGURIDAD - PARAMETROS GENERALES
Route::get('/administracion/parametros_generales', [App\Http\Controllers\administracion\ParametrosGeneralesController::class, 'index']);
Route::post('/administracion/parametros_generales', [App\Http\Controllers\administracion\ParametrosGeneralesController::class, 'guardar_parametro']);
Route::put('/administracion/parametros_generales', [App\Http\Controllers\administracion\ParametrosGeneralesController::class, 'editar_parametro']);
//RUTAS MODULO DE SEGURIDAD - SUCURSALES
Route::get('/administracion/sucursal', [App\Http\Controllers\administracion\SucursalController::class, 'index']);
Route::post('/administracion/sucursal', [App\Http\Controllers\administracion\SucursalController::class, 'guardar_sucursal']);
Route::put('/administracion/sucursal', [App\Http\Controllers\administracion\SucursalController::class, 'editar_sucursal']);
//RUTAS MODULO DE SEGURIDAD - REPORTES
Route::get('/administracion/reportes', [App\Http\Controllers\administracion\ReportesController::class, 'index']);
Route::post('/administracion/reportes', [App\Http\Controllers\administracion\ReportesController::class, 'imprimir']);


//RUTAS MODULO DE CLIENTES - CLIENTES
Route::get('/clientes/clientes', [App\Http\Controllers\clientes\ClientesController::class, 'index']);
Route::post('/clientes/clientes', [App\Http\Controllers\clientes\ClientesController::class, 'guardar_cliente']);
Route::put('/clientes/clientes', [App\Http\Controllers\clientes\ClientesController::class, 'editar_cliente']);
//RUTAS MODULO DE CLIENTES - PERSONAS
Route::get('/clientes/personas', [App\Http\Controllers\clientes\PersonasController::class, 'index']);
Route::post('/clientes/personas', [App\Http\Controllers\clientes\PersonasController::class, 'guardar_persona']);
Route::put('/clientes/personas', [App\Http\Controllers\clientes\PersonasController::class, 'editar_persona']);


//RUTAS MODULO DE COMPRAS - CATEGORIAS
Route::get('/compras/categorias', [App\Http\Controllers\compras\CategoriasController::class, 'index']);
Route::post('/compras/categorias', [App\Http\Controllers\compras\CategoriasController::class, 'guardar_categoria']);
Route::put('/compras/categorias', [App\Http\Controllers\compras\CategoriasController::class, 'editar_categoria']);
//RUTAS MODULO DE COMPRAS - PROVEEDORES
Route::get('/compras/proveedores', [App\Http\Controllers\compras\ProveedoresController::class, 'index']);
Route::post('/compras/proveedores', [App\Http\Controllers\compras\ProveedoresController::class, 'guardar_proveedor']);
Route::put('/compras/proveedores', [App\Http\Controllers\compras\ProveedoresController::class, 'editar_proveedor']);
//RUTAS MODULO DE COMPRAS - COMPRAS
Route::get('/compras/compras', [App\Http\Controllers\compras\ComprasController::class, 'index']);
Route::post('/compras/compras', [App\Http\Controllers\compras\ComprasController::class, 'guardar_compra']);
Route::put('/compras/compras', [App\Http\Controllers\compras\ComprasController::class, 'editar_compra']);
//RUTAS MODULO DE FACTURACION - DESCUENTOS
Route::get('/facturacion/descuentos', [App\Http\Controllers\facturacion\DescuentosController::class, 'index']);
Route::post('/facturacion/descuentos', [App\Http\Controllers\facturacion\DescuentosController::class, 'guardar_descuento']);
Route::put('/facturacion/descuentos', [App\Http\Controllers\facturacion\DescuentosController::class, 'editar_descuento']);
//RUTAS MODULO DE FACTURACION - FORMAS DE PAGO
Route::get('/facturacion/forma_pago', [App\Http\Controllers\facturacion\FormaPagoController::class, 'index']);
Route::post('/facturacion/forma_pago', [App\Http\Controllers\facturacion\FormaPagoController::class, 'guardar_forma_pago']);
Route::put('/facturacion/forma_pago', [App\Http\Controllers\facturacion\FormaPagoController::class, 'editar_forma_pago']);
//RUTAS MODULO DE FACTURACION - NUMERACIONES SAR
Route::get('/facturacion/numeraciones_sar', [App\Http\Controllers\facturacion\NumeracionesSARController::class, 'index']);
Route::post('/facturacion/numeraciones_sar', [App\Http\Controllers\facturacion\NumeracionesSARController::class, 'guardar_numeracion_sar']);
Route::put('/facturacion/numeraciones_sar', [App\Http\Controllers\facturacion\NumeracionesSARController::class, 'editar_numeracion_sar']);
//RUTAS MODULO DE FACTURACION - FACTURAS
Route::get('/facturacion/facturas', [App\Http\Controllers\facturacion\FacturasController::class, 'index']);
Route::post('/facturacion/facturas', [App\Http\Controllers\facturacion\FacturasController::class, 'guardar_factura']);
//RUTAS MODULO DE FACTURACION - TIPO FACTURAS
Route::get('/facturacion/tipo_factura', [App\Http\Controllers\facturacion\TipoFacturaController::class, 'index']);
Route::post('/facturacion/tipo_factura', [App\Http\Controllers\facturacion\TipoFacturaController::class, 'guardar_tipo_factura']);
Route::put('/facturacion/tipo_factura', [App\Http\Controllers\facturacion\TipoFacturaController::class, 'editar_tipo_factura']);
//RUTAS MODULO DE FACTURACION
Route::get('/facturacion/estado_factura', [App\Http\Controllers\facturacion\EstadoFacturaController::class, 'index']);
Route::get('/facturacion/recibos', [App\Http\Controllers\facturacion\RecibosController::class, 'index']);


//RUTAS MODULO DE INVENTARIOS - PRODUCTOS
Route::get('/inventarios/productos', [App\Http\Controllers\inventarios\ProductosController::class, 'index']);
Route::post('/inventarios/productos', [App\Http\Controllers\inventarios\ProductosController::class, 'guardar_producto']);
Route::put('/inventarios/productos', [App\Http\Controllers\inventarios\ProductosController::class, 'editar_producto']);
//RUTAS MODULO DE INVENTARIOS
Route::get('/inventarios/ajustes', [App\Http\Controllers\inventarios\AjustesController::class, 'index']);
Route::get('/inventarios/inventario', [App\Http\Controllers\inventarios\InventarioController::class, 'index']);
Route::get('/inventarios/tipo_movimiento', [App\Http\Controllers\inventarios\TipoMovimientoController::class, 'index']);


//RUTAS MODULO DE USUARIOS - USUARIOS
Route::get('/usuarios/usuarios', [App\Http\Controllers\usuarios\UsuariosController::class, 'index']);
Route::post('/usuarios/usuarios', [App\Http\Controllers\usuarios\UsuariosController::class, 'guardar_usuario']);
Route::put('/usuarios/usuarios', [App\Http\Controllers\usuarios\UsuariosController::class, 'editar_usuario']);
//RUTAS MODULO DE USUARIOS - CONTRASEÑA
Route::get('/usuarios/contrasena', [App\Http\Controllers\usuarios\ContrasenaController::class, 'index']);
Route::put('/usuarios/contrasena', [App\Http\Controllers\usuarios\ContrasenaController::class, 'cambiar_contrasena']);
//RUTAS MODULO DE USUARIOS
Route::get('/usuarios/permisos', [App\Http\Controllers\usuarios\PermisosController::class, 'index']);

//RUTAS MODULO DE USUARIOS - ROLES
Route::get('/usuarios/roles', [App\Http\Controllers\usuarios\RolesController::class, 'index']);
Route::post('/usuarios/roles', [App\Http\Controllers\usuarios\RolesController::class, 'guardar_roles']);
Route::put('/usuarios/roles', [App\Http\Controllers\usuarios\RolesController::class, 'editar_roles']);

//RUTAS MODULO DE USUARIOS - OBJETOS
Route::get('/usuarios/objetos', [App\Http\Controllers\usuarios\ObjetosController::class, 'index']);
Route::post('/usuarios/objetos', [App\Http\Controllers\usuarios\ObjetosController::class, 'guardar_objetos']);
Route::put('/usuarios/objetos', [App\Http\Controllers\usuarios\ObjetosController::class, 'editar_objetos']);

//RUTAS MODULO DE USUARIOS - BITACORA
Route::get('/usuarios/bitacora', [App\Http\Controllers\usuarios\BitacoraController::class, 'index']);

//RUTAS MODULO DE USUARIOS - RECUPERACION DE CONTRASEÑA
Route::get('/usuarios/recuperacion', [App\Http\Controllers\usuarios\RecuperacionController::class, 'index']);
Route::post('/usuarios/recuperacion', [App\Http\Controllers\usuarios\RecuperacionController::class, 'verificar']);

//RUTAS MODULO DE USUARIOS - RECUPERACION DE CONTRASEÑA POR MEDIO DEL PERFIL
Route::get('/usuarios/contrasenaPerfil', [App\Http\Controllers\usuarios\ContrasenaPerfilController::class, 'index']);
Route::put('/usuarios/contrasenaPerfil', [App\Http\Controllers\usuarios\ContrasenaPerfilController::class, 'cambiar_contrasena']);
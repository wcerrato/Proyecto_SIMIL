@extends('layouts.main')

@section('contenido')

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_descuentos" name="div_encabezado_descuentos">
    <h1 class="h3 mb-0 text-gray-800">
        Módulo de Facturas
    </h1>
</div>

<div class="row">
    @if($message = Session::get('mensaje_guardado'))
    <div class="col-12 alert alert-success alert-dismissable fade show" role='alert'>
        <span>{{ $message }}</span>
    </div>
    @endif    
</div>

<div style=" background-color: #f3b103; width: 90%; margin: 0 auto;">
    <label style="color: white; margin: 1%; ">Generación de Factura</label>
</div>

<div style="margin:2%;"></div>

@if(session('cod_factura') <> NULL)
    <div class="modal fade" style="width:80%; margin: 0 auto;" role="document" id="div_guardar_encabezado" name="div_guardar_encabezado">
@else        
    <div style="width:80%; margin: 0 auto;" role="document" id="div_guardar_encabezado" name="div_guardar_encabezado">
@endif
    <div class="modal-content">
        <form action="/facturacion/facturas" method="post">
            @csrf
            <div class="modal-header">
                Fecha:
                <input type="text" style="width:50%; color: grey; background: transparent; border: none; pointer-events: none;" id="fecha" name="fecha" value="{{ date("Y-m-d") }}">
                Cai:
                <input type="text" style="width:50%; color: grey; background: transparent; border: none; pointer-events: none;" id="cai" name="cai" value="{{ $cai }}">
                Factura:
                <input type="text" style="width:50%; color: grey; background: transparent; border: none; pointer-events: none;" id="factura_no" name="factura_no" value="{{ $factura_no }}">
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Cliente:</td>
                        <td>
                            <div class="form-group">
                                <select style="width:80%;" name="cliente" id="cliente" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                                    @foreach($clientes_array[0] as $clientes)
                                        <option value="{{$clientes['COD_CLIENTE']}}">{{$clientes['NOM_PERSONA']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tipo:</td>
                        <td>
                            <div class="form-group">
                                <select style="width:80%;" name="tipo_factura" id="tipo_factura" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                                    @foreach($tipo_factura_array[0] as $tipo_factura)
                                        <option value="{{$tipo_factura['COD_TIPO_FACTURA']}}">{{$tipo_factura['NOM_TIPO_FACTURA']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Forma de Pago:</td>
                        <td>
                            <div class="form-group">
                                <select style="width:80%;" name="forma_pago" id="forma_pago" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                                    @foreach($forma_pago_array[0] as $forma_pago)
                                        <option value="{{$forma_pago['COD_FORMA_PAGO']}}">{{$forma_pago['NOM_FORMA_PAGO']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Descuento:</td>
                        <td>
                            <div class="form-group">
                                <select style="width:80%;" name="descuento" id="descuento" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                                    @foreach($descuento_array[0] as $descuento)
                                        <option value="{{$descuento['COD_DESCUENTO']}}">{{$descuento['NOM_DESC']}} - {{$descuento['PORCENTAJE_DESCONTAR']}}%</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="guardar_encabezado" name="guardar_encabezado" value="SI">
                                <input type="hidden" id="cod_talonario_cai" name="cod_talonario_cai" value="{{$cod_talonario_cai}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <div class="modal-footer">
                            <button type="submit" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                                <i class="fas fa-check-circle fa-sm text-white-50"></i> Guardar
                            </button>
                        </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<div style="margin:2%;"></div>

@if(session('cod_factura') == NULL)
    <div class="modal fade" style="width:80%; margin: 0 auto;" role="document" id="div_mostrar_encabezado" name="div_mostrar_encabezado">     
@else        
    <div class="" style="width:80%; margin: 0 auto;" role="document" id="div_mostrar_encabezado" name="div_mostrar_encabezado">
@endif
    <div class="modal-content">
        <form action="/facturacion/facturas" method="post">
            @csrf
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Cliente:</td>
                        <td>
                            <div class="form-group">
                                {{session('encabezado_persona')}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tipo:</td>
                        <td>
                            <div class="form-group">
                                {{session('encabezado_tipo_factura')}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Forma Pago:</td>
                        <td>
                            <div class="form-group">
                                {{session('encabezado_forma_pago')}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Descuento:</td>
                        <td>
                            <div class="form-group">
                                {{session('encabezado_descuento')}}
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

@if(session('cod_factura') == NULL)
    <div class="modal fade" style="width:80%; margin: 0 auto;" role="document" id="div_mostrar_lineas" name="div_mostrar_lineas">     
@else        
    <div class="" style="width:80%; margin: 0 auto;" role="document" id="div_mostrar_lineas" name="div_mostrar_lineas">
@endif
    <div class="modal-content">
        <form action="/facturacion/facturas" method="post">
            @csrf
            <div class="modal-body">
                <table>
                     <tr>
                        <td>Sub Total:</td>
                        <td>{{session('subtotal_venta')}}</td>
                    </tr>
                    <tr>
                        <td>Impuesto:</td>
                        <td>{{session('impuesto_venta')}}</td>
                    </tr>
                    <tr>
                        <td>Descuento:</td>
                        <td>{{session('descuento_venta')}}</td>
                    </tr>
                    <tr>
                        <td>Total:</td>
                        <td>{{session('total_venta')}}</td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

@if(session('cod_factura') == NULL)
    <div class="modal fade" style="width:80%; margin: 0 auto;" role="document" id="guardar_lineas" name="guardar_lineas">     
@else        
    <div class="" style="width:80%; margin: 0 auto;" role="document" id="guardar_lineas" name="guardar_lineas">
@endif
    <div class="modal-content">
        <form action="/facturacion/facturas" method="post">
            @csrf
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Productos:</td>
                        <td>
                            <div class="form-group">
                                <select style="width:100%;" name="producto" id="producto" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                                    @foreach($produccion_array[0] as $produccion)
                                        <option value="{{$produccion['COD_PRODUCTO'].'@'.$produccion['PRECIO_UNITARIO']}}">{{$produccion['NOM_PRODUCTO']}} - {{$produccion['PRECIO_UNITARIO']}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="guardar_lineas" name="guardar_lineas" value="SI">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Cantidad:</td>
                        <td>
                            <div class="form-group">
                                <input type="text" name="cantidad" id="cantidad" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="0">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <div class="modal-footer">
                            <button type="submit" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                                <i class="fas fa-check-circle fa-sm text-white-50"></i> Guardar Producto
                            </button>
                        </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>
    
@if(session('cod_factura') == NULL)
    <div class="modal fade" style="width:80%; margin: 0 auto;" role="document" id="imprimir_factura" name="imprimir_factura">
@else        
    <div class="" style="width:80%; margin: 0 auto;" role="document" id="imprimir_factura" name="imprimir_factura">
@endif
    <div class="modal-content">
        <form action="/facturacion/facturas" method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" id="imprimir" name="imprimir" value="SI">
                <table>
                    <tr>
                        <td>
                        <div class="modal-footer">
                            <button type="submit" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                                <i class="fas fa-check-circle fa-sm text-white-50"></i> Terminar E Imprimir
                            </button>
                        </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

@endsection
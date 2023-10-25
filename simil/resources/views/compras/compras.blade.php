@extends('layouts.main')

@section('contenido')

<style>

    .modal {
        display: none;
        padding-top: 150px;
        left: 8%;
    }

    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        width: 80%;
    }

    .close {
        color: white;
        position: absolute;
        font-weight: bold;
    }

    .close:hover, .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
    }

    
</style>

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_compra" name="div_encabezado_compra">
    <h1 class="h3 mb-0 text-gray-800">
        Módulo de Compras
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_compra">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar una nueva compra
    </a>
</div>

<div class="row">
    @if($message = Session::get('mensaje_guardado'))
    <div class="col-12 alert alert-success alert-dismissable fade show" role='alert'>
        <span>{{ $message }}</span>
    </div>
    @endif    
</div>

<div style=" background-color: #f3b103; width: 90%; margin: 0 auto;">
    <label style="color: white; margin: 1%;">Compras realizadas</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_compra" name="div_listado_compra" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th>Fecha</th>
            <th>Total Compra</th>
            <th>Factura</th>
            <th>Proveedor</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>

        @foreach($compras_array[0] as $compra)

            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="fecha_compra{{$compra['COD_ENC_COMPRA']}}"  name="fecha_compra{{$compra['COD_ENC_COMPRA']}}" value="{{$compra['FEC_COMPRA']}}">
                </td>


                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="total_compra{{$compra['COD_ENC_COMPRA']}}" name="total_compra{{$compra['COD_ENC_COMPRA']}}" value="{{$compra['TOT_COMPRA']}}">
                </td>

                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="factura_compra{{$compra['COD_ENC_COMPRA']}}" name="factura_compra{{$compra['COD_ENC_COMPRA']}}" value="{{$compra['FACTURA_NO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="proveedor_compra{{$compra['COD_ENC_COMPRA']}}" name="proveedor_compra{{$compra['COD_ENC_COMPRA']}}" value="{{$compra['NOM_PROVEEDOR']}}">
                    <input type="hidden" id="proveedor_compras_id{{$usuario['COD_USUARIO']}}" nombre="proveedor_compras_id{{$compra['COD_ENC_COMPRA']}}" value="{{$compra['COD_ENC_COMPRA']}}">
                </td>

                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="pago_compra{{$compra['COD_ENC_COMPRA']}}" name="pago_compra{{$compra['COD_ENC_COMPRA']}}" value="{{$compra['COD_FORMA_PAGO']}}">
                </td>

                @if( $compra['ESTADO'] == 'A' )

                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_compra{{$compra['COD_ENC_COMPRA']}}" name="estado_compra{{$compra['COD_ENC_COMPRA']}}" value="SI">
                </td>    
                @else
                
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_compra{{$compra['COD_ENC_COMPRA']}}" name="estado_compra{{$compra['COD_ENC_COMPRA']}}" value="NO">
                </td>  

                @endif


                <td>
                    <button class="btn btn-round btnEditar" data-id="compra{{$compra['COD_ENC_COMPRA']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_compra">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
</div>
    
<!-- Modal Agregar-->
<div class="modal fade" id="guardar_compra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Guardar compra</h5>
            </div>
            <form action="/compras/compras" method="post">
                @csrf
                <div class="modal-body">
                    @if($message = Session::get('ErrorInsert'))
                    <div class="col-12 alert alert-danger alert-dismissable fade show" role='alert'>
                        <h6>Errores:</h6>
                        <ul>
                            @foreach( $errors->all() as $error )
                            <li>
                                {{ $error }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="form-group">
                        <input type="text" name="fecha_compra" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Fecha" aria-describedby="basic-addon2" value="{{ old('fecha_compra') }}">
                    </div>

                    <div class="form-group">
                        <input type="text" name="total_compra" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Total" aria-describedby="basic-addon2" value="{{ old('total_compra') }}">
                    </div>

                    <div class="form-group">
                        <input type="text" name="factura_compra" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Numero de factura" aria-describedby="basic-addon2" value="{{ old('factura_compra') }}">
                    </div>

                    <div class="form-group">
                        <input type="text" name="proveedor_compra" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Proveedor" aria-describedby="basic-addon2" value="{{ old('proveedor_compra') }}">
                    </div>

                    <div class="form-group">
                        <input type="text" name="pago_compra" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Forma de pago" aria-describedby="basic-addon2" value="{{ old('pago_compra') }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                        <i class="fas fa-check-circle fa-sm text-white-50"></i> Guardar
                    </button>
                    <button type="button" style="background-color: #999; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-dismiss="modal">
                        <i class="fas fa-times-circle fa-sm text-white-50"></i> Cerrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar-->
<div class="modal fade" id="editar_compra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Compra</h5>
            </div>
            <form action="/compras/compras" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    @if($message = Session::get('EditInsert'))
                    <div class="col-12 alert alert-danger alert-dismissable fade show" role='alert'>
                        <h6>Errores:</h6>
                        <ul>
                            @foreach( $errors->all() as $error )
                            <li>
                                {{ $error }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        Fecha
                        <input type="text" name="editar_fecha_compra" id="editar_fecha_compra" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_fecha_compra') }}">
                    </div>
                    <div class="form-group">
                        Total
                        <input type="text" name="editar_total_compra" id="editar_total_compra" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_total_compra') }}">
                    </div>
                    <div class="form-group">
                        Factura
                        <input type="text" name="editar_factura_compra" id="editar_factura_compra" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_factura_compra') }}">
                    </div>
                    <div class="form-group">
                        Proveedor
                        <input type="text" name="editar_proveedor_compra" id="editar_proveedor_compra" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_proveedor_compra') }}">
                    </div>
                    <div class="form-group">
                        Proveedor
                        <input type="text" name="editar_pago_compra" id="editar_pago_compra" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_pago_compra') }}">
                    </div>
                    
                    <div class="form-group">
                        Estado
                        <select name="editar_estado_compra" id="editar_estado_compra" style="width: 70%;" class="form-control bg-light border-0 small">
                            <option value="A">SI</option>
                            <option value="I">NO</option>
                        </select>
                    </div>
                </div>                  
                <div class="modal-footer">
                    <button type="submit" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                        <i class="fas fa-check-circle fa-sm text-white-50"></i> Editar
                    </button>
                    <button type="button" style="background-color: #999; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-dismiss="modal">
                        <i class="fas fa-times-circle fa-sm text-white-50"></i> Cerrar
                    </button>
                </div>
                <input type="hidden" id="editar_codigo_compra" name="editar_codigo_compra">
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        
        var cod_enc_compra = 0;
        var fecha_compra = '';
        var total_compra = 0;
        var factura_compra = '';
        var proveedor_compra = 0;
        var pago_compra = '';
        var estado_compra = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_compra").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_compra").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_compra").modal('show');
                cod_enc_compra = $(this).data('id');

                fecha_compra = $('#fecha_compra'+cod_enc_compra).val();
                total_compra = $('#total_compra'+cod_enc_compra).val();
                factura_compra = $('#factura_compra'+cod_enc_compra).val();
                proveedor_compra = $('#proveedor_compra'+cod_enc_compra).val();
                pago_compra = $('#pago_compra'+cod_enc_compra).val();
                estado_compra = $('#estado_compra'+cod_enc_compra).val();
                    
                $('#editar_codigo_compra').val(cod_enc_compra);
                $('#editar_fecha_compra').val(fecha_compra);
                $('#editar_total_compra').val(total_compra);
                $('#editar_proveedor_compra').val(proveedor_compra);
                $('#editar_pago_compra').val(pago_compra);
                
                
                if(estado_compra == 'SI'){
                    
                    document.getElementById("editar_estado_compra").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_compra").selectedIndex = 1;
                    
                }
                
            });
            
        });
        
    </script>
@endsection
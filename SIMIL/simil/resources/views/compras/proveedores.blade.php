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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_proveedores" name="div_encabezado_proveedores">
    <h1 class="h3 mb-0 text-gray-800">
        Modulo De Proveedores
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_proveedor">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Proveedor
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
    <label style="color: white; margin: 1%;">Listado De Proveedores</label>
</div>

<div id="div_listado_proveedores" name="div_listado_proveedores" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:20%;">Nombre</th>
            <th style="width:15%;">RTN</th>
            <th style="width:20%;">Direccion</th>
            <th style="width:10%;">Telefono</th>
            <th style="width:15%;">Correo</th>
            <th style="width:10%;">Activo</th>
            <th style="width:10%;">Acciones</th>
        </tr>
        
        @foreach($proveedores_array[0] as $proveedor)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="descripcion_proveedor{{$proveedor['COD_PROVEEDOR']}}" name="descripcion_proveedor{{$proveedor['COD_PROVEEDOR']}}" value="{{$proveedor['NOM_PROVEEDOR']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="rtn_proveedor{{$proveedor['COD_PROVEEDOR']}}" name="rtn_proveedor{{$proveedor['COD_PROVEEDOR']}}" value="{{$proveedor['DNI_RTN']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="direccion_proveedor{{$proveedor['COD_PROVEEDOR']}}" name="direccion_proveedor{{$proveedor['COD_PROVEEDOR']}}}}" value="{{$proveedor['PRO_DIRECCION']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="telefono_proveedor{{$proveedor['COD_PROVEEDOR']}}" name="telefono_proveedor{{$proveedor['COD_PROVEEDOR']}}" value="{{$proveedor['PRO_TELEFONO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="correo_proveedor{{$proveedor['COD_PROVEEDOR']}}" name="correo_proveedor{{$proveedor['COD_PROVEEDOR']}}" value="{{$proveedor['PRO_CORREO']}}">
                </td>
                
                @if( $proveedor['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_proveedor{{$proveedor['COD_PROVEEDOR']}}" name="estado_proveedor{{$proveedor['COD_PROVEEDOR']}}" value="SI">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_proveedor{{$proveedor['COD_PROVEEDOR']}}" name="estado_proveedor{{$proveedor['COD_PROVEEDOR']}}" value="NO">
                    </td>
                
                @endif
                
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$proveedor['COD_PROVEEDOR']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_proveedor">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach
        
    </table>
    
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Guardar Proveedor</h5>
            </div>
            <form action="/compras/proveedores" method="post">
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
                        <input type="text" name="descripcion_proveedor" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Descripcion" aria-describedby="basic-addon2" value="{{ old('descripcion_proveedor') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="rtn_proveedor" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="RTN" aria-describedby="basic-addon2" value="{{ old('rtn_proveedor') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="direccion_proveedor" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Direccion" aria-describedby="basic-addon2" value="{{ old('direccion_proveedor') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="telefono_proveedor" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Telefono" aria-describedby="basic-addon2" value="{{ old('telefono_proveedor') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="correo_proveedor" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Correo" aria-describedby="basic-addon2" value="{{ old('correo_proveedor') }}">
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
<div class="modal fade" id="editar_proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
            </div>
            <form action="/compras/proveedores" method="post">
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
                        Nombre
                        <input type="text" name="editar_descripcion_proveedor" id="editar_descripcion_proveedor" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_descripcion_proveedor') }}">
                    </div>
                    <div class="form-group">
                        RTN
                        <input type="text" name="editar_rtn_proveedor" id="editar_rtn_proveedor" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_rtn_proveedor') }}">
                    </div>
                    <div class="form-group">
                        Direccion
                        <input type="text" name="editar_direccion_proveedor" id="editar_direccion_proveedor" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_direccion_proveedor') }}">
                    </div>
                    <div class="form-group">
                        Telefono
                        <input type="text" name="editar_telefono_proveedor" id="editar_telefono_proveedor" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_telefono_proveedor') }}">
                    </div>
                    <div class="form-group">
                        Correo
                        <input type="text" name="editar_correo_proveedor" id="editar_correo_proveedor" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_correo_proveedor') }}">
                    </div>
                    <div class="form-group">
                        Estado
                        <select name="editar_estado_proveedor" id="editar_estado_proveedor" style="width: 70%;" class="form-control bg-light border-0 small">
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
                <input type="hidden" id="editar_codigo_proveedor" name="editar_codigo_proveedor">
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        
        var cod_proveedor = 0;
        var descripcion_proveedor = '';
        var rtn_proveedor = 0;
        var direccion_proveedor = '';
        var telefono_proveedor = 0;
        var correo_proveedor = '';
        var estado_proveedor = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_proveedor").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_proveedor").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_descuentos").modal('show');
                cod_proveedor = $(this).data('id');

                descripcion_proveedor = $('#descripcion_proveedor'+cod_proveedor).val();
                rtn_proveedor = $('#rtn_proveedor'+cod_proveedor).val();
                direccion_proveedor = $('#direccion_proveedor'+cod_proveedor).val();
                telefono_proveedor = $('#telefono_proveedor'+cod_proveedor).val();
                correo_proveedor = $('#correo_proveedor'+cod_proveedor).val();
                estado_proveedor = $('#estado_proveedor'+cod_proveedor).val();
                    
                $('#editar_codigo_proveedor').val(cod_proveedor);
                $('#editar_descripcion_proveedor').val(descripcion_proveedor);
                $('#editar_rtn_proveedor').val(rtn_proveedor);
                $('#editar_direccion_proveedor').val(direccion_proveedor);
                $('#editar_telefono_proveedor').val(telefono_proveedor);
                $('#editar_correo_proveedor').val(correo_proveedor);
                
                if(estado_proveedor == 'SI'){
                    
                    document.getElementById("editar_estado_proveedor").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_proveedor").selectedIndex = 1;
                    
                }
                
            });
            
        });
        
    </script>
@endsection
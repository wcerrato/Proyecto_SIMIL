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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_descuentos" name="div_encabezado_descuentos">
    <h1 class="h3 mb-0 text-gray-800">
        Módulo de Descuentos
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_descuentos">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Descuento
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
    <label style="color: white; margin: 1%;">Listado de Descuentos</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_descuentos" name="div_listado_descuentos" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:60%;">Descripción</th>
            <th style="width:10%;">Porcentaje</th>
            <th style="width:10%;">Activo</th>
            <th style="width:10%;">Editar</th>
        </tr>

        @foreach($descuentos_array[0] as $descuentos)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="nom_descuento{{$descuentos['COD_DESCUENTO']}}" name="nom_descuento{{$descuentos['COD_DESCUENTO']}}" value="{{$descuentos['NOM_DESC']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="porcentaje_descuento{{$descuentos['COD_DESCUENTO']}}" name="porcentaje_descuento{{$descuentos['COD_DESCUENTO']}}" value="{{$descuentos['PORCENTAJE_DESCONTAR']}}">
                </td>
                
                @if( $descuentos['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_descuento{{$descuentos['COD_DESCUENTO']}}" name="estado_descuento{{$descuentos['COD_DESCUENTO']}}" value="SI">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_descuento{{$descuentos['COD_DESCUENTO']}}" name="estado_descuento{{$descuentos['COD_DESCUENTO']}}" value="NO">
                    </td>
                
                @endif
                
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$descuentos['COD_DESCUENTO']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_descuentos">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach

    </table>
    
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_descuentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Guardar Descuento</h5>
            </div>
            <form action="/facturacion/descuentos" method="post">
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
                        <input type="text" name="descripcion_descuento" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Descripción" aria-describedby="basic-addon2" value="{{ old('descripcion_descuento') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="porcentaje_descuento" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Porcentaje" aria-describedby="basic-addon2" value="{{ old('porcentaje_descuento') }}">
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
<div class="modal fade" id="editar_descuentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Descuento</h5>
            </div>
            <form action="/facturacion/descuentos" method="post">
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
                        Descripción
                        <input type="text" name="editar_descripcion_descuento" id="editar_descripcion_descuento" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_descripcion_descuento') }}">
                    </div>
                    <div class="form-group">
                        Porcentaje
                        <input type="text" name="editar_porcentaje_descuento" id="editar_porcentaje_descuento" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_porcentaje_descuento') }}">
                    </div>
                    <div class="form-group">
                        Estado
                        <select name="editar_estado_descuento" id="editar_estado_descuento" style="width: 70%;" class="form-control bg-light border-0 small">
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
                <input type="hidden" id="editar_codigo_descuento" name="editar_codigo_descuento">
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        
        var cod_descuento = 0;
        var nom_desc = '';
        var porcentaje_descuento = 0;
        var estado_descuento = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_descuentos").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_descuentos").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_descuentos").modal('show');
                cod_descuento = $(this).data('id');

                nom_desc = $('#nom_descuento'+cod_descuento).val();
                porcentaje_descuento = $('#porcentaje_descuento'+cod_descuento).val();
                estado_descuento = $('#estado_descuento'+cod_descuento).val();
                    
                $('#editar_codigo_descuento').val(cod_descuento);
                $('#editar_descripcion_descuento').val(nom_desc);
                $('#editar_porcentaje_descuento').val(porcentaje_descuento);
                
                if(estado_descuento == 'SI'){
                    
                    document.getElementById("editar_estado_descuento").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_descuento").selectedIndex = 1;
                    
                }
                
            });
            
        });
        
    </script>
@endsection
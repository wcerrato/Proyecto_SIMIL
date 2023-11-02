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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_numeraciones_sar" name="div_encabezado_numeraciones_sar">
    <h1 class="h3 mb-0 text-gray-800">
        Módulo de Numeraciones SAR
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_numeracion_sar">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar
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
    <label style="color: white; margin: 1%;">Listado de Numeraciones SAR</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_numeraciones_sar" name="div_listado_numeraciones_sar" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:7%;">ID</th>
            <th style="width:15%;">RANGO INICIAL</th>
            <th style="width:15%;">RANGO FINAL</th>
            <th style="width:15%;">RANGO ACTUAL</th>
            <th style="width:15%;">FECHA DE VENCIMIENTO</th>
            <th style="width:15%;">NÚMERO CAI</th>
            <th style="width:10%;">ESTADO</th>
            <th style="width:10%;">ACCIONES</th>
        </tr>
        
        @foreach($numeracion_sar_array[0] as $numeracion_sar)
        
            <tr>
                <td>
                <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="cod_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" name="cod_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" value="{{$numeracion_sar['COD_TALONARIO_CAI']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="rango_inicial_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" name="rango_inicial_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" value="{{$numeracion_sar['RANGO_INICIAL']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="rango_final_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" name="rango_final_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" value="{{$numeracion_sar['RANGO_FINAL']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="rango_actual_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" name="rango_actual_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" value="{{$numeracion_sar['RANGO_ACTUAL']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="fec_vencimiento_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" name="fec_vencimiento_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" value="{{date('Y-m-d',strtotime($numeracion_sar['FEC_VENCIMIENTO']))}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="num_cai_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" name="num_cai_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" value="{{$numeracion_sar['NUM_CAI']}}">
                </td>
                
                @if( $numeracion_sar['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" name="estado_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" value="ACTIVO">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" name="estado_numeracion_sar{{$numeracion_sar['COD_TALONARIO_CAI']}}" value="INACTIVO">
                    </td>
                
                @endif
                
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$numeracion_sar['COD_TALONARIO_CAI']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_numeracion_sar">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach
        
    </table>
    
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_numeracion_sar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Guardar Numeración</h5>
            </div>
            <form action="/facturacion/numeraciones_sar" method="post">
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
                        Rango Inicial
                        <input type="text" name="rango_inicial_numeracion_sar" style="width: 70%;" class="form-control custom-input " aria-describedby="basic-addon2" value="{{ old('rango_inicial_numeracion_sar') }}">
                    </div>
                    <div class="form-group">
                        Rango Final
                        <input type="text" name="rango_final_numeracion_sar" style="width: 70%;" class="form-control custom-input " aria-describedby="basic-addon2" value="{{ old('rango_final_numeracion_sar') }}">
                    </div>
                    <div class="form-group">
                        Rango Actual
                        <input type="text" name="rango_actual_numeracion_sar" style="width: 70%;"class="form-control custom-input " aria-describedby="basic-addon2" value="{{ old('rango_actual_numeracion_sar') }}">
                    </div>
                    <div class="form-group">
                        Fecha de Vencimiento
                        <input type="date" name="fec_vencimiento_numeracion_sar" style="width: 70%;" class="form-control custom-input " aria-describedby="basic-addon2" value="{{ old('fec_vencimiento_numeracion_sar') }}">
                    </div>
                    <div class="form-group">
                        Número CAI
                        <input type="text" name="num_cai_numeracion_sar" style="width: 70%;" class="form-control custom-input " aria-describedby="basic-addon2" value="{{ old('num_cai_numeracion_sar') }}">
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
<div class="modal fade" id="editar_numeracion_sar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Numeración</h5>
            </div>
            <form action="/facturacion/numeraciones_sar" method="post">
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
                        ID
                        <input type="text" readonly="readonly" name="editar_codigo_numeracion_sar" id="editar_codigo_numeracion_sar" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_codigo_numeracion_sar') }}">
                    </div>
                    <div class="form-group">
                        Rango Inicial
                        <input type="text" name="editar_rango_inicial_numeracion_sar" id="editar_rango_inicial_numeracion_sar" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_rango_inicial_numeracion_sar') }}">
                    </div>
                    <div class="form-group">
                        Rango Final
                        <input type="text" name="editar_rango_final_numeracion_sar" id="editar_rango_final_numeracion_sar" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_rango_final_numeracion_sar') }}">
                    </div>
                    <div class="form-group">
                        Rango Actual
                        <input type="text" name="editar_rango_actual_numeracion_sar" id="editar_rango_actual_numeracion_sar" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_rango_actual_numeracion_sar') }}">
                    </div>
                    <div class="form-group">
                        Fecha de Vencimiento
                        <input type="date" name="editar_fecha_vencimiento_numeracion_sar" id="editar_fecha_vencimiento_numeracion_sar" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_fecha_vencimiento_numeracion_sar') }}">
                    </div>
                    <div class="form-group">
                        Número CAI
                        <input type="text" name="editar_num_cai_numeracion_sar" id="editar_num_cai_numeracion_sar" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_num_cai_numeracion_sar') }}">
                    </div>
                    <div class="form-group">
                        Estado
                        <select name="editar_estado_numeracion_sar" id="editar_estado_numeracion_sar" style="width: 70%;" class="form-control bg-light border-0 small">
                            <option value="A">ACTIVO</option>
                            <option value="I">INACTIVO</option>
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
                 <!-- <input type="hidden" id="editar_codigo_numeracion_sar" name="editar_codigo_numeracion_sar"> -->
            </form>
        </div>
    </div>
</div>
    
@endsection

@section('scripts')
    <script>
        
        var cod_numeracion_sar = 0;
        var rango_inicial = 0;
        var rango_final = 0;
        var rango_actual = 0;
        var fecha_limite = '';
        var cai = 0;
        var estado_numeracion_sar = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_numeracion_sar").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_numeracion_sar").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_numeracion_sar").modal('show');
                cod_numeracion_sar = $(this).data('id');

                rango_inicial = $('#rango_inicial_numeracion_sar'+cod_numeracion_sar).val();
                rango_final = $('#rango_final_numeracion_sar'+cod_numeracion_sar).val();
                rango_actual = $('#rango_actual_numeracion_sar'+cod_numeracion_sar).val();
                fecha_limite = $('#fec_vencimiento_numeracion_sar'+cod_numeracion_sar).val();
                cai = $('#num_cai_numeracion_sar'+cod_numeracion_sar).val();
                estado_numeracion_sar = $('#estado_numeracion_sar'+cod_numeracion_sar).val();
                    
                $('#editar_codigo_numeracion_sar').val(cod_numeracion_sar);
                $('#editar_rango_inicial_numeracion_sar').val(rango_inicial);
                $('#editar_rango_final_numeracion_sar').val(rango_final);
                $('#editar_rango_actual_numeracion_sar').val(rango_actual);
                $('#editar_fecha_vencimiento_numeracion_sar').val(fecha_limite);
                $('#editar_num_cai_numeracion_sar').val(cai);
                
                if(estado_numeracion_sar == 'ACTIVO'){
                    
                    document.getElementById("editar_estado_numeracion_sar").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_numeracion_sar").selectedIndex = 1;
                    
                }
                
            });
            
        });

         
    </script>
@endsection
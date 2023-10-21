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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_bitacora" name="div_encabezado_bitacora">
    <h1 class="h3 mb-0 text-gray-800">
        Bitácora
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#imprimir">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Imprimir
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
    <label style="color: white; margin: 1%;">Datos Generados </label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_bitacora" name="div_ldiv_listado_bitacoraistado_roles" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:15%;">OBJETO</th>
            <th style="width:20%;">FECHA</th>
            <th style="width:20%;">USUARIO</th>
            <th style="width:10%;">ACCIÓN</th>
            <th style="width:auto%;">DESCRIPCIÓN</th>
        </tr>
        
        @foreach($Bitacora_array[0] as $bitacora)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="objeto{{$bitacora['COD_BITACORA']}}" name="bitacora{{$bitacora['COD_BITACORA']}}" value="{{$bitacora['NOM_OBJETO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="fecha{{$bitacora['COD_BITACORA']}}" name="fecha{{$bitacora['COD_BITACORA']}}" value="{{$bitacora['FECHA']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="usuario{{$bitacora['COD_BITACORA']}}" name="usuario{{$bitacora['COD_BITACORA']}}" value="{{$bitacora['COD_USUARIO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="accion{{$bitacora['COD_BITACORA']}}" name="accion{{$bitacora['COD_BITACORA']}}" value="{{$bitacora['ACCION']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="descripcion{{$bitacora['COD_BITACORA']}}" name="descripcion{{$bitacora['COD_BITACORA']}}" value="{{$bitacora['DESCRIPCION']}}">
                </td>
                
            </tr>
        
        @endforeach
    </table>
    
</div>



@endsection


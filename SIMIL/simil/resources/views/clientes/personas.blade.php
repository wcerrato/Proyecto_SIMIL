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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_descuentos" name="div_encabezado_persona">
    <h1 class="h3 mb-0 text-gray-800">
        Modulo De Personas
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_persona">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Persona
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
    <label style="color: white; margin: 1%;">Listado De Personas</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_personas" name="div_listado_personas" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:15%;">Nombre</th>
            <th style="width:15%;">Identidad</th>
            <th style="width:5%;">Genero</th>
            <th style="width:5%;">Edad</th>
            <th style="width:5%;">Tipo</th>
            <th style="width:10%;">Telefono</th>
            <th style="width:20%;">Correo</th>
            <th style="width:20%;">Direccion</th>
            <th style="width:5%;">Editar</th>
        </tr>

        @foreach($personas_array[0] as $personas)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="nombre_persona{{$personas['COD_PERSONA']}}" name="nombre_persona{{$personas['COD_PERSONA']}}" value="{{$personas['NOM_PERSONA']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="identidad_persona{{$personas['COD_PERSONA']}}" name="identidad_persona{{$personas['COD_PERSONA']}}" value="{{$personas['IDENTIDAD']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="sexo_persona{{$personas['COD_PERSONA']}}" name="sexo_persona{{$personas['COD_PERSONA']}}" value="{{$personas['SEX_PERSONA']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="edad_persona{{$personas['COD_PERSONA']}}" name="edad_persona{{$personas['COD_PERSONA']}}" value="{{$personas['EDA_PERSONA']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="tipo_persona{{$personas['COD_PERSONA']}}" name="tipo_persona{{$personas['COD_PERSONA']}}" value="{{$personas['TIP_PERSONA']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="telefono_persona{{$personas['COD_PERSONA']}}" name="telefono_persona{{$personas['COD_PERSONA']}}" value="{{$personas['NUM_TELEFONO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="correo_persona{{$personas['COD_PERSONA']}}" name="correo_persona{{$personas['COD_PERSONA']}}" value="{{$personas['CORREO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="direccion_persona{{$personas['COD_PERSONA']}}" name="direccion_persona{{$personas['COD_PERSONA']}}" value="{{$personas['DIRECCION']}}">
                </td>
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$personas['COD_PERSONA']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_persona">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach

    </table>
    
</div>

@endsection
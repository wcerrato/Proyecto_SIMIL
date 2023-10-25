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
        Módulo de Personas
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
    <label style="color: white; margin: 1%;">Listado de Personas</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_personas" name="div_listado_personas" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:15%;">NOMBRE</th>
            <th style="width:15%;">IDENTIDAD</th>
            <th style="width:5%;">GÉNERO</th>
            <th style="width:5%;">EDAD</th>
            <th style="width:5%;">TIPO</th>
            <th style="width:10%;">TELÉFONO</th>
            <th style="width:20%;">CORREO</th>
            <th style="width:20%;">DIRECCIÓN</th>
            <th style="width:5%;">ACIIONES</th>
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

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_persona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Guardar Persona</h5>
            </div>
            <form action="/clientes/personas" method="post">
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
                        <input type="text" name="nombre_persona" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Nombre" aria-describedby="basic-addon2" value="{{ old('nombre_persona') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="identidad_persona" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Identidad" aria-describedby="basic-addon2" value="{{ old('identidad_persona') }}">
                    </div>
                    <div class="form-group">
                        Sexo
                        <select name="sexo_persona" id="sexo_persona" style="width: 70%;" class="form-control bg-light border-0 small">
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="edad_persona" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Edad" aria-describedby="basic-addon2" value="{{ old('edad_persona') }}">
                    </div>
                    <div class="form-group">
                        Tipo_Persona
                        <select name="tipo_persona" id="tipo_persona" style="width: 70%;" class="form-control bg-light border-0 small">
                            <option value="E">Empleado</option>
                            <option value="C">Cliente</option>
                            <option value="P">Proveedor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telefono_persona" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Telefono" aria-describedby="basic-addon2" value="{{ old('telefono_persona') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="correo_persona" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Correo" aria-describedby="basic-addon2" value="{{ old('correo_persona') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="direccion_persona" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Direccion" aria-describedby="basic-addon2" value="{{ old('direccion_persona') }}">
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
<div class="modal fade" id="editar_persona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Persona</h5>
            </div>
            <form action="/clientes/personas" method="post">
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
                        <input type="text" readonly="readonly" name="editar_nombre_persona" id="editar_nombre_persona" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_nombre_persona') }}">
                    </div>
                    <div class="form-group">
                        Identidad
                        <input type="text" name="editar_identidad_persona" id="editar_identidad_persona" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_identidad_persona') }}">
                    </div>
                    <div class="form-group">
                        Sexo
                        <select name="editar_sexo_persona" id="editar_sexo_persona" style="width: 70%;" class="form-control bg-light border-0 small">
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Edad
                        <input type="text" name="editar_edad_persona" id="editar_edad_persona" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_edad_persona') }}">
                    </div>
                    <div class="form-group">
                        Tipo_Persona
                        <select name="editar_tipo_persona" id="editar_tipo_persona" style="width: 70%;" class="form-control bg-light border-0 small">
                            <option value="E">Empleado</option>
                            <option value="C">Cliente</option>
                            <option value="P">Proveedor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Teléfono
                        <input type="text" name="editar_telefono_persona" id="editar_telefono_persona" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_telefono_persona') }}">
                    </div>
                    <div class="form-group">
                        Correo
                        <input type="text" name="editar_correo_persona" id="editar_correo_persona" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_correo_persona') }}">
                    </div>
                    <div class="form-group">
                        Dirección
                        <input type="text" name="editar_direccion_persona" id="editar_direccion_persona" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_direccion_persona') }}">
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
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        
        var nombre_persona = '';
        var identidad_persona = '';
        var sexo_persona = '';
        var edad_persona = '';
        var tipo_persona = '';
        var telefono_persona = ''; 
        var correo_persona = '';
        var direccion_persona = '';
        
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_persona").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_persona").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_persona").modal('show');
                cod_persona = $(this).data('id');

                nombre_persona = $('#nombre_persona'+cod_persona).val();
                identidad_persona = $('#identidad_persona'+cod_persona).val();
                sexo_persona = $('#sexo_persona'+cod_persona).val();
                edad_persona = $('#edad_persona'+cod_persona).val();
                tipo_persona = $('#tipo_persona'+cod_persona).val();
                telefono_persona = $('#telefono_persona'+cod_persona).val();
                correo_persona = $('#correo_persona'+cod_persona).val();
                direccion_persona = $('#direccion_persona'+cod_persona).val();
               
                    
                $('#editar_nombre_persona').val(nombre_persona);
                $('#editar_identidad_persona').val(identidad_persona);
                $('#editar_sexo_persona').val(sexo_persona);
                $('#editar_edad_persona').val(edad_persona);
                $('#editar_tipo_persona').val(tipo_persona);
                $('#editar_telefono_persona').val(telefono_persona);
                $('#editar_correo_persona').val(correo_persona);
                $('#editar_direccion_persona').val(direccion_persona);
                
               
            });
            
        });

        function mayus(e) {
        e.value = e.value.toUpperCase();
    }
        
    </script>
@endsection
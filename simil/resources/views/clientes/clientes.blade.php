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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_clientes" name="div_encabezado_clientes">
    <h1 class="h3 mb-0 text-gray-800">
        Módulo de Clientes
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_cliente">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Cliente
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
    <label style="color: white; margin: 1%;">Listado de Clientes</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_clientes" name="div_listado_clientes" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:20%;">NOMBRE DE LA EMPRESA</th>
            <th style="width:10%;">RTN</th>
            <th style="width:20%;">NOMBRE DE LA PERSONA</th>
            <th style="width:10%;">TELÉFONO</th>
            <th style="width:10%;">CORREO</th>
            <th style="width:10%;">REGIÓN</th>
            <th style="width:10%;">DIRECCIÓN</th>
            <th style="width:10%;">ACCIONES</th>
        </tr>

        @foreach($clientes_array[0] as $clientes)
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="nombre_cliente{{$clientes['COD_CLIENTE']}}" name="nombre_cliente{{$clientes['COD_CLIENTE']}}" value="{{$clientes['NOM_EMPRESA']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="rtn_cliente{{$clientes['COD_CLIENTE']}}" name="rtn_cliente{{$clientes['COD_CLIENTE']}}" value="{{$clientes['RTN']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="persona_clientes{{$clientes['COD_CLIENTE']}}" name="persona_clientes{{$clientes['COD_CLIENTE']}}" value="{{$clientes['NOM_PERSONA']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="telefono_cliente{{$clientes['COD_CLIENTE']}}" name="telefono_cliente{{$clientes['COD_CLIENTE']}}" value="{{$clientes['NUM_TELEFONO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="correo_cliente{{$clientes['COD_CLIENTE']}}" name="correo_cliente{{$clientes['COD_CLIENTE']}}" value="{{$clientes['CORREO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="region_cliente{{$clientes['COD_CLIENTE']}}" name="region_cliente{{$clientes['COD_CLIENTE']}}" value="{{$clientes['REGION']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="direccion_cliente{{$clientes['COD_CLIENTE']}}" name="direccion_cliente{{$clientes['COD_CLIENTE']}}" value="{{$clientes['DIRECCION']}}">
                </td>
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$clientes['COD_CLIENTE']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_cliente">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach
    </table>
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Guardar Cliente</h5>
            </div>
            <form action="/clientes/clientes" method="post">
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
                        <input type="text" name="nombre_empresa" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Nombre Empresa" aria-describedby="basic-addon2" value="{{ old('nombre_empresa') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="rtn_cliente" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="RTN" aria-describedby="basic-addon2" value="{{ old('rtn_cliente') }}">
                    </div>
                    <div class="form-group">
                        <select name="persona_clientes" id="persona_clientes" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                            @foreach($personas_array[0] as $personas)
                                <option value="{{$personas['COD_PERSONA']}}">{{$personas['NOM_PERSONA']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="region_cliente" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Región Cliente" aria-describedby="basic-addon2" value="{{ old('region_cliente') }}">
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
<div class="modal fade" id="editar_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
            </div>
            <form action="/clientes/clientes" method="post">
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
                        Nombre Empresa
                        <input type="text" name="editar_nombre_cliente" id="editar_nombre_cliente" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_nombre_cliente') }}">
                    </div>
                    <div class="form-group">
                        RTN
                        <input type="text" name="editar_rtn_cliente" id="editar_rtn_cliente"  style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_rtn_cliente') }}">
                    </div>
                    <div class="form-group">
                        Nombre Persona
                        <select name="editar_persona_clientes" id="editar_persona_clientes"  style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                            @foreach($personas_array[0] as $personas)
                                <option value="{{$personas['COD_PERSONA']}}">{{$personas['NOM_PERSONA']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        Teléfono
                        <input type="text" name="editar_telefono_cliente" id="editar_telefono_cliente" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_telefono_cliente') }}">
                    </div>
                    <div class="form-group">
                        Correo
                        <input type="text" name="editar_correo_cliente" id="editar_correo_cliente" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_correo_cliente') }}">
                    </div>
                    <div class="form-group">
                        Región
                        <input type="text" name="editar_region_cliente" id="editar_region_cliente" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_region_cliente') }}">
                    </div>
                    <div class="form-group">
                        Dirección
                        <input type="text" name="editar_direccion_cliente" id="editar_direccion_cliente" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_direccion_cliente') }}">
                    </div>
                </div>
                <div>
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
        
        var nombre_cliente = '';
        var rtn_cliente = '';
        var persona_clientes = 0;
        var telefono_cliente = '';
        var correo_cliente = '';
        var region_cliente = '';
        var direccion_cliente = '';

        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_cliente").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_cliente").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_cliente").modal('show');
                cod_cliente = $(this).data('id');
                
                nombre_cliente = $('#nombre_cliente'+cod_cliente).val();
                rtn_cliente = $('#rtn_cliente'+cod_cliente).val();
                persona_clientes = $('#persona_clientes_id'+cod_cliente).val();
                telefono_cliente = $('#telefono_cliente'+cod_cliente).val();
                correo_cliente = $('#correo_cliente'+cod_cliente).val();
                region_cliente = $('#region_cliente'+cod_cliente).val();
                direccion_cliente = $('#direccion_cliente'+cod_cliente).val();

                $('#editar_cod_cliente').val(cod_cliente);
                $('#editar_nombre_cliente').val(nombre_cliente);
                $('#editar_rtn_cliente').val(rtn_cliente);
                document.getElementById("editar_persona_clientes").selectedIndex = (persona_clientes-1);
                $('#editar_telefono_cliente').val(telefono_cliente);
                $('#editar_correo_cliente').val(correo_cliente);
                $('#editar_region_cliente').val(region_cliente);
                $('#editar_direccion_cliente').val(direccion_cliente);

                
            });
            
        });

        function mayus(e) {
        e.value = e.value.toUpperCase();
    }
        
    </script>
@endsection
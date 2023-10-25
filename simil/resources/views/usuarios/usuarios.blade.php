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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_usuarios" name="div_encabezado_usuarios">
    <h1 class="h3 mb-0 text-gray-800">
        Módulo de Usuarios
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_usuario">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Usuario
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
    <label style="color: white; margin: 1%;">Listado de Usuarios</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_usuarios" name="div_listado_usuarios" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:15%;">USUARIO</th>
            <th style="width:50%;">NOMBRE</th>
            <th style="width:50%;">ROL</th>
            <th style="width:30%;">FECHA DE ÚLTIMA CONEXIÓN</th>
            <th style="width:20%;">ACTIVO</th>
            <th style="width:15%;">ACCIONES</th>
        </tr>
        
        @foreach($usuarios_array[0] as $usuario)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="codigo_usuario{{$usuario['COD_USUARIO']}}" name="codigo_usuario{{$usuario['COD_USUARIO']}}" value="{{$usuario['COD_USUARIO']}}">
                    <input type="hidden" id="contrasena_usuario{{$usuario['COD_USUARIO']}}" nombre="contrasena_usuario{{$usuario['COD_USUARIO']}}" value="{{$usuario['CONTRASEÑA']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="persona_usuario{{$usuario['COD_USUARIO']}}" name="persona_usuario{{$usuario['COD_USUARIO']}}" value="{{$usuario['NOM_PERSONA']}}">
                    <input type="hidden" id="persona_usuario_id{{$usuario['COD_USUARIO']}}" nombre="persona_usuario_id{{$usuario['COD_USUARIO']}}" value="{{$usuario['COD_PERSONA']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="rol_usuario{{$usuario['COD_USUARIO']}}" name="rol_usuario{{$usuario['COD_USUARIO']}}" value="{{$usuario['NOM_ROL']}}">
                    <input type="hidden" id="rol_usuario_id{{$usuario['COD_USUARIO']}}" nombre="rol_usuario_id{{$usuario['COD_USUARIO']}}" value="{{$usuario['COD_ROL']}}">                
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="fecha_ultima_conexion_usuario{{$usuario['COD_USUARIO']}}" name="fecha_ultima_conexion_usuario{{$usuario['COD_USUARIO']}}" value="{{date('Y-m-d',strtotime($usuario['FEC_ULTIMA_CONECCION']))}}">
                </td>
                
                @if( $usuario['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_usuario{{$usuario['COD_USUARIO']}}" name="estado_usuario{{$usuario['COD_USUARIO']}}" value="SI">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_usuario{{$usuario['COD_USUARIO']}}" name="estado_usuario{{$usuario['COD_USUARIO']}}" value="NO">
                    </td>
                
                @endif
                
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$usuario['COD_USUARIO']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_usuario">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach
        
    </table>
    
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Guardar Usuario</h5>
            </div>
            <form action="/usuarios/usuarios" method="post">
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
                        <input type="text" name="cod_usuario" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Usuario" aria-describedby="basic-addon2" value="{{ old('cod_usuario') }}">
                    </div>
                    <div class="form-group">
                        <input type="password" name="contrasena"  style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Contraseña" aria-describedby="basic-addon2" value="{{ old('contrasena') }}">
                    </div>

                    <div class="form-group">
                        <input type="password" name="confirmar_contrasena" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Contraseña" aria-describedby="basic-addon2" value="{{ old('contrasena') }}">
                    </div>

                    <div class="form-group">
                        <select name="persona_usuario" id="persona_usuario" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                            @foreach($personas_array[0] as $personas)
                                <option value="{{$personas['COD_PERSONA']}}">{{$personas['NOM_PERSONA']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="rol_usuario" id="rol_usuario" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                            @foreach($roles_array[0] as $roles)
                                <option value="{{$roles['COD_ROL']}}">{{$roles['NOM_ROL']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="pregunta_usuario"  id="pregunta_usuario" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                        @foreach($preguntas_array[0] as $preguntas)
                        <option value="{{$preguntas['COD_PREGUNTA']}}">{{$preguntas['PREGUNTA']}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" name="respuesta" onkeyup="mayus(this);"  style="width: 70%;" class="form-control custom-input " placeholder="Ingresar respuesta" aria-describedby="basic-addon2">
                    </div>

                    <div class="form-group">
                        <select name="pregunta_usuario"  id="pregunta_usuario" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                        @foreach($preguntas_array[0] as $preguntas)
                        <option value="{{$preguntas['COD_PREGUNTA']}}">{{$preguntas['PREGUNTA']}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" name="respuesta" onkeyup="mayus(this);" style="width: 70%;" class="form-control custom-input " placeholder="Ingresar respuesta" aria-describedby="basic-addon2">
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
<div class="modal fade" id="editar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
            </div>
            <form action="/usuarios/usuarios" method="post">
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
                        Usuario
                        <input type="text" readonly="readonly" name="editar_cod_usuario" id="editar_cod_usuario" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_cod_usuario') }}">
                    </div>
                    <div class="form-group">
                        Contraseña
                        <input type="password" name="editar_contrasena_usuario" id="editar_contrasena_usuario" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_contrasena_usuario') }}">
                    </div>
                    <div class="form-group">
                        Persona
                        <select name="editar_persona_usuario" id="editar_persona_usuario" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                            @foreach($personas_array[0] as $personas)
                                <option value="{{$personas['COD_PERSONA']}}">{{$personas['NOM_PERSONA']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        Rol
                        <select name="editar_rol_usuario" id="editar_rol_usuario" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                            @foreach($roles_array[0] as $roles)
                                <option value="{{$roles['COD_ROL']}}">{{$roles['NOM_ROL']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        Estado
                        <select name="editar_estado_usuario" id="editar_estado_usuario" style="width: 70%;" class="form-control bg-light border-0 small">
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
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        
        var cod_usuario = '';
        var contrasena = '';
        var persona_usuario = 0;
        var rol_usuario = 0;
        var estado_usuario = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_usuario").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_usuario").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_usuario").modal('show');
                cod_usuario = $(this).data('id');
                
                contrasena = $('#contrasena_usuario'+cod_usuario).val();
                persona_usuario = $('#persona_usuario_id'+cod_usuario).val();
                rol_usuario = $('#rol_usuario_id'+cod_usuario).val();
                estado_usuario = $('#estado_usuario'+cod_usuario).val();
                

                $('#editar_cod_usuario').val(cod_usuario);
                $('#editar_contrasena_usuario').val(contrasena);
                document.getElementById("editar_persona_usuario").selectedIndex = (persona_usuario-1);
                document.getElementById("editar_rol_usuario").selectedIndex = (rol_usuario-1);

                if(estado_usuario == 'SI'){
                    
                    document.getElementById("editar_estado_usuario").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_usuario").selectedIndex = 1;
                    
                }
                
            });
            
        });

        
        function mayus(e) {
        e.value = e.value.toUpperCase();
        }

        
    </script>
@endsection
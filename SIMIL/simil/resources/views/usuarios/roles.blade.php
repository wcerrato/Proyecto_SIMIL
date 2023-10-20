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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_roles" name="div_encabezado_roles">
    <h1 class="h3 mb-0 text-gray-800">
        Modulo De Roles
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_roles">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Roles
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
    <label style="color: white; margin: 1%;">Listado De Roles</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_roles" name="div_listado_roles" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:20%;">Rol</th>
            <th style="width:30%;">Descripcion</th>
            <th style="width:10%;">Estado</th>
            <th style="width:10%;">Editar</th>
        </tr>
        
        @foreach($Roles_array[0] as $roles)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="nombre_rol{{$roles['COD_ROL']}}" name="nombre_rol{{$roles['COD_ROL']}}" value="{{$roles['NOM_ROL']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="descripcion_rol{{$roles['COD_ROL']}}" name="descripcion_rol{{$roles['COD_ROL']}}" value="{{$roles['DES_ROL']}}">
                </td>

                
                @if( $roles['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_rol{{$roles['COD_ROL']}}" name="estado_rol{{$roles['COD_ROL']}}"value="SI">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_rol{{$roles['COD_ROL']}}" name="estado_rol{{$roles['COD_ROL']}}" value="NO">
                    </td>
                
                @endif
                
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$roles['COD_ROL']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_roles">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach

    </table>
    
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Guardar Rol</h5>
            </div>
            <form action="/usuarios/roles" method="post">
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
                        <input type="text" name="nombre_rol" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Nombre" aria-describedby="basic-addon2" value="{{ old('nombre_rol') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="descripcion_rol" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Descripcion" aria-describedby="basic-addon2" value="{{ old('descripcion_rol') }}">
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
<div class="modal fade" id="editar_roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
            </div>
            <form action="/usuarios/roles" method="post">
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
                        <input type="text" name="editar_nombre_rol" id="editar_nombre_rol" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_nombre_rol') }}">
                    </div>
                    <div class="form-group">
                        Descripcion
                        <input type="text" name="editar_descripcion_rol" id="editar_descripcion_rol" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_descripcion_rol') }}">
                    </div>

                    <div class="form-group">
                        Estado
                        <select name="editar_estado_rol" id="editar_estado_rol" style="width: 70%;" class="form-control bg-light border-0 small">
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
                <input type="hidden" id="editar_codigo_rol" name="editar_codigo_rol">
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        
        var cod_rol = 0;
        var nombre_rol = '';
        var descripcion_rol = '';
        var estado_rol = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_roles").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_roles").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_roles").modal('show');
                cod_rol = $(this).data('id');

                nombre_rol = $('#nombre_rol'+cod_rol).val();
                descripcion_rol = $('#descripcion_rol'+cod_rol).val();
                estado_rol= $('#estado_rol'+cod_rol).val();
                
                $('#editar_codigo_rol').val(cod_rol);
                $('#editar_nombre_rol').val(nombre_rol);
                $('#editar_descripcion_rol').val(descripcion_rol);
                
                if(estado_rol == 'SI'){
                    
                    document.getElementById("editar_estado_rol").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_rol").selectedIndex = 1;
                    
                }
                
            });
            
        });
        
    </script>
@endsection 
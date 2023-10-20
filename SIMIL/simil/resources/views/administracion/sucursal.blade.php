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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_sucursal" name="div_encabezado_sucursal">
    <h1 class="h3 mb-0 text-gray-800">
        Modulo De Sucursales
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_sucursal">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Sucursal
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
    <label style="color: white; margin: 1%;">Listado De Sucursales</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_sucursal" name="div_listado_sucursal" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:70%;">Nombre</th>
            <th style="width:15%;">Estado</th>
            <th style="width:15%;">Editar</th>
        </tr>

        @foreach($sucursal_array[0] as $sucursal)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="nombre_sucursal{{$sucursal['COD_SUCURSAL']}}" name="nombre_sucursal{{$sucursal['COD_SUCURSAL']}}" value="{{$sucursal['NOM_SUCURSAL']}}">
                </td>
                
                @if( $sucursal['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_sucursal{{$sucursal['COD_SUCURSAL']}}" name="estado_sucursal{{$sucursal['COD_SUCURSAL']}}" value="SI">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_sucursal{{$sucursal['COD_SUCURSAL']}}" name="estado_sucursal{{$sucursal['COD_SUCURSAL']}}" value="NO">
                    </td>
                
                @endif
                
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$sucursal['COD_SUCURSAL']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_sucursal">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach

    </table>
    
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_sucursal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Guardar Sucursal</h5>
            </div>
            <form action="/administracion/sucursal" method="post">
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
                        <input type="text" name="nombre_sucursal" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Nombre" aria-describedby="basic-addon2" value="{{ old('nombre_sucursal') }}">
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
<div class="modal fade" id="editar_sucursal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Sucursal</h5>
            </div>
            <form action="/administracion/sucursal" method="post">
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
                        <input type="text" name="editar_nombre_sucursal" id="editar_nombre_sucursal" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_nombre_sucursal') }}">
                    </div>
                    <div class="form-group">
                        Estado
                        <select name="editar_estado_sucursal" id="editar_estado_sucursal" style="width: 70%;" class="form-control bg-light border-0 small">
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
                <input type="hidden" id="editar_codigo_sucursal" name="editar_codigo_sucursal">
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        
        var cod_sucursal = 0;
        var nombre_sucursal = '';
        var estado_sucursal = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_sucursal").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_sucursal").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_sucursal").modal('show');
                cod_sucursal = $(this).data('id');

                nombre_sucursal = $('#nombre_sucursal'+cod_sucursal).val();
                estado_sucursal = $('#estado_sucursal'+cod_sucursal).val();
                    
                $('#editar_codigo_sucursal').val(cod_sucursal);
                $('#editar_nombre_sucursal').val(nombre_sucursal);
                
                if(estado_sucursal == 'SI'){
                    
                    document.getElementById("editar_estado_sucursal").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_sucursal").selectedIndex = 1;
                    
                }
                
            });
            
        });
        
    </script>
@endsection
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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_objetos" name="div_encabezado_objetos">
    <h1 class="h3 mb-0 text-gray-800">
        Módulo de Objetos
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_objetos">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Objetos
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
    <label style="color: white; margin: 1%;">Listado de Objetos</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_objetos" name="div_listado_objetos" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:20%;">OBJETO</th>
            <th style="width:auto%;">DESCRIPCIÓN</th>
            <th style="width:10%;">TIPO DE OBJETO</th>
            <th style="width:10%;">ESTADO</th>
            <th style="width:10%;">ACCIONES</th>
        </tr>
        
        @foreach($Objetos_array[0] as $objetos)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="nombre_objeto{{$objetos['COD_OBJETO']}}" name="nombre_objeto{{$objetos['COD_OBJETO']}}" value="{{$objetos['OBJETO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="descripcion_objeto{{$objetos['COD_OBJETO']}}" name="descripcion_objeto{{$objetos['COD_OBJETO']}}" value="{{$objetos['DES_OBJETO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="tipo_objeto{{$objetos['COD_OBJETO']}}" name="tipo_objeto{{$objetos['COD_OBJETO']}}" value="{{$objetos['TIP_OBJETO']}}">
                </td>

                
                @if( $objetos['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_objeto{{$objetos['COD_OBJETO']}}" name="estado_objeto{{$objetos['COD_OBJETO']}}"value="SI">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_objeto{{$objetos['COD_OBJETO']}}" name="estado_objeto{{$objetos['COD_OBJETO']}}" value="NO">
                    </td>
                
                @endif
                
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$objetos['COD_OBJETO']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_objetos">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach

    </table>
    
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_objetos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Guardar Objeto</h5>
            </div>
            <form action="/usuarios/objetos" method="post">
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
                        <input type="text" name="nombre_objeto" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Nombre" aria-describedby="basic-addon2" value="{{ old('nombre_objeto') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="descripcion_objeto" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Descripcion" aria-describedby="basic-addon2" value="{{ old('descripcion_objeto') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tipo_objeto" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Tipo" aria-describedby="basic-addon2" value="{{ old('tipo_objeto') }}">
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
<div class="modal fade" id="editar_objetos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Objeto</h5>
            </div>
            <form action="/usuarios/objetos" method="post">
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
                        <input type="text" name="editar_nombre_objeto" id="editar_nombre_objeto" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_nombre_objeto') }}">
                    </div>
                    <div class="form-group">
                        Descripción
                        <input type="text" name="editar_descripcion_objeto" id="editar_descripcion_objeto" onkeyup="mayus(this);"  style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_descripcion_objeto') }}">
                    </div>
                    <div class="form-group">
                        Tipo
                        <input type="text" name="editar_tipo_objeto" id="editar_tipo_objeto" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_tipo_objeto') }}">
                    </div>

                    <div class="form-group">
                        Estado
                        <select name="editar_estado_objeto" id="editar_estado_objeto" style="width: 70%;" class="form-control bg-light border-0 small">
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
                <input type="hidden" id="editar_codigo_objeto" name="editar_codigo_objeto">
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        
        var cod_objeto = 0;
        var nombre_objeto = '';
        var descripcion_objeto = '';
        var tipo_objeto = '';
        var estado_objeto = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_objetos").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_objetos").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_objetos").modal('show');
                cod_objeto = $(this).data('id');

                nombre_objeto = $('#nombre_objeto'+cod_objeto).val();
                descripcion_objeto = $('#descripcion_objeto'+cod_objeto).val();
                tipo_objeto = $('#tipo_objeto'+cod_objeto).val();
                estado_objeto= $('#estado_objeto'+cod_objeto).val();
                
                $('#editar_codigo_objeto').val(cod_objeto);
                $('#editar_nombre_objeto').val(nombre_objeto);
                $('#editar_descripcion_objeto').val(descripcion_objeto);
                $('#editar_tipo_objeto').val(tipo_objeto);
                
                if(estado_objeto == 'SI'){
                    
                    document.getElementById("editar_estado_objeto").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_objeto").selectedIndex = 1;
                    
                }
                
            });
            
        });

        function mayus(e) {
        e.value = e.value.toUpperCase();
    }



        
    </script>
@endsection 
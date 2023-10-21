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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_categorias" name="div_encabezado_categorias">
    <h1 class="h3 mb-0 text-gray-800">
        Módulo de Categorías
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_categoria">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Categoría
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
    <label style="color: white; margin: 1%;">Listado de Categorías</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_categorias" name="div_listado_categorias" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:60%">NOMBRE DE CATEGORÍA </th>
            <th style="width:10%">ACTIVO</th>
            <th style="width:10%">ACCIONES</th>
        </tr>
        
        @foreach($categorias_array[0] as $categoria)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="descripcion_categoria{{$categoria['COD_CATEGORIA']}}" name="descripcion_categoria{{$categoria['COD_CATEGORIA']}}" value="{{$categoria['NOM_CATEGORIA']}}">
                </td>
                
                @if( $categoria['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_categoria{{$categoria['COD_CATEGORIA']}}" name="estado_categoria{{$categoria['COD_CATEGORIA']}}" value="SI">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_categoria{{$categoria['COD_CATEGORIA']}}" name="estado_categoria{{$categoria['COD_CATEGORIA']}}" value="NO">
                    </td>
                
                @endif
                
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$categoria['COD_CATEGORIA']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_categoria">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach

        
    </table>
    
</div>
    
<!-- Modal Agregar-->
<div class="modal fade" id="guardar_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Guardar Categoría</h5>
            </div>
            <form action="/compras/categorias" method="post">
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
                        <input type="text" name="descripcion_categoria" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Nombre Categoría" aria-describedby="basic-addon2" value="{{ old('descripcion_categoria') }}">
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
<div class="modal fade" id="editar_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Categoría</h5>
            </div>
            <form action="/compras/categorias" method="post">
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
                        Nombre Categoría
                        <input type="text" name="editar_descripcion_categoria" id="editar_descripcion_categoria" onkeyup="mayus(this);" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_descripcion_categoria') }}">
                    </div>
                    <div class="form-group">
                        Estado
                        <select name="editar_estado_categoria" id="editar_estado_categoria" style="width: 70%;" class="form-control bg-light border-0 small">
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
                <input type="hidden" id="editar_codigo_categoria" name="editar_codigo_categoria">
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        
        var cod_categoria = 0;
        var descripcion_categoria = '';
        var estado_categoria = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_categoria").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_categoria").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_categoria").modal('show');
                cod_categoria = $(this).data('id');

                descripcion_categoria = $('#descripcion_categoria'+cod_categoria).val();
                estado_categoria = $('#estado_categoria'+cod_categoria).val();
                    
                $('#editar_codigo_categoria').val(cod_categoria);
                $('#editar_descripcion_categoria').val(descripcion_categoria);
                
                if(estado_categoria == 'SI'){
                    
                    document.getElementById("editar_estado_categoria").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_categoria").selectedIndex = 1;
                    
                }
                
            });
            
        });

        
        function mayus(e) {
        e.value = e.value.toUpperCase();
    }


        
    </script>
@endsection
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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_productos" name="div_encabezado_productos">
    <h1 class="h3 mb-0 text-gray-800">
        Modulo De Productos
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_producto">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Producto
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
    <label style="color: white; margin: 1%;">Listado De Productos</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_productos" name="div_listado_productos" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:20%;">Nombre</th>
            <th style="width:30%;">Descripcion</th>
            <th style="width:10%;">Cantidad</th>
            <th style="width:10%;">Precio</th>
            <th style="width:10%;">Categoria</th>
            <th style="width:10%;">Estado</th>
            <th style="width:10%;">Editar</th>
        </tr>
        
        @foreach($productos_array[0] as $producto)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="nombre_producto{{$producto['COD_PRODUCTO']}}" name="nombre_producto{{$producto['COD_PRODUCTO']}}" value="{{$producto['NOM_PRODUCTO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="descripcion_producto{{$producto['COD_PRODUCTO']}}" name="descripcion_producto{{$producto['COD_PRODUCTO']}}" value="{{$producto['DESC_PRODUCTO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="cantidad_producto{{$producto['COD_PRODUCTO']}}" name="cantidad_producto{{$producto['COD_PRODUCTO']}}" value="{{$producto['CANTIDAD']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="precio_producto{{$producto['COD_PRODUCTO']}}" name="precio_producto{{$producto['COD_PRODUCTO']}}" value="{{$producto['PRECIO_UNITARIO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="categoria_producto{{$producto['COD_PRODUCTO']}}" name="categoria_producto{{$producto['COD_PRODUCTO']}}" value="{{$producto['NOM_CATEGORIA']}}">
                    <input type="hidden" id="categoria_producto_id{{$producto['COD_PRODUCTO']}}" nombre="categoria_producto_id{{$producto['COD_PRODUCTO']}}" value="{{$producto['COD_CATEGORIA']}}">
                </td>
                
                @if( $producto['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_producto{{$producto['COD_PRODUCTO']}}" name="estado_producto{{$producto['COD_PRODUCTO']}}" value="SI">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_producto{{$producto['COD_PRODUCTO']}}" name="estado_producto{{$producto['COD_PRODUCTO']}}" value="NO">
                    </td>
                
                @endif
                
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$producto['COD_PRODUCTO']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_producto">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach

    </table>
    
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Guardar Producto</h5>
            </div>
            <form action="/inventarios/productos" method="post">
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
                        <input type="text" name="nombre_producto" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Nombre" aria-describedby="basic-addon2" value="{{ old('nombre_producto') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="descripcion_producto" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Descripcion" aria-describedby="basic-addon2" value="{{ old('descripcion_producto') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="cantidad_producto" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Cantidad" aria-describedby="basic-addon2" value="{{ old('cantidad_producto') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="precio_producto" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Precio" aria-describedby="basic-addon2" value="{{ old('precio_producto') }}">
                    </div>
                    <div class="form-group">
                        <select name="categoria_producto" id="categoria_producto" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                            @foreach($categorias_array[0] as $categoria)
                                <option value="{{$categoria['COD_CATEGORIA']}}">{{$categoria['NOM_CATEGORIA']}}</option>
                            @endforeach
                        </select>
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
<div class="modal fade" id="editar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
            </div>
            <form action="/inventarios/productos" method="post">
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
                        <input type="text" name="editar_nombre_producto" id="editar_nombre_producto" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_nombre_producto') }}">
                    </div>
                    <div class="form-group">
                        Descripcion
                        <input type="text" name="editar_descripcion_producto" id="editar_descripcion_producto" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_descripcion_producto') }}">
                    </div>
                    <div class="form-group">
                        Cantidad
                        <input type="text" name="editar_cantidad_producto" id="editar_cantidad_producto" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_cantidad_producto') }}">
                    </div>
                    <div class="form-group">
                        Precio
                        <input type="text" name="editar_precio_producto" id="editar_precio_producto" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_precio_producto') }}">
                    </div>
                    <div class="form-group">
                        Categoria
                        <select name="editar_categoria_producto" id="editar_categoria_producto" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                            @foreach($categorias_array[0] as $categoria)
                                <option value="{{$categoria['COD_CATEGORIA']}}">{{$categoria['NOM_CATEGORIA']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        Estado
                        <select name="editar_estado_producto" id="editar_estado_producto" style="width: 70%;" class="form-control bg-light border-0 small">
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
                <input type="hidden" id="editar_codigo_producto" name="editar_codigo_producto">
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        
        var cod_producto = 0;
        var nombre_producto = '';
        var descripcion_producto = '';
        var cantidad_producto = 0;
        var precio_producto = 0;
        var categoria_producto_id = '';
        var estado_producto = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_producto").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_producto").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_producto").modal('show');
                cod_producto = $(this).data('id');

                nombre_producto = $('#nombre_producto'+cod_producto).val();
                descripcion_producto = $('#descripcion_producto'+cod_producto).val();
                cantidad_producto = $('#cantidad_producto'+cod_producto).val();
                precio_producto = $('#precio_producto'+cod_producto).val();
                categoria_producto = $('#categoria_producto_id'+cod_producto).val();
                estado_producto = $('#estado_producto'+cod_producto).val();
                
                $('#editar_codigo_producto').val(cod_producto);
                $('#editar_nombre_producto').val(nombre_producto);
                $('#editar_descripcion_producto').val(descripcion_producto);
                $('#editar_cantidad_producto').val(cantidad_producto);
                $('#editar_precio_producto').val(precio_producto);
                document.getElementById("editar_categoria_producto").selectedIndex = (categoria_producto-1);
                
                if(estado_producto == 'SI'){
                    
                    document.getElementById("editar_estado_producto").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_producto").selectedIndex = 1;
                    
                }
                
            });
            
        });
        
    </script>
@endsection
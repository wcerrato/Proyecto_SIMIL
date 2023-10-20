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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_tipo_factura" name="div_encabezado_tipo_factura">
    <h1 class="h3 mb-0 text-gray-800">
        Modulo De Tipo de Factura
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_tipo_factura">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Tipo de Factura
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
    <label style="color: white; margin: 1%;">Listado De Tipos de Factura</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_tipo_factura" name="div_listado_tipo_factura" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:80%">Descripcion</th>
            <th style="width:10%">Activo</th>
            <th style="width:10%">Acciones</th>
        </tr>
        
        @foreach($tipo_factura_array[0] as $tipo_factura)
        
        <tr>
            <td>
                <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="nom_tipo_factura{{$tipo_factura['COD_TIPO_FACTURA']}}" name="nom_tipo_factura{{$tipo_factura['COD_TIPO_FACTURA']}}" value="{{$tipo_factura['NOM_TIPO_FACTURA']}}">
            </td>
          
            @if( $tipo_factura['ESTADO'] == 'A' )
            
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_tipo_factura{{$tipo_factura['COD_TIPO_FACTURA']}}" name="estado_tipo_factura{{$tipo_factura['COD_TIPO_FACTURA']}}" value="SI">
                </td>
            
            @else
            
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_tipo_factura{{$tipo_factura['COD_TIPO_FACTURA']}}" name="estado_tipo_factura{{$tipo_factura['COD_TIPO_FACTURA']}}" value="NO">
                </td>
            
            @endif
            
            <td>
                <button class="btn btn-round btnEditar" data-id="{{$tipo_factura['COD_TIPO_FACTURA']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_tipo_factura">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </button>
            </td>
        </tr>
    
    @endforeach

</table>

</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_tipo_factura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Guardar Tipo Factura</h5>
            </div>
            <form action="/facturacion/tipo_factura" method="post">
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
                        <input type="text" name="descripcion_tipo_factura" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Descripcion" aria-describedby="basic-addon2" value="{{ old('descripcion_tipo_factura') }}">
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
<div class="modal fade" id="editar_tipo_factura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Tipo Factura</h5>
            </div>
            <form action="/facturacion/tipo_factura" method="post">
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
                        Descripcion
                        <input type="text" name="editar_descripcion_tipo_factura" id="editar_descripcion_tipo_factura" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_descripcion_tipo_factura') }}">
                    </div>
                    <div class="form-group">
                        Estado
                        <select name="editar_estado_tipo_factura" id="editar_estado_tipo_factura" style="width: 70%;" class="form-control bg-light border-0 small">
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
                <input type="hidden" id="editar_codigo_tipo_factura" name="editar_codigo_tipo_factura">
            </form>
        </div>
    </div>
</div>


@endsection

@section('scripts')
    <script>
        
        var cod_tipo_factura = 0;
        var nom_tipo_factura = '';
        var estado_tipo_factura = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_tipo_factura").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_tipo_factura").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_tipo_factura").modal('show');
                cod_tipo_factura = $(this).data('id');

                nom_tipo_factura = $('#nom_tipo_factura'+cod_tipo_factura).val();
                estado_tipo_factura = $('#estado_tipo_factura'+cod_tipo_factura).val();
                    
                $('#editar_codigo_tipo_factura').val(cod_tipo_factura);
                $('#editar_descripcion_tipo_factura').val(nom_tipo_factura);
                
                if(estado_tipo_factura == 'SI'){
                    
                    document.getElementById("editar_estado_tipo_factura").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_tipo_factura").selectedIndex = 1;
                    
                }
                
            });
            
        });
        
    </script>
@endsection

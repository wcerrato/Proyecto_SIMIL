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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_formas_pago" name="div_encabezado_formas_pago">
    <h1 class="h3 mb-0 text-gray-800">
        Modulo De Formas De Pago
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_forma_pago">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Forma Pago
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
    <label style="color: white; margin: 1%;">Listado De Formas De Pago</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_forma_pago" name="div_listado_forma_pago" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:80%">Descripcion</th>
            <th style="width:10%">Activo</th>
            <th style="width:10%">Acciones</th>
        </tr>
        
        @foreach($forma_pago_array[0] as $forma_pago)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="nom_forma_pago{{$forma_pago['COD_FORMA_PAGO']}}" name="nom_forma_pago{{$forma_pago['COD_FORMA_PAGO']}}" value="{{$forma_pago['NOM_FORMA_PAGO']}}">
                </td>
                
                @if( $forma_pago['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_forma_pago{{$forma_pago['COD_FORMA_PAGO']}}" name="estado_forma_pago{{$forma_pago['COD_FORMA_PAGO']}}" value="SI">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_forma_pago{{$forma_pago['COD_FORMA_PAGO']}}" name="estado_forma_pago{{$forma_pago['COD_FORMA_PAGO']}}" value="NO">
                    </td>
                
                @endif
                
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$forma_pago['COD_FORMA_PAGO']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_forma_pago">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach
        
    </table>
    
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_forma_pago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Guardar Forma Pago</h5>
            </div>
            <form action="/facturacion/forma_pago" method="post">
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
                        <input type="text" name="descripcion_forma_pago" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Descripcion" aria-describedby="basic-addon2" value="{{ old('descripcion_forma_pago') }}">
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
<div class="modal fade" id="editar_forma_pago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Forma Pago</h5>
            </div>
            <form action="/facturacion/forma_pago" method="post">
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
                        <input type="text" name="editar_descripcion_forma_pago" id="editar_descripcion_forma_pago" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_descripcion_forma_pago') }}">
                    </div>
                    <div class="form-group">
                        Estado
                        <select name="editar_estado_forma_pago" id="editar_estado_forma_pago" style="width: 70%;" class="form-control bg-light border-0 small">
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
                <input type="hidden" id="editar_codigo_forma_pago" name="editar_codigo_forma_pago">
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        
        var cod_forma_pago = 0;
        var nom_forma_pago = '';
        var estado_forma_pago = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_forma_pago").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_forma_pago").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_forma_pago").modal('show');
                cod_forma_pago = $(this).data('id');

                nom_forma_pago = $('#nom_forma_pago'+cod_forma_pago).val();
                estado_forma_pago = $('#estado_forma_pago'+cod_forma_pago).val();
                    
                $('#editar_codigo_forma_pago').val(cod_forma_pago);
                $('#editar_descripcion_forma_pago').val(nom_forma_pago);
                
                if(estado_forma_pago == 'SI'){
                    
                    document.getElementById("editar_estado_forma_pago").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_forma_pago").selectedIndex = 1;
                    
                }
                
            });
            
        });
        
    </script>
@endsection
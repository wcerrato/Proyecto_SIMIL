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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_parametros_generales" name="div_encabezado_parametros_generales">
    <h1 class="h3 mb-0 text-gray-800">
        Modulo De Parametros Generales
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_parametro">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Parametro
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
    <label style="color: white; margin: 1%;">Listado De Parametros Generales</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_parametros" name="div_listado_parametros" style="width: 90%; margin: 0 auto;">
    
    <table style="width:70%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:50%;">Parametro</th>
            <th style="width:30%;">Valor</th>
            <th style="width:10%;">Activo</th>
            <th style="width:10%;">Editar</th>
        </tr>
        
        @foreach($parametros_array[0] as $parametro)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="descripcion_parametro{{$parametro['COD_PARAMETRO']}}" name="descripcion_parametro{{$parametro['COD_PARAMETRO']}}" value="{{$parametro['PARAMETRO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="valor_parametro{{$parametro['COD_PARAMETRO']}}" name="valor_parametro{{$parametro['COD_PARAMETRO']}}" value="{{$parametro['VALOR']}}">
                </td>
                
                @if( $parametro['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_parametro{{$parametro['COD_PARAMETRO']}}" name="estado_parametro{{$parametro['COD_PARAMETRO']}}" value="SI">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="estado_parametro{{$parametro['COD_PARAMETRO']}}" name="estado_parametro{{$parametro['COD_PARAMETRO']}}" value="NO">
                    </td>
                
                @endif
                
                <td>
                    <button class="btn btn-round btnEditar" data-id="{{$parametro['COD_PARAMETRO']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_parametro">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                    </button>
                </td>
            </tr>
        
        @endforeach
    </table>
   
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_parametro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Guardar Parametro</h5>
            </div>
            <form action="/administracion/parametros_generales" method="post">
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
                        <input type="text" name="descripcion_parametro" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Descripcion" aria-describedby="basic-addon2" value="{{ old('descripcion_parametro') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="valor_parametro" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Valor" aria-describedby="basic-addon2" value="{{ old('valor_parametro') }}">
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
<div class="modal fade" id="editar_parametro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Parametro</h5>
            </div>
            <form action="/administracion/parametros_generales" method="post">
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
                        <input type="text" name="editar_descripcion_parametro" id="editar_descripcion_parametro" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_descripcion_parametro') }}">
                    </div>
                    <div class="form-group">
                        Valor
                        <input type="text" name="editar_valor_parametro" id="editar_valor_parametro" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_valor_parametro') }}">
                    </div>
                    <div class="form-group">
                        Estado
                        <select name="editar_estado_parametro" id="editar_estado_parametro" style="width: 70%;" class="form-control bg-light border-0 small">
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
                <input type="hidden" id="editar_codigo_parametro" name="editar_codigo_parametro">
            </form>
        </div>
    </div>
</div>
    
@endsection

@section('scripts')
    <script>
        
        var cod_parametro = 0;
        var descripcion_parametro = '';
        var valor_parametro = 0;
        var estado_parametro = '';
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_parametro").modal('show');
            
            @elseif($message = Session::get('EditInsert'))
                
                $("#editar_parametro").modal('show');
            
            @endif
            
            $(".btnEditar").click(function(){
                
                $("#editar_parametro").modal('show');
                cod_parametro = $(this).data('id');

                descripcion_parametro = $('#descripcion_parametro'+cod_parametro).val();
                valor_parametro = $('#valor_parametro'+cod_parametro).val();
                estado_parametro = $('#estado_parametro'+cod_parametro).val();
                    
                $('#editar_codigo_parametro').val(cod_parametro);    
                $('#editar_descripcion_parametro').val(descripcion_parametro);
                $('#editar_valor_parametro').val(valor_parametro);
                
                if(estado_parametro == 'SI'){
                    
                    document.getElementById("editar_estado_parametro").selectedIndex = 0;
                    
                }else{
                    
                    document.getElementById("editar_estado_parametro").selectedIndex = 1;
                    
                }
                
            });
            
        });
        
    </script>
@endsection
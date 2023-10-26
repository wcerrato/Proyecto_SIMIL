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

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_ajustes" name="div_encabezado_ajustes">
    <h1 class="h3 mb-0 text-gray-800">
        Módulo de Ajustes
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#guardar_ajuste">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar 
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
    <label style="color: white; margin: 1%;">Ajustes de Inventario</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_ajustes" name="div_listado_ajustes" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:15%;">FECHA</th>
            <th style="width:15%;">TIPO</th>
            <th style="width:50%;">PRODUCTO</th>
            <th style="width:10%;">CANTIDAD</th>
            <th style="width:10%;">ESTADO</th>
        </tr>
        
        @foreach($ajustes_array[0] as $ajustes)
        
            <tr>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="fecha_ajuste{{$ajustes['COD_AJUSTE']}}" name="fecha_ajuste{{$ajustes['COD_AJUSTE']}}" value="{{date('Y-m-d',strtotime($ajustes['FEC_AJUSTE']))}}">
                </td>
                
                @if( $ajustes['TIPO_AJUSTE'] == 'ENT' )
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="tipo_ajuste{{$ajustes['COD_AJUSTE']}}" name="tipo_ajuste{{$ajustes['COD_AJUSTE']}}" value="ENTRADA">
                    </td>
                
                @else
                
                    <td>
                        <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="tipo_ajuste{{$ajustes['COD_AJUSTE']}}" name="tipo_ajuste{{$ajustes['COD_AJUSTE']}}" value="SALIDA">
                    </td>
                
                @endif

                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="producto_ajuste{{$ajustes['COD_AJUSTE']}}" name="producto_ajuste{{$ajustes['COD_AJUSTE']}}" value="{{$ajustes['NOM_PRODUCTO']}}">
                    <input type="hidden" id="producto_ajuste_id{{$ajustes['COD_AJUSTE']}}" nombre="producto_ajuste_id{{$ajustes['COD_AJUSTE']}}" value="{{$ajustes['COD_PRODUCTO']}}">
                </td>
                <td>
                    <input type="text" style="width:100%; color: grey; background: transparent; border: none; pointer-events: none;" id="cantidad_ajuste{{$ajustes['COD_AJUSTE']}}" name="cantidad_ajuste{{$ajustes['COD_AJUSTE']}}" value="{{$ajustes['CANTIDAD']}}">
                </td>
                
                @if( $ajustes['ESTADO'] == 'A' )
                
                    <td>
                        <input type="text" style="width:100%; color: #1cc88a; background: transparent; border: none; pointer-events: none; font-weight: bold;" id="tipo_ajuste{{$ajustes['COD_AJUSTE']}}" name="tipo_ajuste{{$ajustes['COD_AJUSTE']}}" value="APLICADO">
                    </td>
                
                @else
                
                    <td>
                        <button class="btn btn-round btnEditar" data-id="{{$ajustes['COD_AJUSTE']}}" style="background-color: #4e73df; color: white;" data-toggle="modal" data-target="#editar_ajuste">
                            <i class="fas fa-edit fa-sm text-white-50"></i>
                        </button>
                    </td>
                
                @endif
                
            </tr>
        
        @endforeach
        
    </table>
    
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="guardar_ajuste" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Agregar Ajuste</h5>
            </div>
            <form action="/inventarios/ajustes" method="post">
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
                        <input type="date" name="fecha_ajuste" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Fecha" aria-describedby="basic-addon2" value="{{ old('fecha_ajuste') }}">
                    </div>
                    <div class="form-group">
                        Tipo
                        <select name="tipo_ajuste" id="tipo_ajuste" style="width: 70%;" class="form-control bg-light border-0 small aria-describedby="basic-addon2" value="{{ old('tipo_ajuste') }}">
                            <option value="ENT">ENTRADA</option>
                            <option value="SAL">SALIDA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="producto_ajuste" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Codigo Producto" aria-describedby="basic-addon2" value="{{ old('producto_ajuste') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="cantidad_ajuste" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Cantidad" aria-describedby="basic-addon2" value="{{ old('cantidad_ajuste') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                        <i class="fas fa-check-circle fa-sm text-white-50"></i> Aplicar
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
        
        $(document).ready(function(){
            
            @if($message = Session::get('ErrorInsert'))
                
                $("#guardar_ajuste").modal('show');
            
            @endif
            
        });
        
    </script>
@endsection
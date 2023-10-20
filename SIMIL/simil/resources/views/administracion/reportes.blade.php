@extends('layouts.main')

@section('contenido')

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_reportes" name="div_encabezado_reportes">
    <h1 class="h3 mb-0 text-gray-800">
        Modulo De Reportes
    </h1>
</div>

<div class="row">
    @if($message = Session::get('mensaje_guardado'))
    <div class="col-12 alert alert-success alert-dismissable fade show" role='alert'>
        <span>{{ $message }}</span>
    </div>
    @endif    
</div>

<div style=" background-color: #f3b103; width: 90%; margin: 0 auto;">
    <label style="color: white; margin: 1%;">Listado De Reportes</label>
</div>

<div style="margin:2%;"></div>

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Generar Reportes</h5>
        </div>
        <form action="/administracion/reportes" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <select style="width:50%;" id="tipo_reporte" name="tipo_reporte" class="form-control bg-light border-0 small form-group" aria-describedby="basic-addon2">
                        <option value="cliente">Clientes</option>
                        <option value="venta">Ventas</option>
                        <option value="producto">Productos</option>
                        <option value="compra">Compras</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                    <i class="fas fa-print fa-sm text-white-50"></i>
                </button>
            </div>
        </form>
    </div>
</div>
    
@endsection
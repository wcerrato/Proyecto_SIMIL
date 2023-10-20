@extends('layouts.main')

@section('contenido')

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_inventario" name="div_encabezado_inventario">
    <h1 class="h3 mb-0 text-gray-800">
        Modulo De Inventario
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Producto
    </a>
</div>

<div style=" background-color: #f3b103; width: 90%; margin: 0 auto;">
    <label style="color: white; margin: 1%;">Listado De Productos</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_inventario" name="div_listado_inventario" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th>Nombre de producto</th>
            <th>Cantidad existente</th>
            <th>Precio de venta</th>
            <th>Acciones</th>
        </tr>
        <tr>
            <td>Papel</td>
            <td>100</td>
            <td>5</td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>Carpetas</td>
            <td>200</td>
            <td>10</td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>Pliegos de 5x8</td>
            <td>150</td>
            <td>25</td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
    </table>
    
</div>
    
@endsection
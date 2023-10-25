@extends('layouts.main')

@section('contenido')

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_permisos" name="div_encabezado_permisos">
    <h1 class="h3 mb-0 text-gray-800">
        Módulo de Permisos
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Configurar Permiso
    </a>
</div>

<div style=" background-color: #f3b103; width: 90%; margin: 0 auto;">
    <label style="color: white; margin: 1%;">Configuración de permisos</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_permisos" name="div_listado_permisos" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th style="width:60%;">PERMISO</th>
            <th style="width:10%;">ACCEDER</th>
            <th style="width:10%;">CREAR</th>
            <th style="width:10%;">EDITAR</th>
            <th style="width:20%;">ACCIONES</th>
           
        </tr>
        <tr>
            <td>Ventas </td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>Crear usuarios</td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>Generar reportes</td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>Borrar factura </td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>Agregar productos </td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>Editar inventario </td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>Dar permisos a usuarios </td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
    </table>
    
</div>
    
@endsection
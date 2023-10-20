@extends('layouts.main')

@section('contenido')

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_clientes" name="div_encabezado_clientes">
    <h1 class="h3 mb-0 text-gray-800">
        Modulo De Clientes
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Cliente
    </a>
</div>

<div style=" background-color: #f3b103; width: 90%; margin: 0 auto;">
    <label style="color: white; margin: 1%;">Listado De Clientes</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_clientes" name="div_listado_clientes" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Editar</th>
        </tr>
        <tr>
            <td>Juan Cruz</td>
            <td>98974052</td>
            <td>jcruz@gmail.com</td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>Maria Flores</td>
            <td>98524101</td>
            <td>mflores@gmail.com</td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>Miguel Martinez</td>
            <td>84102312</td>
            <td>mmartinez@gmail.com</td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
    </table>
    
</div>
    
@endsection
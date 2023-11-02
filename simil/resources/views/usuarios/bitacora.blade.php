@extends('layouts.main')

@section('contenido')

<style>
    /* Agrega un margen en la parte superior del elemento de paginación */
.pagination {
    margin-top: 10px;
}




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

    .small-text {
        font-size: 13px; /* Establece el tamaño de fuente que desees */
    }

    /* Estilo para la tabla */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #ccc;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }
    
    th {
        background-color: #4e73df;
        color: white;
    }

</style>

<div style="margin:1%;" class="d-sm-flex align-items-center justify-content-between mb-4" id="div_encabezado_bitacora" name="div_encabezado_bitacora">
    <h1 class="h3 mb-0 text-gray-800">
        Bitácora
    </h1>
    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm" data-toggle="modal" data-target="#imprimir">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Imprimir
    </a>
</div>

<div class="row">
    @if($message = Session::get('mensaje_guardado'))
    <div class="col-12 alert alert-success alert-dismissable fade show" role='alert'>
        <span>{{ $message }}</span>
    </div>
    @endif
</div>

<div style="background-color: #f3b103; width: 90%; margin: 0 auto;">
    <label style="color: black; margin: 1%;">Datos Generados </label>
</div>

<div style="margin:2%;"></div>

 <!-- buscador -->
<div id="div_listado_bitacora" name="div_ldiv_listado_bitacoraistado_roles" style="width: 90%; margin: 0 auto;">
    <div class="d-md-flex justify-content-md-end">
        <form action="/usuarios/bitacora" method="GET">
            <div class="btn-group">
            <input type="text" id = "busqueda" name="busqueda" class="form-control" placeholder="Filtrar por registros" oninput="this.value = this.value.toUpperCase();">
                <input type="submit" value="Buscar" class="btn btn-primary">
            </div>
        </form>
    </div>




    <!-- muestra los registros  -->
    <div class="row">
        <div class="col-12">
            <p class="small-text">Total: {{ $categorias->total() }} Registros | Mostrando
                <select id="perPage" onchange="changePerPage(this.value)">
                    <option value="05" @if($categorias->perPage() == 05) selected @endif>05</option>
                    <option value="10" @if($categorias->perPage() == 10) selected @endif>10</option>
                    <option value="20" @if($categorias->perPage() == 20) selected @endif>20</option>
                </select>
                por Página | Página {{ $categorias->currentPage() }} de {{ $categorias->lastPage() }}
            </p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 05%;">ID</th>
                <th style="width: 15%;">OBJETO</th>
                <th style="width: 20%;">FECHA</th>
                <th style="width: 20%;">USUARIO</th>
                <th style="width: 10%;">ACCIÓN</th>
                <th>DESCRIPCIÓN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $bitacora)
                <tr>
                    <td>{{ $bitacora->COD_BITACORA }}</td>
                    <td>{{ $bitacora->NOM_OBJETO }}</td>
                    <td>{{ $bitacora->FECHA }}</td>
                    <td>{{ $bitacora->COD_USUARIO }}</td>
                    <td>{{ $bitacora->ACCION }}</td>
                    <td>{{ $bitacora->DESCRIPCION }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin:2%;"></div>

 <!-- empaginado -->
    {{$categorias ->links()}}

    <div style="margin:2%;"></div>
</div>
@endsection


<script>
 function changePerPage(value) {
    console.log("Cambiando registros por página a " + value);
    window.location.href = "{{ route('bitacora.index') }}?perPage=" + value;
}
</script>



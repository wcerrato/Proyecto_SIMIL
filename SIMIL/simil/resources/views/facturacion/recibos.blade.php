@extends('layouts.main')

@section('contenido')

<script>

    // Open the Modal
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

</script>

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
        Modulo Recibos
    </h1>
    <a href="#" onclick="openModal();" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Agregar Recibo
    </a>
</div>

<div style=" background-color: #f3b103; width: 90%; margin: 0 auto;">
    <label style="color: white; margin: 1%;">Listado De Recibos</label>
</div>

<div style="margin:2%;"></div>

<div id="div_listado_tipo_facturas" name="div_listado_tipo_facturas" style="width: 90%; margin: 0 auto;">
    
    <table style="width:90%; margin: 0 auto;" border="1" >
        <tr style="background-color: #4e73df;  color: white; text-align: center;">
            <th>Recibo No</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Activo</th>
            <th>Editar</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Wilmer Cerrato</td>
            <td>2023-08-02</td>
            <td>1000</td>
            <td>SI</td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Juan Perez</td>
            <td>2023-08-10</td>
            <td>35</td>
            <td>SI</td>
            <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                </a>
            </td>
        </tr>
    </table>
    
</div>

<div id="myModal" class="modal">
  
    <div class="modal-content">
        
        <div style="background-color: #4e73df; color: white; width: 100%; margin: 0 auto;">
            <label style="color: white; margin: 1%;">Agregar Recibo</label>
            <label onclick="closeModal()" style="color: white; float: right; margin: 1%;"  >X</label>
        </div>
    
        <table style="width:60%; margin: 0 auto;">
            <tr>
                <td style="width:50%">Cliente:</td>
                <td style="width:50%">
                    <input type="text" style="width: 50%;" class="form-control bg-light border-0 small" placeholder="3"
                           aria-label="Impuesto" aria-describedby="basic-addon2">
                </td>
            </tr>
            <tr>
                <td style="width:50%">Valor: </td>
                <td style="width:50%">
                    <input type="text" style="width: 50%;" class="form-control bg-light border-0 small" placeholder="0"
                           aria-label="Fecha" aria-describedby="basic-addon2">
                </td>
            </tr>
            <tr>
                <td style="width:50%">Activo</td>
                <td style="width:50%">
                    <select class="form-control bg-light border-0 small" style="width: 50%;">
                        <option value="TRUE">SI</option>
                        <option value="FALSE">NO</option>
                    </select>
                </td>
            </tr>
            <tr style="height: 15px;">
                <td></td>
                <td></td>
            </tr>
            <tr style=" text-align: center;">
                <td style="width:50%">
                    <a href="#" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                        <i class="fas fa-check-circle fa-sm text-white-50"></i> Guardar
                    </a>
                </td>
                <td style="width:50%">
                    <a href="#" style="background-color: #999; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                        <i class="fas fa-times-circle fa-sm text-white-50"></i> Limpiar
                    </a>
                </td>
            </tr>
        </table>

    </div>
    
</div>
    
@endsection
<!DOCTYPE html>
<html lang="es">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reporte Compras</title>
    </head>
    <body>
        <div id="company">
            <h2 class="name">Máxima Industria Litográfica</h2>
            <div>B° San Pablo Calle Principal, Casa N° 2025</div>
            <div>Tel. 2238-7406 / Cel. 9967-8365</div>
            <div><a href="mailto: joseandrescarias@yahoo.com">joseandrescarias@yahoo.com</a></div>
        </div>
        <div style="margin:2%;"></div>
        <div>
            Listado de Compras
        </div>
        <div style="margin:2%;"></div>
        <table style="width:90%; margin: 0 auto;" border="1" >
            <tr style="background-color: #4e73df;  color: white; text-align: center;">
                <th style="width:20%;">Fecha</th>
                <th style="width:20%;">Total</th>
                <th style="width:20%;">Factura No</th>
                <th style="width:20%;">Proveedor</th>
                <th style="width:20%;">Forma Pago</th>
            </tr>
            @foreach($compras_array[0] as $compras)
        
                <tr>
                    <td>{{$compras['FEC_COMPRA']}}</td>
                    <td>{{$compras['TOT_COMPRA']}}</td>
                    <td>{{$compras['FACTURA_NO']}}</td>
                    <td>{{$compras['NOM_PROVEEDOR']}}</td>
                    <td>{{$compras['NOM_FORMA_PAGO']}}</td>
                </tr>

            @endforeach
        </table>
    </body>
    
</html>
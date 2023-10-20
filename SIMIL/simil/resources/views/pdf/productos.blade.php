<!DOCTYPE html>
<html lang="es">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reporte Productos</title>
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
            Listado de Productos
        </div>
        <div style="margin:2%;"></div>
        <table style="width:90%; margin: 0 auto;" border="1" >
            <tr style="background-color: #4e73df;  color: white; text-align: center;">
                <th style="width:20%;">Nombre</th>
                <th style="width:30%;">Descripcion</th>
                <th style="width:10%;">Cantidad</th>
                <th style="width:10%;">Precio</th>
            </tr>
            @foreach($productos_array[0] as $productos)
        
                <tr>
                    <td>{{$productos['NOM_PRODUCTO']}}</td>
                    <td>{{$productos['DESC_PRODUCTO']}}</td>
                    <td>{{$productos['CANTIDAD']}}</td>
                    <td>{{$productos['PRECIO_UNITARIO']}}</td>
                </tr>

            @endforeach
        </table>
    </body>
    
</html>
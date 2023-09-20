<!DOCTYPE html>
<html lang="es">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reporte Clientes</title>
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
            Listado de Clientes
        </div>
        <div style="margin:2%;"></div>
        <table style="width:90%; margin: 0 auto;" border="1" >
            <tr style="background-color: #4e73df;  color: white; text-align: center;">
                <th style="width:10%;">Codigo</th>
                <th style="width:20%;">Nombre</th>
                <th style="width:10%;">Empresa</th>
                <th style="width:10%;">RTN</th>
                <th style="width:10%;">Telefono</th>
                <th style="width:20%;">Correo</th>
                <th style="width:20%;">Direccion</th>
            </tr>
            @foreach($clientes_array[0] as $clientes)
        
                <tr>
                    <td>{{$clientes['COD_CLIENTE']}}</td>
                    <td>{{$clientes['NOM_PERSONA']}}</td>
                    <td>{{$clientes['NOM_EMPRESA']}}</td>
                    <td>{{$clientes['RTN']}}</td>
                    <td>{{$clientes['NUM_TELEFONO']}}</td>
                    <td>{{$clientes['CORREO']}}</td>
                    <td>{{$clientes['DIRECCION']}}</td>
                </tr>

            @endforeach
        </table>
    </body>
    
</html>
<!DOCTYPE html>
<html lang="es">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Factura</title>
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
            Factura No: {{ session('cod_factura') }}
        </div>
        <div style="margin:2%;"></div>
        <div>
            <table>
                <tr>
                    <td>Cliente:</td>
                    <td>
                        <div>
                            {{session('encabezado_persona')}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Tipo:</td>
                    <td>
                        <div>
                            {{session('encabezado_tipo_factura')}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Forma Pago:</td>
                    <td>
                        <div>
                            {{session('encabezado_forma_pago')}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Descuento:</td>
                    <td>
                        <div>
                            {{session('encabezado_descuento')}}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div style="margin:2%;"></div>
        <div>
            <table>
                 <tr>
                    <td>Sub Total:</td>
                    <td>{{session('subtotal_venta')}}</td>
                </tr>
                <tr>
                    <td>Impuesto:</td>
                    <td>{{session('impuesto_venta')}}</td>
                </tr>
                <tr>
                    <td>Descuento:</td>
                    <td>{{session('descuento_venta')}}</td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td>{{session('total_venta')}}</td>
                </tr>
            </table>
        </div>
    </body>
</html>

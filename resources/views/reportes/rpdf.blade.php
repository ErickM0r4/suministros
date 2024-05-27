<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Suministros al {{$fecha}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        h1, h2, h3 {
            text-align: center;
            margin-bottom: 0.5em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 5px; /* Padding reducido desde 8px a 5px para mantener consistencia con el estilo anterior */
            text-align: center;
            font-size: 12px; /* Tamaño de fuente estandarizado para mantener consistencia con el estilo anterior */
        }
        th {
            background-color: #FF6347; /* Cambiado de #f2f2f2 a #FF6347 para mantener consistencia con el estilo anterior */
            color: #ffffff; /* Asegurando que el texto en los encabezados sea blanco */
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .encabezado {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .lineaN {
            background-color: #FF6347; /* Cambiado de azul a #FF6347 para mantener la consistencia */
            height: 10px; /* Ajustado de 30px a 10px para que no sea tan grueso */
            width: 100%;
        }
        tfoot {
            font-weight: bold; /* Manteniendo el texto en negrita para el pie de página */
        }
    </style>
</head>
<body>
    <div class="encabezado">
        <h1>Empresa Proveedora de Piezas Computacionales Valkyrion S.A. de C.V.</h1>
        <h3>Dirección: Francisco I. Madero #1505, Colonia: Centro, Ciudad: Colima, Col.</h3>
        <h3>Teléfono: (52)+ 312-456-7890</h3>
        <div class="lineaN"></div>
    </div>
    <h1>Resumen de Suministros al {{$fecha}}</h1>
    <table class="table" id="maintable">
        <thead>
            <tr>
                <th>CÓDIGO</th>
                <th>PROVEEDOR</th>
                <th>MONTO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suministros as $suministro)
                <tr>
                    <td class="text-center">{{ $suministro->idSuministro}}</td>
                    <td>{{ $suministro->nombre }}</td>
                    <td class="text-end">{{ number_format($suministro->total_monto, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-end">TOTAL</td>
                <td class="text-end">{{ number_format(array_sum(array_column($suministros, "total_monto")), 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>


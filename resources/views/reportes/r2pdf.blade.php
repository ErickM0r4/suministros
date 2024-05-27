<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Suministros</title>
    @php
        $suministros = $suministrosIndex->getColumnValues("idSuministro");
    @endphp
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
        padding: 5px;
        text-align: center;
        font-size: 12px;
    }
    th {
        background-color: #FF6347;
        color: #ffffff;
    }
    .text-center {
        text-align: center;
    }
    .text-end {
        text-align: right;
    }
    .encabezado {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .lineaN {
        background-color: #FF6347;
        height: 10px;
        width: 100%;
    }
    #total, #cantidadTotal1, #cantidadTotal2{
        background-color: #FF6347 !important; 
        color: #fff;
        font-size: 12px !important; 
        font-weight: bold !important;
    }
</style>
</head>
<body>
    <div class="encabezado">
        <h2>Empresa Proveedora de Piezas Computacionales Valkyrion S.A. de C.V.</h2>
        <h3>Dirección: Francisco I. Madero #1505, Colonia: Centro, Ciudad: Colima, Col.</h3>
        <h3>Teléfono: (52)+ 312-456-7890</h3>
        <div class="lineaN"></div>
    </div>
    <div class="text-center">
        <h2>Suministros por periodo: {{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}</h2>
    </div>
    <table class="table" id="maintable">
        <thead>
            <tr>
                <th>CÓDIGO</th>
                <th>PROVEEDOR</th>
                <th>MONTO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suministros as $idSuministro)
            <tr>
                <td>{{ $idSuministro }}</td>
                <td>{{ $suministrosIndex->first(["idSuministro" => $idSuministro], "nombre") }}</td>
                <td class="text-end">{{ number_format($suministrosIndex->sum("monto", ["idSuministro" => $idSuministro]), 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-end" colspan="2" id="total"><b>TOTAL</b></td>
                <td class="text-end" id="cantidadTotal2">{{ number_format($suministrosIndex->sum("monto"), 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>

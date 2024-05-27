@extends("components.layout")
@section("content")
    @component("components.breadcrumbs", ["breadcrumbs"=>$breadcrumbs])
    @endcomponent
    @php
        $fechas=$suministrosIndex->getColumnValues("fecha");
        $suministros=$suministrosIndex->getColumnValues("idSuministro");
    @endphp

    <div class="row my-4 align-items-center">
        <div class="col">
            <h1>Suministros por periodo</h1>
        </div>
        <div class="col-auto">
            <form action="{{ url('pdfm/open') }}" method="get">
                <input type="hidden" name="fecha_inicio" value="{{$fecha_inicio??0}}">
                <input type="hidden" name="fecha_fin" value="{{$fecha_fin??0}}">
                <button type="submit" class="btn-primary btn" style="background-color: transparent; border: none;">
                <img src="{{ asset('images/pdf2.png') }}" alt="Icono" style="height: 50px; margin-right: 5px;">
                <b><p style="color: black" >Generar</p></b>
                </button>
            </form>
        </div>
        <div class="col-auto ml-auto">
            <form action="{{ url('pdfm/download') }}" method="get">
                <input type="hidden" name="fecha_inicio" value="{{$fecha_inicio??0}}">
                <input type="hidden" name="fecha_fin" value="{{$fecha_fin??0}}">
                <button type="submit" class="btn-primary btn"  style="background-color: transparent; border: none;">
                <img src="{{ asset('images/pdfDescargar.png') }}" alt="Icono" style="height: 50px; margin-right: 5px;">
                <b><p style="color: black" >Descargar</p></b>
                </button>
            </form>
        </div>
    </div>
    <form class="card p-4 my-4" action="{{url('/reportes/matriz-sumnistros')}}" method="get">
        @csrf
        <div class="row">
            <div class="col form-group">
                <label for="txtfecha">Fecha inicio</label>
                <input class="form-control" type="date" name="fecha_inicio" id="txtfecha" value="{{$fecha_inicio??0}}">
            </div>
            <div class="col form-group">
                <label for="txtfecha">Fecha fin</label>
                <input class="form-control" type="date" name="fecha_fin" id="txtfecha" value="{{$fecha_fin??0}}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn-primary btn" style="background-color: transparent; border: none;">
                <img src="{{ asset('images/lupa.png') }}" alt="Icono" style="height: 32px; margin-right: 10px; margin-top: 23px;">
                </button>
            </div>
        </div>
    </form>
    <!-- tabla de reportes -->
<table class="table" id="maintable">
    <thead>
        <tr>
            <th>CÓDIGO</th>
            <th>PROVEEDOR</th>
            <th class="text-center">MONTO ENTRE EL PERIODO: <br>{{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y')  }} - {{  \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($suministros as $idSuministro)
        <tr>
            <td class="text-center">{{ $idSuministro }}</td>
            <td class="text-center">{{ $suministrosIndex->first(["idSuministro" => $idSuministro], "nombre") }}</td>
            <td class="text-center">
                @php
                    $subtotal = 0;
                    foreach ($fechas as $fecha) {
                        $subtotal += $suministrosIndex->sum("monto", ["idSuministro" => $idSuministro, "fecha" => $fecha]);
                    }
                    echo number_format($subtotal, 2);
                @endphp
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="text-end" colspan="2"><b>TOTAL</b></td>
            <td class="text-center">
                @php
                    $totalGeneral = 0;
                    foreach ($fechas as $fecha) {
                        $totalGeneral += $suministrosIndex->sum("monto", ["fecha" => $fecha]);
                    }
                    echo number_format($totalGeneral, 2);
                @endphp
            </td>
        </tr>
    </tfoot>
</table>
<script>
    $(document).ready(function() {
        let table = $('#maintable').DataTable({
            paging: true,
            searching: true
        });

        $('#searchProveedor').on('keyup', function() {
            table.column(1).search(this.value).draw();
        });
    });
    </script>
@endsection

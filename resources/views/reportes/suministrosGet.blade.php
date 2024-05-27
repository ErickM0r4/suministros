@extends('components.layout')
@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row my-4 align-items-center">
        <div class="col">
            <h1>Suministros realizados antes de la fecha:</h1>
        </div>
        <div class="col-auto">
            <form action="{{ url('pdf/open') }}" method="get">
                <input type="hidden" name="fecha" value="{{ $fecha }}">
                <button type="submit" class="btn-primary btn" style="background-color: transparent; border: none;">
                    <img src="{{ asset('images/pdf2.png') }}" alt="Icono" style="height: 50px; margin-right: 5px;">
                    <b><p style="color: black" >Generar</p></b>
                    <i class="fas fa-file-pdf"></i>
                </button>
            </form>
        </div>
        <div class="col-auto ml-auto">
            <form action="{{ url('pdf/download') }}" method="get">
                <input type="hidden" name="fecha" value="{{ $fecha }}">
                <button type="submit" class="btn-primary btn" style="background-color: transparent; border: none;">
                    <img src="{{ asset('images/pdfDescargar.png') }}" alt="Icono" style="height: 50px; margin-right: 5px;">
                    <b><p style="color: black" >Descargar</p></b>
                </button>
            </form>
        </div>
    </div>

    <form class="card p-4 my-2" action="{{ url('reportes/suministros') }}" method="get">
        <div class="row">
            <div class="col form-group">
                <label for="txtfecha">Fecha</label>
                <input class="form-control" type="date" name="fecha" id="txtfecha" value="{{ $fecha }}">
            </div>
            <div class="col-auto">
                <br>
                <button type="submit" class="btn-primary btn" style="background-color: transparent; border: none;">
                    <img src="{{ asset('images/lupa.png') }}" alt="Icono" style="height: 32px; margin-right: 10px;">
                </button>
            </div>
        </div>
    </form>

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
                    <td class="text-center">{{ $suministro->nombre }}</td>
                    <td class="text-end">{{ number_format($suministro->total_monto, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-end" colspan="2">TOTAL</td>
                <td class="text-end">${{ number_format(array_sum(array_column($suministros, "total_monto")), 2) }}</td>
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

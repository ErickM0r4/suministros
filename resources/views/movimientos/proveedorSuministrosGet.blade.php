@extends("components.layout")
@section("content")
    @component("components.breadcrumbs", ["breadcrumbs"=>$breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="form-group my-3">
                <h1>Suministros del proveedor</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card p-4">
            <div class="row">
                <div class="col-2">Proveedor:</div>
                <div class="col">{{ $proveedor->nombre }}</div>
            </div>
        </div>
    </div>
    <table class="table" id="maintable">
        <thead>
            <tr>
                <th scope="col">FOLIO</th>
                <th scope="col">MONTO</th>
                <th scope="col">FECHA</th>
                <th scope="col">SITUACIÓN ACTUAL</th>
                <th scope="col">DETALLES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suministros as $suministro)
            <tr>
                <td class="text-center">{{ $suministro->idSuministro}}</td>
                <td class="text-center">{{ $suministro->monto }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($suministro->fecha)->format('d/m/Y') }}</td>
                @if ($suministro->estado==1) 
                    <td class="text-center">Realizado</td>
                @else
                    <td class="text-center">Cancelado</td>
                @endif
                <td class="text-center">
                <button class="botonAcciones"><a class="acciones" href='{{url("/movimientos/{$suministro->idSuministro}/piezas")}}'>Detalles</a></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
    <script>
        // se crea la instancia de datatable en esos usos paginación y buscador
        let table = new DataTable("#maintable", {paging:true, searching:true});
    </script>
@endpush
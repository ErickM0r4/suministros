@extends("components.layout")
@section("content")
    @component("components.breadcrumbs", ["breadcrumbs"=>$breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="form-group my-3">
                <h1>Piezas del suministro {{ $suministro }}</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card p-4">
            <div class="row">
                <div class="col-2">Proveedor:</div>
                <div class="col">{{ $sum->nombre }}</div>
                <div class="col-2">Fecha:</div>
                <div class="col">{{ \Carbon\Carbon::parse($sum->fecha)->format('d/m/Y') }}</div>   
            </div>
        </div>
    </div>
    <table class="table" id="maintable">
        <thead>
            <tr>
                <th scope="col">CÓDIGO</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">CATEGORIA</th>
                <th scope="col">CANTIDAD</th>
                <th scope="col">PRECIO</th>
                <th scope="col">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($s_piezas as $s_pieza)
            <tr>
                <td class="text-center">{{ $s_pieza->idPieza}}</td>
                <td class="text-center">{{ $s_pieza->nombre}}</td>
                <td class="text-center">{{ $s_pieza->categoria}}</td>
                <td class="text-center">{{ $s_pieza->cantidad }}</td>
                <td class="text-center">{{ $s_pieza->precio}}</td>
                <td class="text-end">{{ number_format($s_pieza->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-end" colspan="5">TOTAL</td>
                <td class="text-end">{{ number_format($total, 2) }}</td>
            </tr>
        </tfoot>
        
    </table>
@endsection

@push('scripts')
    <script>
        // se crea la instancia de datatable en esos usos paginación y buscador
        let table = new DataTable("#maintable", {paging:true, searching:true});
    </script>
@endpush
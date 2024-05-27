@extends("components.layout")
@section("content")
    @component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
    @endcomponent
    <div class="row my-4">
        <div class="col">
            <h1>SUMINISTROS</h1>
        </div>
        <div class="col-auto titlebar-commands">
            <a class="btn btn-primary" href="{{url('/catalogos/suministros/agregar')}}" style="background-color: transparent; border: none;">
                <img src="{{ asset('images/agregar2.png') }}" alt="Icono" style="height: 50px; margin-right: 5px;">
                <b><p style="color: black">Agregar</p></b>
            </a>
        </div>
    </div>
    <div class="row my-4">
        <div class="col">
            <input type="text" id="searchProveedor" class="form-control" placeholder="Buscar por proveedor...">
        </div>
    </div>
    <table class="table" id="maintable"> 
        <thead> 
            <tr> 
                <th scope="col">FOLIO</th>
                <th scope="col">PROVEEDOR</th>
                <th scope="col">FECHA</th>
                <th scope="col">MONTO</th>
                <th scope="col">ESTADO</th>
                <th scope="col">DETALLES</th>
            </tr>
        </thead>
        <tbody> 
            @foreach($suministros as $suministro) 
                <tr>
                    <td class="text-center">{{$suministro->idSuministro}}</td>
                    <td class="text-center">{{$suministro->nombre}}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($suministro->fecha)->format('d/m/Y') }}</td>
                    <td class="text-center">{{$suministro->monto}}</td>
                    @if ($suministro->estado==1) 
                        <td class="text-center">Realizado</td>
                    @else
                        <td class="text-center">Pendiente</td>
                    @endif
                    <td class="text-center">
                        <button class="botonAcciones"><a style="text-decoration: none; color:#fff;" class="acciones" href='{{url("/movimientos/{$suministro->idSuministro}/piezas")}}'>Detalles</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
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

@extends("components.layout")
@section("content")
    @component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
    @endcomponent
    <div class="row my-4">
        <div class="col">
            <h1>PROVEEDORES</h1>
        </div>
        <div class="col-auto titlebar-commands">
            <a class="btn btn-primary" href="{{url('/catalogos/proveedores/agregar')}}" style="background-color: transparent; border: none;">
            <img src="{{ asset('images/agregar2.png') }}" alt="Icono" style="height: 50px; margin-right: 5px;">
            <b><p style="color: black" >Agregar</p></b>
            </a>
        </div>
    </div>
    <table class="table" id="maintable"> 
        <thead> 
            <tr> 
                <th scope="col">CÓDIGO</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">DIRECCION</th>
                <th scope="col" colspan="2">ACCIONES</th>
            </tr>
        </thead>
        <tbody> 
            @foreach($proveedores as $proveedor) 
                <tr>
                    <td class="text-center">{{$proveedor->idProveedor}}</td>
                    <td class="text-center">{{$proveedor->nombre}}</td>
                    <td class="text-center">{{$proveedor->direccion}}, {{$proveedor->numero}}, {{$proveedor->ciudad}}, {{$proveedor->provincia}}</td>
                    <td class="text-center"><button class="botonAcciones"><a style="text-decoration: none; color:#fff;" class="acciones" href='{{url("/proveedor/{$proveedor->idProveedor}/suministros")}}'>Suministros</a></button></td> <!-- enlace al histórico de Suministros-->
                    <td class="text-center"><button class="botonAcciones"><a style="text-decoration: none; color:#fff;" class="acciones" href='{{url("/proveedor/{$proveedor->idProveedor}/modificar")}}'>Modificar</a></button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
    let table = new DataTable("#maintable", {paging: true, searching: true});
    </script>
@endsection

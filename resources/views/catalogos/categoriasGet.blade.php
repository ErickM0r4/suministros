@extends("components.layout")
@section("content")
    @component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
    @endcomponent
    <div class="row my-4 align-items-center">
        <div class="col">
            <h1>CATEGORIAS</h1>
        </div>
        <div class="col-auto titlebar-commands d-flex justify-content-end gap-2">
            <a class="btn btn-primary" href="{{url('/catalogos/categorias/agregar')}}" style="background-color:transparent; border: none; margin-right: 30px;">
                <img src="{{ asset('images/agregar2.png') }}" alt="Icono" style="height: 50px; margin-right: 5px;">
                <b><p style="color: black">Agregar</p></b>
            </a>
            <button class="btn btn-secondary" data-toggle="modal" data-target="#inactiveCategoriasModal" style="background-color: #FF6600; color: white; margin-bottom: 45px; border:none; ">
                Ver Categorías Inactivas
            </button>
        </div>
    </div>
    <table class="table" id="maintable"> 
        <thead> 
            <tr> 
                <th scope="col">CÓDIGO</th>
                <th scope="col">CATEGORIA</th>
                <th scope="col" colspan="2">ACCIONES</th>
            </tr>
        </thead>
        <tbody> 
            @foreach($categoriasActivas as $categoria) 
                <tr>
                    <td class="text-center">{{$categoria->idCategoria}}</td>
                    <td class="text-center">{{$categoria->nombre}}</td>
                    <td class="text-center">
                        <button class="botonAcciones">
                            <a style="text-decoration: none; color:#fff; "class="acciones" href='{{ url("/catalogos/categorias/{$categoria->idCategoria}/modificar") }}'>Modificar</a>
                        </button>
                    </td>
                    <td>
                        <button style="color: #fff; padding:4px 9px;"  class="botonAcciones" onclick="confirmDesactivar({{ $categoria->idCategoria }})">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="inactiveCategoriasModal" tabindex="-1" role="dialog" aria-labelledby="inactiveCategoriasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inactiveCategoriasModalLabel">Categorías Inactivas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="inactiveTable">
                        <thead>
                            <tr>
                                <th scope="col">CÓDIGO</th>
                                <th scope="col">CATEGORIA</th>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categoriasInactivas as $categoria)
                                <tr>
                                    <td class="text-center">{{$categoria->idCategoria}}</td>
                                    <td class="text-center">{{$categoria->nombre}}</td>
                                    <td class="text-center">
                                        <button style="text-decoration: none; color:#fff;" class="botonAcciones" onclick="activarCategoria({{ $categoria->idCategoria }})">
                                            Activar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        // Inicializa DataTables para la tabla principal de categorías activas
        $('#maintable').DataTable({
            paging: true,
            searching: true
        });

        // Inicializa DataTables para la tabla de categorías inactivas en el modal
        $('#inactiveTable').DataTable({
            paging: true,
            searching: true
        });
    });

    function confirmDesactivar(id) {
        if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
            window.location.href = '/catalogos/categorias/' + id + '/desactivar';
        }
    }

    function activarCategoria(id) {
        window.location.href = '/catalogos/categorias/' + id + '/activar';
    }
    </script>
@endsection


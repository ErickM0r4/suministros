@extends("components.layout")
@section("content")
    @component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
    @endcomponent
    <div class="row my-4">
        <div class="col">
            <h1>PIEZAS</h1>
        </div>
        <div class="col-auto titlebar-commands">
            <a class="btn btn-primary" href="{{url('/catalogos/piezas/agregar')}}" style="background-color: transparent; border: none;">
                <img src="{{ asset('images/agregar2.png') }}" alt="Icono" style="height: 50px; margin-right: 5px;">
                <b><p style="color: black">Agregar</p></b>
            </a>
            <button class="btn btn-secondary" data-toggle="modal" data-target="#inactivePiezasModal" style="background-color: #FF6600; color: white; margin-bottom: 45px; border:none; ">
                Ver Piezas Inactivas
            </button>
        </div>
    </div>
    <table class="table" id="maintable"> 
        <thead> 
            <tr> 
                <th scope="col">CÓDIGO</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">COLOR</th>
                <th scope="col">PRECIO</th>
                <th scope="col">CATEGORIA</th>
                <th scope="col">MEDIDA</th>
                <th scope="col">STOCK</th>
                <th scope="col" colspan="2">ACCIONES</th>
            </tr>
        </thead>
        <tbody> 
            @foreach($piezasActivas as $pieza) 
                <tr>
                    <td class="text-center">{{$pieza->idPieza}}</td>
                    <td class="text-center">{{$pieza->nombre}}</td>
                    <td class="text-center">{{$pieza->color}}</td>
                    <td class="text-center">{{$pieza->precio}}</td>
                    <td class="text-center">{{$pieza->categoria}}</td>
                    <td class="text-center">{{$pieza->medida}}</td>
                    <td class="text-center">{{$pieza->stock}}</td>
                    <td class="text-center">
                        <button class="botonAcciones">
                            <a style="text-decoration: none; color:#fff;" class="acciones" href='{{ url("/catalogos/piezas/{$pieza->idPieza}/modificar") }}'>Modificar</a>
                        </button>
                        <button style="color: #fff; padding:4px 9px;"  class="botonAcciones" onclick="confirmDesactivar({{ $pieza->idPieza }})">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="inactivePiezasModal" tabindex="-1" role="dialog" aria-labelledby="inactivePiezasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inactivePiezasModalLabel">Piezas Inactivas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="inactiveTable">
                        <thead>
                            <tr>
                                <th scope="col">CÓDIGO</th>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">COLOR</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">CATEGORIA</th>
                                <th scope="col">MEDIDA</th>
                                <th scope="col">STOCK</th>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($piezasInactivas as $pieza)
                                <tr>
                                    <td class="text-center">{{$pieza->idPieza}}</td>
                                    <td class="text-center">{{$pieza->nombre}}</td>
                                    <td class="text-center">{{$pieza->color}}</td>
                                    <td class="text-center">{{$pieza->precio}}</td>
                                    <td class="text-center">{{$pieza->categoria}}</td>
                                    <td class="text-center">{{$pieza->medida}}</td>
                                    <td class="text-center">{{$pieza->stock}}</td>
                                    <td class="text-center">
                                        <button style="text-decoration: none; color:#fff;" class="botonAcciones" onclick="activarPieza({{ $pieza->idPieza }})">
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
    function confirmDesactivar(id) {
        if (confirm('¿Estás seguro de que deseas eliminar esta pieza?')) {
            window.location.href = '/catalogos/piezas/' + id + '/desactivar';
        }
    }

    function activarPieza(id) {
        window.location.href = '/catalogos/piezas/' + id + '/activar';
    }

    $(document).ready(function() {
        let table = $('#maintable').DataTable({
            paging: true,
            searching: true
        });
    });
    </script>

    <div class="text-center">
        <h1>Stock de piezas</h1>
        <div id="chart-container">Stock</div>
        <head>
            <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
            <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
            <script type="text/javascript">
                FusionCharts.ready(function(){
                    var chartObj = new FusionCharts({
                        type: 'column3d',
                        renderAt: 'chart-container',
                        width: '680',
                        height: '390',
                        dataFormat: 'json',
                        dataSource: {
                            "chart": {
                                "caption": "Stock de piezas",
                                "subCaption": "Mora Valk",
                                "xAxisName": "Nombre",
                                "yAxisName": "Cantidad",
                                "numberPrefix": "",
                                "theme": "Candy"
                            },
                            "data": [
                                @foreach($piezasActivas as $pieza)
                                {
                                    "label": "{{$pieza->nombre}}",
                                    "value": "{{$pieza->stock}}"
                                },
                                @endforeach
                            ],
                            "trendlines": [{
                                "line": [{
                                    "startvalue": "3",
                                    "valueOnRight": "1",
                                    "displayvalue": "Stock minimo"
                                }]
                            }]
                        }
                    });
                    chartObj.render();
                });
            </script>
        </head>
    </div>
@endsection

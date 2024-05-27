@extends("components.layout")

@section("content")
    @component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
    @endcomponent

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h1 class="text-center">Agregar piezas al suministro {{$idSuministro}}</h1>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-3"><strong>Proveedor:</strong> {{$suministro->nombre}}</div>
                            <div class="col-3"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($suministro->fecha)->format('d/m/Y') }}</div> 
                        </div>
                        <form method="post" action='{{url("/suministros/{$idSuministro}/agregar")}}'>
                            @csrf
                            <div class="form-group mb-3">
                                <label for="idPieza">Pieza</label>
                                <select class="form-select" name="idPieza" id="idPieza" required>
                                    @foreach($piezas as $pieza)
                                        <option value="{{$pieza->idPieza}}">{{$pieza->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" min="0" name="cantidad" id="cantidad" placeholder="Ingrese cantidad" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="precio">Costo</label>
                                <input type="number" min="0" name="precio" id="precio" placeholder="Ingrese el costo en MXN" class="form-control" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" style="background-color: transparent; border: none;">
                                    <img src="{{ asset('images/agregar2.png') }}" alt="Agregar" style="height: 50px;">
                                    <b><p style="color: black">Agregar</p></b>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="maintable"> 
                            <thead> 
                                <tr> 
                                    <th scope="col">PIEZA</th>
                                    <th scope="col">CANTIDAD</th>
                                    <th scope="col">PRECIO</th>
                                    <th scope="col">SUBTOTAL</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($sps as $sp) 
                                    <tr>
                                        <td class="text-center">{{$sp->nombre}}</td>
                                        <td class="text-center">{{$sp->cantidad}}</td>
                                        <td class="text-center">{{$sp->precio}}</td>
                                        <td class="text-end">{{$sp->subtotal}}</td>                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{url('/catalogos/suministros')}}" class="btn btn-primary" style="background-color: transparent; border: none;">
                        <img src="{{ asset('images/aceptar.png') }}" alt="Finalizar" style="height: 50px; margin-right: 5px;">
                        <b><p style="color: black">Finalizar</p></b>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
<style>
    .card {
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        padding: 0.75rem 1.25rem;
    }

    .card-body {
        padding: 1.25rem;
    }

    .form-control, .form-select {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
@endsection

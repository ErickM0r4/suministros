@extends("components.layout")

@section("content")
    @component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
    @endcomponent

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Agregar piezas</h1>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/catalogos/piezas/agregar') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre:</label>
                                <input type="text" maxlength="50" name="nombre" id="nombre" placeholder="Ingrese nombre de la pieza" class="form-control" required autofocus>
                            </div>
                            <div class="form-group mb-3">
                                <label for="color">Color</label>
                                <input type="text" name="color" id="color" class="form-control" required> <!-- Cambiado de type bool a text -->
                            </div>
                            <div class="form-group mb-3">
                                <label for="precio">Precio</label>
                                <input type="number" name="precio" id="precio" class="form-control" min="0" required> <!-- Cambiado de type bool a number -->
                            </div>
                            <div class="form-group mb-3">
                                <label for="idCategoria">Categoría</label>
                                <select class="form-select" name="idCategoria" id="idCategoria" required>
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->idCategoria}}">{{$categoria->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="medida">Medida</label>
                                <input type="text" name="medida" id="medida" class="form-control" required> <!-- Cambiado de type bool a text -->
                            </div>
                            <div class="form-group mb-3">
                                <label for="stock">Stock</label>
                                <input type="number" name="stock" id="stock" class="form-control" min="0" required> <!-- Cambiado de type bool a number -->
                            </div>
                            <div class="form-group mb-3">
                                <label for="estado">Estado</label>
                                <select class="form-select" name="estado" id="estado" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" style="background-color: transparent; border: none;">
                                    <img src="{{ asset('images/Guardar2.png') }}" alt="Guardar" style="height: 50px; margin-right: 5px;">
                                    <span style="color: black; vertical-align: super;"></span>
                                </button>
                            </div>
                        </form>
                    </div>
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

@extends('components.layout')

@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Modificar datos del proveedor</h1>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/proveedor/' . $proveedores->idProveedor . '/modificar') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $proveedores->nombre }}" autofocus>
                            </div>
                            <div class="form-group mb-3">
                                <label for="direccion">Dirección:</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $proveedores->direccion }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="num">Número:</label>
                                <input type="text" name="num" id="num" class="form-control" value="{{ $proveedores->numero }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="ciudad">Ciudad:</label>
                                <input type="text" name="ciudad" id="ciudad" class="form-control" value="{{ $proveedores->ciudad }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="provincia">Provincia:</label>
                                <input type="text" name="provincia" id="provincia" class="form-control" value="{{ $proveedores->provincia }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="estado">Estado</label>
                                <select class="form-select" name="estado" id="estado" required>
                                    <option value="1" {{ $proveedores->estado == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ $proveedores->estado == 0 ? 'selected' : '' }}>Inactivo</option>
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


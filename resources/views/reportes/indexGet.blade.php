@extends('components.layout')

@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row my-4">
        <div class="col">
            <h1>Reportes</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href='{{url("/reportes/suministros" )}}' class="btn-menu" style="background-color: #ff6347; display: block; text-align: center;"><h2 style="margin: 0;">Suministros por cierta fecha</h2></a>
            </div>
            <div class="col-md-4">
                <a href='{{url("/reportes/matriz-sumnistros")}}' class="btn-menu" style="background-color: #ff6347; display: block; text-align: center;"><h2 style="margin: 0;">Resumen de suministros</h2></a>
            </div>
        </div>
    </div>
@endsection
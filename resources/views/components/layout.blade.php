<!DOCTYPE html>
<html lang="en">
<head>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Importar librerías de Bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}" />
    <!-- Importar los archivos JavaScript de Bootstrap -->
    <script src="{{ URL::asset('bootstrap-5.3.2-dist/js/bootstrap.min.js') }}"></script>
    <!-- Importar librerías de estilos y JavaScript de DataTables -->
    <link href="{{ URL::asset('DataTables/DataTables-2.0.0/css/datatables.bootstrap.min.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('DataTables/DataTables-2.0.0/js/datatables.bootstrap.min.js') }}"></script>
    <link href="{{ URL::asset('assets/style.css') }}" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores Valkyrion</title>
    
    <style>
        .botonAcciones{
            Background-color: rgb(255, 99, 71);
            border-radius: 5px; 
            border:none; 
            transition: 0.4s; 
            text-decoration: none !important; 
        }
        .botonAcciones:hover{
            Background-color: #CC5500;
        }

        .acciones{
            text-decoration: none; 
            color: #fff; 
            font-size: 18px
        }

        .header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #ff6347;
        padding: 5px 20px;
        z-index: 999;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: 'Arial', sans-serif;
    } 

    .header .logo {
        color: #fff;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
    }

    .header .menu {
        display: flex;
        align-items: center;
    }

    .header .menu a {
        color: #fff;
        margin-right: 20px;
        padding: 8px 15px;
        text-decoration: none;
        border: 2px solid transparent;
        border-radius: 5px;
        transition: all 0.3s ease;
        font-family: 'Arial', sans-serif;
        box-shadow: 0px; /* Sombra suave permanente alrededor del botón */
        background-color: transparent; /* Fondo transparente por defecto */
        
    }

    .header .menu a:hover {
        background-color: rgba(0, 0, 0, 0.2); /* Fondo ligeramente naranja al hacer hover */
        color: #fff; /* Mantener el texto blanco al hacer hover */
        box-shadow: 0px 8px 10px rgba(255, 99, 71, 0.5); /* Sombra en tono naranja suave */
        text-decoration: none; /* Quitar subrayado */
    }   

    .breadcrumb {
        margin-top: 50px; /* Ajusta este valor según sea necesario */
    }

    .container2 {
        display: flex;
        justify-content: center;
    }
    
    body {
        padding-top: 60px; /* Asegurarse de que el contenido no queda oculto detrás de la barra superior */
    }
    </style>
</head>
<body>
    <!-- Header principal -->
    <div class="header">
        <a href="{{ url('/home') }}" class="logo">Proveedores Valkyrion</a>
        <div class="menu">
            <a href="{{ url('/catalogos/categorias') }}" class="nav-link"><b><p style="font-size: 18px">Categorías</p></b></a>
            <a href="{{ url('/catalogos/piezas') }}" class="nav-link"><b><p style="font-size: 18px">Piezas</p></b></a>
            <a href="{{ url('/catalogos/proveedores') }}" class="nav-link"><b><p style="font-size: 18px">Proveedores</p></b></a>
            <a href="{{ url('/catalogos/suministros') }}" class="nav-link"><b><p style="font-size: 18px">Suministros</p></b></a>
            <a href="{{ url('/reportes') }}" class="nav-link"><b><p style="font-size: 18px">Reportes</p></b></a>
            <a href="{{ url('/logout') }}" class="nav-link"><b><p style="font-size: 18px">Salir</p></b></a>
        </div>
    </div>

    <!-- Contenedor principal donde se muestra el contenido -->
    <div class="container">
        @section("content")
        @show
    </div>

    <!-- Aquí iría el pie de página si lo necesitas -->
</body>

</html>



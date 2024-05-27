@extends("components.layout")

@section("content")
    @component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
    @endcomponent

    <style>
        .content-center {
            text-align: center;
        }
        
        .main-title {
            font-size: 2.5em;
            color: #D32F2F;
            margin-top: 50px;
        }
        
        /* Modificado para que la imagen sea más grande y se adapte a la pantalla */
        .logo {
            width: 50%; /* Ajuste el porcentaje según sea necesario */
            max-width: 500px; /* Puedes aumentar este valor si quieres que la imagen sea más grande */
            height: auto;
            display: block;
            margin: 20px auto;
        }

    </style>

    <div class="content-center">
        <h1 class="main-title">¡Bienvenidos a Mora & Valk!</h1>
        <img src="\images\PiezaCompu.png" class="logo" alt="logo">
        <div class="row content-center">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <p class="text-justify">
                    "Tu lugar confiable de piezas tecnológicas para computadoras. 
                    En nuestra empresa, encontrarás una amplia selección de componentes de primera calidad para satisfacer todas tus necesidades informáticas. 
                    Desde procesadores hasta tarjetas gráficas, estamos aquí para proporcionarte las piezas que necesitas para potenciar tus equipos y proyectos. 
                    ¡Explora nuestro catálogo y descubre cómo podemos ayudarte a alcanzar tus metas tecnológicas!"
                </p>
            </div>
        </div>
    </div>
@endsection


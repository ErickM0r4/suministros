<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- MDB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css">
    <!-- Styles for gradient -->
    <style>
        .gradient-custom-2 {
            background: #fccb90;
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
            border-top-right-radius: .3rem;
            border-bottom-right-radius: .3rem;
        }
        @media (min-width: 768px) {
            .gradient-form { height: 100vh !important; }
        }
    </style>
</head>
<body>
<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="\images\LogoPC2.png"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Proveedores de Componentes Digitales Mora & Valk</h4>
                </div>

                <form method="POST" action="{{url('/register')}}">
                  @csrf
                  <p>Ingrese los siguientes datos para registrarse</p>
                  
                  <div class="form-outline mb-4">
                    <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese su nombre completo" required autocomplete="name" autofocus />
                    <label class="form-label" for="name">Nombre</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Ingrese una dirección de correo" required autocomplete="email" />
                    <label class="form-label" for="email">Correo Electrónico</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="password" class="form-control" placeholder="Escriba su contraseña" name="password" required autocomplete="new-password" />
                    <label class="form-label" for="password">Contraseña</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="password-confirm" class="form-control" placeholder="Escriba de nuevo su contraseña" name="password_confirmation" required autocomplete="new-password" />
                    <label class="form-label" for="password-confirm">Confirmar Contraseña</label>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">Registrarse</button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <!-- <p class="mb-0 me-2">¿Ya tienes una cuenta?</p>
                    <button type="button" class="btn btn-outline-danger">Iniciar Seción</button> -->
                    <div class="card-footer">
                        <small>¿Ya tienes una cuenta? <a href='{{url("/login")}}'>Inicia sesión aquí</a></small>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">¡Somos más que una empresa!</h4>
                <p class="small mb-0">"Somos los mejores distribuidores de piezas computacionales en todo México y Latinoamérica."</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>
</body>
</html>

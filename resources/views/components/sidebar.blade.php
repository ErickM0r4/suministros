<nav class=" sidebar nav flex-column pt-3">
    <a class="nav-link">@auth {{Auth::user()->name}} @endauth</a>
    <a href="{{url('/catalogos/categorias')}}" class="nav-link">Categorias</a>
    <a href="{{url('/catalogos/proveedores')}}" class="nav-link">Proveedores</a>
    <a href="{{url('/catalogos/suministros')}}" class="nav-link">Suministros</a>
    <a href="{{url('/catalogos/piezas')}}" class="nav-link">Piezas</a>
    <a href="{{url('/reportes')}}" class="nav-link">Reportes</a>
    <a href="{{url('/logout')}}" class="nav-link">Salir</a>
</nav>
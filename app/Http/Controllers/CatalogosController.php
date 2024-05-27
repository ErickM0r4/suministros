<?php
namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Pieza;
use App\Models\Suministro;
use App\Models\Suministro_pieza;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CatalogosController extends Controller
{
    //Funcion para mostrar la vista principal Home
    public function inicio():View
    {
        return view('home', ["breadcrumbs"=>[]]);
    }
    //login
    public function home():View
    {
        return view('login');
    }
     //Funcion para logear
     public function login(Request $request)
     {
        $credenciales=[
            "email" => $request->email,
            "password" => $request->password
        ];
        $remeber = ($request->has('remeber')? true : false);
        if(Auth::attempt($credenciales,$remeber)){
            $request->session();
            return redirect("/home");
        }else{
            return redirect("/");
        }
     }
    //Funcion para mostrar la salida
    public function logout(Request $request)
    {
        Auth::logout();
        $request ->session()->invalidate();
        $request -> session();
        return redirect("/");
    }
    //Funcion para registrarse
    public function registrar():View
    {
        return view('logon');
    }
    public function register(Request $request)
    {
       $user = new User();
       $user -> name = $request->name;
       $user -> email = $request->email;
       $user -> password = Hash::make($request->password);

       $user -> save();

       Auth::login($user);
       return redirect("/home");
    }
    //Funcion para mostrar las categorias
    public function categoriasGet(): View
    {
        $categoriasActivas = Categoria::where('estado', 1)->get();
        $categoriasInactivas = Categoria::where('estado', 0)->get();
        return view('catalogos/categoriasGet', [ //regresa la vista
            'categoriasActivas' => $categoriasActivas,
            'categoriasInactivas' => $categoriasInactivas,
            "breadcrumbs"=>[
                "Inicio"=>url("/home"),
                "Categorias"=>url("/catalogos/categorias")
            ]
        ]);
    }

    public function desactivarCat($id)
{
    $categoria = Categoria::find($id);
    $categoria->estado = 0;
    $categoria->save();
    return redirect('/catalogos/categorias');
}

public function activarCat($id)
{
    $categoria = Categoria::find($id);
    $categoria->estado = 1;
    $categoria->save();
    return redirect('/catalogos/categorias');
}


    //Funcion para mostrar los proveedores
    public function proveedoresGet(): View
    {
        $proveedores = Proveedor::all();//Variable con todo el contenido del modelo Proveedor
        return view('catalogos/proveedoresGet', [ //regresa la vista
            'proveedores' => $proveedores,
            "breadcrumbs"=>[
                "Inicio"=>url("/home"),
                "Proveedores"=>url("/catalogos/proveedores")
            ]
        ]);
    }
    //Funcion para mostrar los suministros
    public function suministrosGet(): View
    {
        $suministros = Suministro::join("proveedor","proveedor.idProveedor","=","suministro.idProveedor")
        ->select("suministro.*","proveedor.nombre as nombre")
        ->get();//Variable con todo el contenido del modelo Suministro

        return view('catalogos/suministrosGet', [ //regresa la vista
            'suministros' => $suministros,
            "breadcrumbs"=>[
                "Inicio"=>url("/home"),
                "Suministros"=>url("/catalogos/suministros")
            ]
        ]);
    }
    //Funcion para ir a la vista de agregar una nueva categoria
    public function categoriasAgregarGet(): View
    {
        return view('catalogos/categoriasAgregarGet',
            ["breadcrumbs"=>
                ["Inicio"=>url("/home"),
                "Categorias"=>url("/catalogos/categorias"),
                "Agregar"=>url("/catalogos/categorias/agregar")
                ]
            ]
        );
    }
    public function categoriasAgregarPost(Request $request)
    {
        $nombre=$request->input("nombre");
        $estado=$request->input("estado");
        $categoria=new Categoria([
        "nombre"=>strtoupper($nombre),
        "estado"=>$estado
        ]);
        $categoria->save();
        return redirect("/catalogos/categorias"); // redirige al listado de puestos
    }
    //Funcion para ir a la vista de agregar una nuevo proveedor
    public function proveedorAgregarGet(): View
    {
        return view('catalogos/proveedoresAgregarGet',
            ["breadcrumbs"=>
                ["Inicio"=>url("/home"),
                "Proveedores"=>url("/catalogos/proveedores"),
                "Agregar"=>url("/catalogos/proveedores/agregar")
                ]
            ]
        );
    }
    public function proveedorAgregarPost(Request $request)
    {
        $nombre=$request->input("nombre");
        $direccion=$request->input("direccion");
        $numero=$request->input("num");
        $ciudad=$request->input("ciudad");
        $provincia=$request->input("provincia");
        $estado=$request->input("estado");
        $proveedor=new Proveedor([
        "nombre"=>strtoupper($nombre),
        "direccion"=>strtoupper($direccion),
        "numero"=>$numero,
        "ciudad"=>strtoupper($ciudad),
        "provincia"=>strtoupper($provincia),
        "estado"=>$estado
        ]);
        $proveedor->save();
        return redirect("/catalogos/proveedores"); // redirige al listado de puestos
    }
    //Funcion para ir a la vista de agregar una nuevo suministro
    public function suministroAgregarGet(): View
    {
        $proveedores = Proveedor::All();
        return view('catalogos/suministrosAgregarGet',
            [
                'proveedores' => $proveedores,
                "breadcrumbs"=>
                ["Inicio"=>url("/home"),
                "Suministros"=>url("/catalogos/suministros"),
                "Agregar"=>url("/catalogos/suministros/agregar")
                ]
            ]
        );
    }
    public function suministroAgregarPost(Request $request)
    {
        $idProveedor=$request->input("idProveedor");
        $fecha=$request->input("fecha");
        #$monto=$request->input("monto");
        $estado=$request->input("estado");
        $suministro=new Suministro([
        "idProveedor"=>$idProveedor,
        "fecha"=>$fecha,
        "monto"=>0,
        "estado"=>$estado
        ]);
        $suministro->save();
        return redirect("/suministros/$suministro->idSuministro/agregar");
    }
    //Funcion para mostrar vista de agregar piezas
    public function spAgregarGet($idSuministro): View
    {
        $suministro = Suministro::join('proveedor','proveedor.idProveedor','=','suministro.idProveedor')
        ->select("suministro.*","proveedor.nombre as nombre")
        ->where('suministro.idSuministro',$idSuministro)
        ->get()
        ->first();
        $piezas = Pieza::All();
        $SP=Suministro_pieza::where("idSuministro",$idSuministro)
        ->join("pieza","pieza.idPieza","=","suministro_pieza.idPieza")
        ->select("suministro_pieza.*","pieza.nombre as nombre")
        ->get()
        ->all();
        return view('movimientos/AgregarPiezasGet',
            [
                'sps'=>$SP,
                'suministro'=>$suministro,
                'piezas' => $piezas,
                'idSuministro' => $idSuministro,
                "breadcrumbs"=>
                ["Inicio"=>url("/home"),
                "Suministros"=>url("/catalogos/suministros"),
                "Agregar Piezas"=>url("/suministros/agregar/piezas")
                ]
            ]
        );
    }
    //Funcion para agrega piezas a un suministro
    public function spAgregarPost(Request $request, $idSuministro): View
    {
        $suministro = Suministro::find($idSuministro);
        $cantidad = $request->input("cantidad");
        $precio = $request->input("precio");
        $montoI =  $suministro -> monto;
        $idPieza = $request->input("idPieza");
        $sumpieza = new Suministro_pieza([
            "idSuministro" => $idSuministro,
            "idPieza" => $idPieza,
            "cantidad" => $cantidad,
            "precio" => $precio,
            "subtotal" => $cantidad * $precio
        ]);
        $sumpieza -> save();
        $suministro-> monto =  $montoI + $sumpieza->subtotal;
        $suministro -> save();
        $pieza = Pieza::find($idPieza);
        $pieza -> stock = $pieza->stock + $cantidad;
        $pieza -> save();
        $piezas = Pieza::all();
        $suministro = $suministro::join('proveedor','proveedor.idProveedor','=','suministro.idProveedor')
        ->where('suministro.idSuministro',$idSuministro)
        ->select("suministro.*","proveedor.nombre as nombre")
        ->get()
        ->first();
        $SP=Suministro_pieza::where("idSuministro",$idSuministro)
        ->join("pieza","pieza.idPieza","=","suministro_pieza.idPieza")
        ->select("suministro_pieza.*","pieza.nombre as nombre")
        ->get()
        ->all();
        return view('movimientos/AgregarPiezasGet',
            [
                'sps'=>$SP,
                'suministro'=> $suministro,
                'piezas' => $piezas,
                'idSuministro' => $idSuministro,
                "breadcrumbs"=>
                ["Inicio"=>url("/home"),
                "Suministros"=>url("/catalogos/suministros"),
                "Agregar Piezas"=>url("/suministros/agregar/piezas")
                ]
            ]
        );
    }
    //Funcion para mostrar las piezas
    public function piezasGet(): View
    {
        $piezasActivas = Pieza::join("categoria","categoria.idCategoria","=","pieza.idCategoria")
        ->select("pieza.*","categoria.nombre as categoria")
        ->where('pieza.estado', 1)
        ->get();//Variable con todo el contenido del modelo Pieza
        $piezasInactivas = Pieza::join("categoria","categoria.idCategoria","=","pieza.idCategoria")
        ->select("pieza.*","categoria.nombre as categoria")
        ->where('pieza.estado', 0)
        ->get();
        return view('catalogos/piezasGet', [ //regresa la vista
            'piezasActivas' => $piezasActivas,
            'piezasInactivas' => $piezasInactivas,
            "breadcrumbs"=>[
                "Inicio"=>url("/home"),
                "Piezas"=>url("/catalogos/piezas")
            ]
        ]);
    }
    public function desactivar($id)
    {
        $pieza = Pieza::find($id);
        $pieza->estado = 0;
        $pieza->save();
        return redirect("/catalogos/piezas");
    }

    public function activar($id)
    {
        $pieza = Pieza::find($id);
        $pieza->estado = 1;
        $pieza->save();
        return redirect("/catalogos/piezas");
    }
   //Funcion para ir a la vista de agregar una nueva pieza
   public function piezasAgregarGet(): View
   {
        $categorias = Categoria::all();
        return view('catalogos/piezasAgregarGet',
            [
                "categorias"=>$categorias,
                "breadcrumbs"=>
                ["Inicio"=>url("/home"),
                "Piezas"=>url("/catalogos/piezas"),
                "Agregar"=>url("/catalogos/piezas/agregar")
                ]
            ]
        );
   }
   public function piezasAgregarPost(Request $request)
   {
        $nombre=$request->input("nombre");
        $color=$request->input("color");
        $precio=$request->input("precio");
        $idCategoria=$request->input("idCategoria");
        $medida=$request->input("medida");
        $stock=$request->input("stock");
        $estado=$request->input("estado");
        $pieza=new Pieza([
        "nombre"=>strtoupper($nombre),
        "color"=>strtoupper($color),
        "precio"=>$precio,
        "idCategoria"=>$idCategoria,
        "medida"=>strtoupper($medida),
        "stock"=>$stock,
        "estado"=>$estado
        ]);
        $pieza->save();
        return redirect("/catalogos/piezas"); // redirige al listado de piezas
    }
    //Funcion para traer las piezas suministradas por un proveedor
    public function proveedorSuministrosGet(Request $request, $idProveedor): View{
        $proveedor = Proveedor::find($idProveedor);
        $suministros = Suministro::where("suministro.idProveedor", $idProveedor)->get();
        return view('/movimientos/proveedorSuministrosGet', [
            'proveedor' => $proveedor,
            'suministros' => $suministros,
            'breadcrumbs' => [
                "Inicio" => url("/home"),            
                "Proveedores"=>url("/catalogos/proveedores"),
                "Suministros" => url("/movimientos/SuministrosGet")
            ]
        ]);
    }
    //Funcion para traer las piezas de un suministro
    public function suministroPiezasGet(Request $request, $idSuministro): View{
        #$piezas = Suministro_pieza::where("suministro_pieza.idSuministro", $idSuministro)->get();

        $piezas = Pieza::join("suministro_pieza","suministro_pieza.idPieza","=","pieza.idPieza")
        ->join("categoria","categoria.idCategoria","=","pieza.idCategoria")
        ->where("suministro_pieza.idSuministro", $idSuministro)
        ->select("pieza.nombre","suministro_pieza.*","categoria.nombre as categoria")
        ->get();
        $idProveedor= Suministro::join("proveedor","proveedor.idProveedor","=","suministro.idProveedor")
        ->where("suministro.idSuministro",$idSuministro)->first();
        $total = Suministro_pieza::where('idSuministro', $idSuministro)
            ->sum('subtotal');
        return view('/movimientos/suministroPiezasGet', [
            's_piezas' => $piezas,
            'suministro' => $idSuministro,
            'sum'=> $idProveedor,
            'total'=> $total,
            'breadcrumbs' => [
                "Inicio" => url("/home"),            
                "Proveedores"=>url("/catalogos/proveedores"),
                "Suministros" => url("/proveedor/$idProveedor->idProveedor/suministros"),
                "Piezas de suministro" => url("/movimientos/SuministrosGet")
            ]
        ]);
    }

    //FUNCIONES PARA MODIFICAR DATOS 

   //Función para modificar datos de las categorias 
   public function categoriasModificarGet(Request $request, $idCategoria): view 
   {
       $categoria = Categoria::find($idCategoria);
   
       return view('/catalogos/categoriasModificarGet',[
           "categoria" => $categoria,
           "breadcrumbs" => [
               "Inicio" => url("/home"),
               "Categoria" => url("/catalogos/categorias"),
               "Modificar" => url("/catalogos/categorias/{id}/modificar")
           ]
       ]);
   }
   
   public function categoriasModificarPost(Request $request, $idCategoria)
   {
       $categoria = Categoria::find($idCategoria);
   
       $categoria->nombre = strtoupper($request->input("nombre"));
       $categoria->estado = strtoupper($request->input("estado"));
   
       $categoria->save();
   
       return redirect("/catalogos/categorias");
   }
   

   //Función para modificar datos del proveedor
   public function proveedoresModificarGet(Request $request, $idProveedor): view 
{
    $proveedores = Proveedor::find($idProveedor);

    return view('/catalogos/proveedoresModificarGet',[
        "proveedores" => $proveedores,
        "breadcrumbs" => [
            "Inicio" => url("/home"),
            "Proveedores" => url("/catalogos/proveedores"),
            "Modificar" => url("/catalogos/proveedores/{id}/modificar")
        ]
    ]);
}

public function proveedoresModificarPost(Request $request, $idProveedor)
{
    $proveedores = Proveedor::find($idProveedor);

    $proveedores->nombre = strtoupper($request->input("nombre"));
    $proveedores->direccion = strtoupper($request->input("direccion"));
    $proveedores->numero = ($request->input("num"));
    $proveedores->ciudad = strtoupper($request->input("ciudad"));
    $proveedores->provincia = strtoupper($request->input("provincia"));
    $proveedores->estado = strtoupper($request->input("estado"));

    $proveedores->save();

    return redirect("/catalogos/proveedores");
}

 //Función para modificar datos de las piezas
 public function piezasModificarGet(Request $request, $idPieza): view 
 {
     $pieza = Pieza::find($idPieza);
 
     return view('/catalogos/piezasModificarGet',[
         "pieza" => $pieza,
         "breadcrumbs" => [
             "Inicio" => url("/home"),
             "Proveedores" => url("/catalogos/piezas"),
             "Modificar" => url("/catalogos/piezas/{id}/modificar")
         ]
     ]);
 }
 
 public function piezasModificarPost(Request $request, $idPieza)
 {
     $pieza = Pieza::find($idPieza);
 
     $pieza->nombre = strtoupper($request->input("nombre"));
     $pieza->color = strtoupper($request->input("color"));
     $pieza->precio = strtoupper($request->input("precio"));
     $pieza->medida = strtoupper($request->input("medida"));
 
     $pieza->save();
 
     return redirect("/catalogos/piezas");
 }

}
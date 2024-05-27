<?php
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\ReportesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Error
Route::view("login","login")->name("login");

//Login
Route::get('/',[CatalogosController::class, "home"]);
Route::post('/login',[CatalogosController::class, "login"]);

Route::get('/registrar',[CatalogosController::class, "registrar"]);
Route::post('/register',[CatalogosController::class, "register"]);

//Salir
Route::get('/logout',[CatalogosController::class, "logout"]);

Route::middleware('auth')->group(function () {
    //Rutas protegidas
    //home
    Route::get('/home',[CatalogosController::class, "inicio"]);
    //Categorias
    Route::get("/catalogos/categorias",[CatalogosController::class, "categoriasGet"]);
    Route::get("/catalogos/categorias/agregar",[CatalogosController::class, "categoriasAgregarGet"]);
    Route::post("/catalogos/categorias/agregar",[CatalogosController::class, "categoriasAgregarPost"]);
    //Proveedores
    Route::get("/catalogos/proveedores",[CatalogosController::class, "proveedoresGet"]);
    Route::get("/catalogos/proveedores/agregar",[CatalogosController::class, "proveedorAgregarGet"]);
    Route::post("/catalogos/proveedores/agregar",[CatalogosController::class, "proveedorAgregarPost"]);
    //Suministros
    Route::get("/catalogos/suministros",[CatalogosController::class, "suministrosGet"]);
    Route::get("/catalogos/suministros/agregar",[CatalogosController::class, "suministroAgregarGet"]);
    Route::post("/catalogos/suministros/agregar",[CatalogosController::class, "suministroAgregarPost"]);
    //Agregarle piezas al suministro
    Route::get("/suministros/{id}/agregar",[CatalogosController::class, "spAgregarGet"])->where("id", "[0-9]+");
    Route::post("/suministros/{id}/agregar",[CatalogosController::class, "spAgregarPost"])->where("id", "[0-9]+");

    //Piezas
    Route::get("/catalogos/piezas",[CatalogosController::class, "piezasGet"]);
    Route::get("/catalogos/piezas/agregar",[CatalogosController::class, "piezasAgregarGet"]);
    Route::post("/catalogos/piezas/agregar",[CatalogosController::class, "piezasAgregarPost"]);
    Route::get('/catalogos/piezas/{id}/desactivar', [CatalogosController::class, 'desactivar']);
    Route::get('/catalogos/piezas/{id}/activar', [CatalogosController::class, 'activar']);

    //Cambiar datos de las Categorias 
    Route::get("/catalogos/categorias/{id}/modificar",[CatalogosController::class, "categoriasModificarGet"])->where("id", "[0-9]+");
    Route::post("/catalogos/categorias/{id}/modificar",[CatalogosController::class, "categoriasModificarPost"])->where("id", "[0-9]+");
    Route::get('/catalogos/categorias/{id}/desactivar', [CatalogosController::class, 'desactivarCat']);
    Route::get('/catalogos/categorias/{id}/activar', [CatalogosController::class, 'activarCat']);

    //Cambiar datos Proveedores
    Route::get("/proveedor/{id}/modificar", [CatalogosController::class, "proveedoresModificarGet"])->where("id", "[0-9]+");
    Route::post("/proveedor/{id}/modificar", [CatalogosController::class, "proveedoresModificarPost"])->where("id", "[0-9]+");

    //Cambiar datos de las Piezas
    Route::get("catalogos/piezas/{id}/modificar", [CatalogosController::class, "piezasModificarGet"])->where("id", "[0-9]+");
    Route::post("catalogos/piezas/{id}/modificar", [CatalogosController::class, "piezasModificarPost"])->where("id", "[0-9]+");

    //Suministros de un proveedor
    Route::get("/proveedor/{id}/suministros",[CatalogosController::class,"proveedorSuministrosGet"])->where("id","[0-9]+");
    //Piezas de un suministro
    Route::get("/movimientos/{id}/piezas",[CatalogosController::class,"suministroPiezasGet"])->where("id","[0-9]+");

    //Rutas para los Reportes
    Route::get("/reportes",[ReportesController::class,"indexGet"]);
    Route::get("reportes/suministros",[ReportesController::class,"suministrosGet"]);

    //Matriz de abonos
    Route::get("/reportes/matriz-sumnistros",[ReportesController::class,"matrizSuministrosGet"]);

    //Generar PDF
    Route::get("pdf/download",[ReportesController::class,"download"]);
    Route::get("pdf/open",[ReportesController::class,"openPDF"]);
    //de matriz
    Route::get("pdfm/download",[ReportesController::class,"downloadPDFM"]);
    Route::get("pdfm/open",[ReportesController::class,"openPDFMatriz"]);

    //Grafica
    Route::get("/reportes/grafica",[ReportesController::class,"grafica"]);

});


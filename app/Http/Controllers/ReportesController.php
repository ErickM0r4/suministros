<?php
namespace App\Http\Controllers;
use App\Models\Proveedor;
use App\Models\Suministro;
use DateTime;
use Illuminate\Http\Request;
use Francerz\PowerData\Index;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Pieza;

class ReportesController extends Controller
{
    public function indexGet(Request $request){
        return view("reportes.indexGet",[
            "breadcrumbs"=>[
                "Inicio"=>url("/home"),
                "Reportes"=>url("/reportes/prestamos-activos")
            ]
        ]);
    }
    public function matrizSuministrosGet(Request $request) {
        $fecha_inicio=Carbon::now()->format("Y-01-01"); //Inicializamos la variable Fecha inicio con 1/01/año actual
        $fecha_inicio=$request->query("fecha_inicio", $fecha_inicio);//Intentamos obtener fecha_inicio proporcionada por el usuario
        $fecha_fin=Carbon::now()->format("Y-12-31"); //Inicializamos la variable Fecha fin con 31/12/año actual
        $fecha_fin=$request->query("fecha_fin", $fecha_fin);//Intentamos obtener fecha_fin proporcionada por el usuario
        //union del abono con el prestamo mediante el id_prestamo y union con empleado mediante id_empleado
        $query=Suministro::join("proveedor", "proveedor.idProveedor", "=", "suministro.idProveedor")
                     ->select("suministro.idSuministro", "proveedor.nombre", "suministro.monto", "suministro.fecha")
                     ->orderBy("suministro.fecha"); //Ordena los resultados por la fecha del abono en orden ascendente
        $query->where("suministro.fecha", ">=", $fecha_inicio); //Se filtran los resulados entre fecha inicio
        $query->where("suministro.fecha", "<=", $fecha_fin); //y fecha_fin
        $suministros=$query->get()->toArray();//Ejecuta la consulta y convierte los resultados en un array.
        
        foreach ($suministros as $suministro) {
            $suministro["fecha"] = (new DateTime($suministro["fecha"]))->format("Y-m"); //Modificamos el formato de fecha a solo mes y año
        }
        $suministrosIndex=new Index($suministros, ["idSuministro", "fecha"]);//Crea una matriz de abonos, id_prestamo: filas y fecha: columnas
        return view("reportes/matrizSuministrosGet", [
            "suministrosIndex"=>$suministrosIndex,
            "fecha_inicio"=>$fecha_inicio,
            "fecha_fin"=>$fecha_fin,
            "breadcrumbs"=>[
                "Inicio" => url("/home"),
                "Reportes" => url("/reportes"),
                "Matriz" => url("/reportes/matriz")
            ]
        ]);
    }

    public function suministrosGet(Request $request) {
        $fecha = Carbon::now()->format("Y-m-d"); //Fecha en formato texto
        $fecha = $request->query("fecha", $fecha);
        $suministros = Proveedor::join('suministro', 'proveedor.idProveedor', '=', 'suministro.idProveedor')
                        ->select('suministro.idSuministro', 'proveedor.nombre', DB::raw('SUM(suministro.monto) as total_monto'))
                        ->where('suministro.fecha', '<=', $fecha)
                        ->groupBy('proveedor.nombre', 'suministro.idSuministro')
                        ->get()->all();
        // return view con los datos obtenidos
        return view("reportes/suministrosGet", [
            "fecha" => $fecha,
            "suministros" => $suministros,
            "breadcrumbs" => [
                "Inicio" => url("/home"),
                "Reportes" => url("/reportes"),
                "Resumen" => url("/reportes/resumen")
            ]
        ]);
    }

    public function download(request $request)
    {
        $fecha = Carbon::now()->format("Y-m-d"); //Fecha en formato texto
        $fecha = $request->query("fecha", $fecha);
        $suministros = Proveedor::join('suministro', 'proveedor.idProveedor', '=', 'suministro.idProveedor')
            ->select('suministro.idSuministro', 'proveedor.nombre', DB::raw('SUM(suministro.monto) as total_monto'))
            ->where('suministro.fecha', '<=', $fecha)
            ->groupBy('proveedor.nombre', 'suministro.idSuministro')
            ->get()->all();
        $data = [
            'fecha'=>$fecha,
            'titulo' => 'MoraValk.com',
            "suministros" => $suministros,
        ];
        $pdf = \PDF::loadView('reportes/rpdf',
        $data);
    
        return $pdf->download('resumen.pdf');
    }

    public function openPDF(request $request){
        $fecha = Carbon::now()->format("Y-m-d"); //Fecha en formato texto
        $fecha = $request->query("fecha", $fecha);
        $suministros = Proveedor::join('suministro', 'proveedor.idProveedor', '=', 'suministro.idProveedor')
            ->select('suministro.idSuministro', 'proveedor.nombre', DB::raw('SUM(suministro.monto) as total_monto'))
            ->where('suministro.fecha', '<=', $fecha)
            ->groupBy('proveedor.nombre', 'suministro.idSuministro')
            ->get()->all();
        $data = [
            "fecha" => $fecha,
            "suministros" => $suministros,
        ];
        // Crear una instancia de Dompdf
        $pdf = new Dompdf();

        // Cargar la vista en Dompdf
        $pdf= \PDF::loadView('reportes/rpdf', $data);

        // Renderizar el PDF
        $pdf->render();

        // Obtener el contenido del PDF como una cadena
        $pdfContent = $pdf->output();

        // Devolver el PDF como una respuesta con el tipo de contenido adecuado
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="resumen.pdf"');
    }

    //Para pdf de matriz
    public function openPDFMatriz(request $request){
        $fecha_inicio=Carbon::now()->format("Y-01-01"); //Inicializamos la variable Fecha inicio con 1/01/año actual
        $fecha_inicio=$request->query("fecha_inicio", $fecha_inicio);//Intentamos obtener fecha_inicio proporcionada por el usuario
        $fecha_fin=Carbon::now()->format("Y-12-31"); //Inicializamos la variable Fecha fin con 31/12/año actual
        $fecha_fin=$request->query("fecha_fin", $fecha_fin);//Intentamos obtener fecha_fin proporcionada por el usuario
        //union del abono con el prestamo mediante el id_prestamo y union con empleado mediante id_empleado
        $query=Suministro::join("proveedor", "proveedor.idProveedor", "=", "suministro.idProveedor")
                     ->select("suministro.idSuministro", "proveedor.nombre", "suministro.monto", "suministro.fecha")
                     ->orderBy("suministro.fecha"); //Ordena los resultados por la fecha del abono en orden ascendente
        $query->where("suministro.fecha", ">=", $fecha_inicio); //Se filtran los resulados entre fecha inicio
        $query->where("suministro.fecha", "<=", $fecha_fin); //y fecha_fin
        $suministros=$query->get()->toArray();//Ejecuta la consulta y convierte los resultados en un array.
        
        foreach ($suministros as $suministro) {
            $suministro["fecha"] = (new DateTime($suministro["fecha"]))->format("Y"); //Modificamos el formato de fecha a solo mes y año
        }
        $suministrosIndex=new Index($suministros, ["idSuministro", "fecha"]);
        $data = [
            "suministrosIndex"=>$suministrosIndex,
            "fecha_inicio"=>$fecha_inicio,
            "fecha_fin"=>$fecha_fin,
        ];
        $pdf = new Dompdf();
        $pdf= \PDF::loadView('reportes/r2pdf', $data)
        ->setPaper('a4', 'landscape');
        $pdf->render();
        $pdfContent = $pdf->output();
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="matriz.pdf"');
    }

    public function downloadPDFM(request $request)
    {
        $fecha_inicio=Carbon::now()->format("Y-01-01"); //Inicializamos la variable Fecha inicio con 1/01/año actual
        $fecha_inicio=$request->query("fecha_inicio", $fecha_inicio);//Intentamos obtener fecha_inicio proporcionada por el usuario
        $fecha_fin=Carbon::now()->format("Y-12-31"); //Inicializamos la variable Fecha fin con 31/12/año actual
        $fecha_fin=$request->query("fecha_fin", $fecha_fin);//Intentamos obtener fecha_fin proporcionada por el usuario
        //union del abono con el prestamo mediante el id_prestamo y union con empleado mediante id_empleado
        $query=Suministro::join("proveedor", "proveedor.idProveedor", "=", "suministro.idProveedor")
                     ->select("suministro.idSuministro", "proveedor.nombre", "suministro.monto", "suministro.fecha")
                     ->orderBy("suministro.fecha"); //Ordena los resultados por la fecha del abono en orden ascendente
        $query->where("suministro.fecha", ">=", $fecha_inicio); //Se filtran los resulados entre fecha inicio
        $query->where("suministro.fecha", "<=", $fecha_fin); //y fecha_fin
        $suministros=$query->get()->toArray();//Ejecuta la consulta y convierte los resultados en un array.
        
        foreach ($suministros as $suministro) {
            $suministro["fecha"] = (new DateTime($suministro["fecha"]))->format("Y"); //Modificamos el formato de fecha a solo mes y año
        }
        $suministrosIndex=new Index($suministros, ["idSuministro", "fecha"]);
        $data = [
            "suministrosIndex"=>$suministrosIndex,
            "fecha_inicio"=>$fecha_inicio,
            "fecha_fin"=>$fecha_fin,
        ];
        $pdf = new Dompdf();
        $pdf= \PDF::loadView('reportes/r2pdf', $data)
        ->setPaper('a4', 'landscape');
    
        return $pdf->download('matriz.pdf');
    }
    public function grafica(request $request)
    {
        $piezas = Pieza::join("categoria","categoria.idCategoria","=","pieza.idCategoria")
        ->select("pieza.*","categoria.nombre as categoria")
        ->get();//Variable con todo el contenido del modelo Pieza
        return view("reportes/grafica",
            ['piezas' => $piezas]
        );
    }
}
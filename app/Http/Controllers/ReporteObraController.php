<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Club;
use App\Obra;
use App\Http\Requests\ObraFormRequest;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use DateTime;

class ReporteObraController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $obras=DB::table('ofj_obra_actuada')->where('titulo','LIKE',strtoupper($query).'%')
            ->paginate(5);
            return view('Reportes.obra', ["obra" =>$obras , "searchText"=>$query]); // Retornar todo sobre la tabla club y la muestra en la pantalla conrespondiente 
        }
    }

    public function pre_reporte9($cod)
    {
            return view('Reportes.Reporte9.pre_reporte9',["cod" =>$cod]);
    }
    
    public function reporte9(Request $request, $cod)
    {
        $obras=DB::select(DB::raw("SELECT DISTINCT INITCAP(o.titulo) AS titulo
                                  FROM ofj_obra_actuada o WHERE o.cod='$cod';"));
        $fechaini= new DateTime($request->fecha_ini);
        $fechainicio=$fechaini->format('d-F-Y');
        $fechafin= new DateTime($request->fecha_fin);
        $fechafinal=$fechafin->format('d-F-Y');
        $fechai=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_ini)));
        $fechaf=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_fin)));;
        $fechaini=DateTime::createFromFormat('j-M-Y', $request->fecha_ini);
        $fechafin=DateTime::createFromFormat('j-M-Y', $request->fecha_fin);
        var_dump($fechaini);
        $presentaciones=DB::select("SELECT   TO_CHAR(AVG(g.valoracion),'9.9') AS valoracion_global, c.valoracion AS valoracion_obra, 
                                            INITCAP(l.nombre1) AS nombre, INITCAP(l.apellido1) AS apellido 
                                    FROM ofj_obra_actuada o, ofj_mejor_actor m, ofj_lector l,ofj_calendario c,
                                        (SELECT c.id_obra AS id_obra,c.valoracion AS valoracion FROM ofj_calendario c) AS g
                                    WHERE o.cod='$cod' AND l.docidentidad=m.doc_lector_hist_elenco AND m.fecha_cal=c.fecha AND 
                                          c.valoracion IS NOT NULL AND g.id_obra='$cod' AND g.id_obra=m.id_obra_cal AND c.fecha BETWEEN '$fechai' AND '$fechaf'
                                    GROUP BY o.titulo,valoracion_obra,nombre,apellido
                                    ORDER BY o.titulo;");

        if($presentaciones){
            $pdf=PDF::loadview('Reportes.Reporte9.reporte9',compact('presentaciones','cod','fechainicio','fechafinal','obras'));
            return $pdf->stream();
        }else{
            return Redirect::to('/reportesObra')->with('error','No hay información disponible para el club');

        }
    }

}
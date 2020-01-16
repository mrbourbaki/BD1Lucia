<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Club;
use App\Http\Requests\ClubFormRequest;
use Barryvdh\DomPDF\Facade as PDF;
use Datetime;
use Redirect;
use DB;
class ReporteClubController extends Controller
{
    public function pre_index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $clubes=DB::table('ofj_club')->where('nombre','LIKE',strtoupper($query).'%')
            ->paginate(5);
            return view('Reportes.club', ["clubes" =>$clubes , "searchText"=>$query]); // Retornar todo sobre la tabla club y la muestra en la pantalla conrespondiente 
        }
    }

    public function pre_reporte3($cod)
    {
        return view("Reportes.Reporte3.prereporte3",["cod"=>$cod]);  
    }

    public function reporte3(Request $request, $cod){
        $club=DB::select(DB::raw("SELECT INITCAP(c.nombre) AS nombre, c.cod AS cod FROM ofj_club c
                                  WHERE c.cod='$cod'"));
        $fechaini= new DateTime($request->fecha_ini);
        $fechainicio=$fechaini->format('d-F-Y');
        $fechafin= new DateTime($request->fecha_fin);
        $fechafinal=$fechafin->format('d-F-Y');
        $fechai=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_ini)));
        $fechaf=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_fin)));
        $obras=DB::select("SELECT DISTINCT  TO_CHAR(AVG(a.valoracion),'9.9')  AS valoracion, INITCAP(l.titulo_original) AS nombre_libro
        FROM ofj_reunion a, ofj_libro l, ofj_club c 
        WHERE a.id_libro=l.cod AND c.cod=a.id_club_grupo AND c.cod='$cod' AND a.fecha BETWEEN '$fechai' AND '$fechaf'
        GROUP BY  a.id_libro, l.titulo_original
        ORDER BY   valoracion desc");
        if($obras){
            $pdf = PDF::loadView('Reportes.Reporte3.reporte3',compact('obras','club','fechainicio','fechafinal'));
            return $pdf->stream();
        }
        else {
            return Redirect::to('/reportesClub')->with(['msg','No hay información disponible para el club']);
        }
    }

    public function pre_reporte4($cod)
    {
        return view("Reportes.Reporte4.pre_reporte4",["cod"=>$cod]);  
    }

    public function reporte4 (Request $request,$cod)
    {
        $club=DB::select(DB::raw("SELECT INITCAP(c.nombre) AS nombre, c.cod AS cod FROM ofj_club c
                                  WHERE c.cod='$cod'"));
        $fecha=$request->input("fecha");
        $fecha_explode = explode('|',$fecha);
        $fechai=$fecha_explode[0];
        $fechaf=$fecha_explode[1];
        $fechaini= new DateTime($fechai);
        $fechainicio=$fechaini->format('d-F-Y');
        $fechafin= new DateTime($request->fechaf);
        $fechafinal=$fechafin->format('d-F-Y');
        $inasistencias=DB::select(DB::raw(("SELECT  INITCAP(s.Nombre_lector) AS Nombre, INITCAP(s.Apellido_Lector) AS Apellido, ROUND((s.Inasistencias::DECIMAL/s.Cantidad_reuniones)*100)||'%' AS porcentaje
                                   FROM (SELECT COUNT(l.docidentidad) AS Inasistencias,l.nombre1 AS Nombre_lector, l.apellido1 AS Apellido_lector, c.cantidad AS Cantidad_Reuniones
                                         FROM ofj_reunion r, ofj_inasistencia i, ofj_lector l, ofj_grupo_lectura g,(SELECT COUNT(r.id_grupo)  AS cantidad, r.id_club_grupo AS grupo FROM ofj_reunion r, ofj_grupo_lectura g WHERE g.cod=r.id_grupo AND r.fecha BETWEEN '$fechainicio' AND '$fechafinal'  GROUP BY g.cod,grupo) c
                                         WHERE i.id_reunion=r.cod AND l.docidentidad=i.doc_lector AND g.cod=r.id_grupo AND g.cod=c.grupo AND g.id_club='$cod'
                                         GROUP BY   l.nombre1, l.apellido1, c.cantidad) s
                                   WHERE (s.Inasistencias::DECIMAL/s.Cantidad_reuniones) >= 0.30
                                   GROUP BY s.Nombre_lector, s.Apellido_lector, porcentaje;")));
        $pdf = PDF::loadView('Reportes.Reporte4.reporte4',compact('inasistencias','club'));
        return $pdf->stream();
    }

    public function pre_reporte11($cod)
    {
        return view("Reportes.Reporte11.pre_reporte11",["cod"=>$cod]);  
    }
    
    public function reporte11(Request $request, $cod)
    {
        $club=DB::select(DB::raw("SELECT INITCAP(c.nombre) AS nombre, c.cod AS cod FROM ofj_club c
                                  WHERE c.cod='$cod'"));
        $fechaini= new DateTime($request->fecha_ini);
        $fechainicio=$fechaini->format('d-F-Y');
        $fechafin= new DateTime($request->fecha_fin);
        $fechafinal=$fechafin->format('d-F-Y');
        $fechai=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_ini)));
        $fechaf=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_fin)));   
        $obras=DB::select("SELECT INITCAP(o.titulo) AS titulo, SUM(c.cantidad_asistencia*o.precio)||'$' AS ganancias, TO_CHAR(AVG(c.valoracion),'9') AS Valoración
                           FROM ofj_obra_actuada o, ofj_calendario c, ofj_cal_club cc
                           WHERE o.cod=c.id_obra  AND cc.id_club='$cod' AND c.id_obra=cc.id_obra AND cc.fecha_cal=c.fecha AND cc.fecha_cal BETWEEN '$fechai' AND '$fechaf'
                           GROUP BY titulo;");                 
        $pdf = PDF::loadView('Reportes.Reporte11.reporte11',compact('obras','club','fechainicio','fechafinal'));
        return $pdf->stream();
    }
}


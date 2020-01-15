<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Club;
use App\Http\Requests\ClubFormRequest;
use Barryvdh\DomPDF\Facade as PDF;


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
    public function reporte3($codigo){
        $club=Club::findOrFail($codigo);
        $obras=DB::select("SELECT DISTINCT  TO_CHAR(AVG(a.valoracion),'9.9')  AS valoracion, INITCAP(l.titulo_original) AS nombre_libro
        FROM ofj_reunion a, ofj_libro l, ofj_club c 
        WHERE a.id_libro=l.cod AND c.cod=a.id_club_grupo AND c.cod=?
        GROUP BY  a.id_libro, l.titulo_original
        ORDER BY   valoracion desc"
        , [$codigo]);
        $pdf = PDF::loadView('Reportes.reporte3',compact('obras','club'));
        return $pdf->stream();
    }

    public function pre_reporte4($codigo)
    {
        return view("Reportes.Reporte4.pre_reporte4",["codigo"=>$codigo]);  
    }

    public function index(Request $request,$codigo)
    {
        $fecha=$request->input("fecha");
        $fecha_explode = explode('|',$fecha);
        $report = new Inasistencias (array(
            "club"=>$codigo,
            "fecha_inicio"=>$fecha_explode[0],
            "fecha_fin"=>$fecha_explode[1]
        ));
        $report->run();
        return view("Reportes.Reporte4.reporte4",["report"=>$report]);
    }
    public function __contruct()
    {
        $this->middleware("guest");
    }
}

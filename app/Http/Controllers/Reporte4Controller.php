<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Club;
use App\Http\Requests\ClubFormRequest;
use App\Reportes\Reporte4\Inasistencias;
use DB;
class Reporte4Controller extends Controller
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
    public function pre_reporte4($codigo)
    {

        return view("Reportes.Reporte4.pre_reporte4",["codigo"=>$codigo]);  
    }
    public function __contruct()
    {
        $this->middleware("guest");
    }
    public function index(Request $request,$codigo)
    {
        $fecha=$request->fecha;
        $fecha_explode = explode('|',$fecha);
        $report = new Inasistencias (array(
            "club"=>$codigo,
            "fecha_inicio"=>$fecha_explode[0],
            "fecha_fin"=>$fecha_explode[1]
        ));
        $report->run();
        return view("Reportes.Reporte4.reporte4",["report"=>$report]);
    }
}

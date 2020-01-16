<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Lector;
use App\Club;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\ClubFormRequest;
use DB;
use Redirect;


class ReporteMiembroController extends Controller
{
    public function pre_index()
    {
     $lectores=DB::select(DB::raw("SELECT INITCAP(l.nombre1) AS nombre1, INITCAP(l.apellido1) AS apellido1, l.docidentidad AS docidentidad FROM ofj_lector l"));

     return view('Reportes.miembro', ["lectores" =>$lectores]);

    }
    public function pre_reporte2pagos($docid)
    {
     $clubes=DB::select(DB::raw("SELECT INITCAP(c.nombre) AS nombre,  c.cod AS cod FROM ofj_club c"));
     return view('Reportes.Reporte2.prereporte2pagos', ["docid" =>$docid,"clubes"=>$clubes]);

    }
    public function reporte2pagos(Request $request ,$docid)
    {  
    $fechai=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_ini)));
    $fechaf=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_fin)));
    var_dump($fechai);
    $club=DB::select(DB::raw("SELECT INITCAP(c.nombre) AS nombre, c.cod AS cod FROM ofj_club c
                              WHERE c.cod='$request->id_club'"));
    $lector=DB::select(DB::raw("SELECT INITCAP(l.nombre1) AS nombre, INITCAP(l.apellido1) AS apellido,
                                l.docidentidad AS docidentidad
                                FROM ofj_lector l
                                WHERE l.docidentidad='$docid'"));
    $pagos=DB::select(DB::raw("SELECT p.cod AS numero_pago, TO_CHAR(p.fecha_pago,'DD,MON,YYYY') AS fecha_pago, INITCAP(p.tipo_pago) AS tipo_pago 	
                                FROM ofj_pago p, ofj_lector l   
                                WHERE p.id_club_hist_lector='$request->id_club' AND p.doc_lector_hist_lector='$docid' AND l.docidentidad='$docid' AND p.fecha_pago BETWEEN '$fechai' AND '$fechaf'
                                ORDER BY numero_pago;"));
    $pdf = PDF::loadView('Reportes.Reporte2.reporte2pagos',compact('lector','pagos','club'));
    return $pdf->stream();
    }

    public function pre_reporte2asistencias($docid)
    {   
     $clubes=DB::select(DB::raw("SELECT INITCAP(c.nombre) AS nombre,  c.cod AS cod FROM ofj_club c"));
     return view('Reportes.Reporte2.prereporte2asistencias', ["docid" =>$docid,"clubes"=>$clubes]);
    }

    public function reporte2asistencias(Request $request, $docid)
    { 
    $fechai=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_ini)));
    $fechaf=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_fin)));      
    $club=DB::select(DB::raw("SELECT INITCAP(c.nombre) AS nombre, c.cod AS cod FROM ofj_club c
                              WHERE c.cod= '$request->id_club'"));
    $lector=DB::select(DB::raw("SELECT INITCAP(l.nombre1) AS nombre, INITCAP(l.apellido1) AS apellido,
                                l.docidentidad AS docidentidad
                                FROM ofj_lector l
                                WHERE l.docidentidad='$docid'"));
    $asistencias=DB::select(DB::raw("SELECT DISTINCT r.cod AS id_reunion , r.fecha AS fecha_reunion
                                FROM ofj_reunion r, ofj_inasistencia i, ofj_lector l, ofj_hist_grupo h, ofj_grupo_lectura g
                                WHERE h.doc_lector_hist_lector='$docid'  AND h.id_grupo=r.id_grupo AND r.id_club_grupo='$cod' AND p.fecha_pago BETWEEN '$fechai' AND '$fechaf' AND NOT EXISTS(SELECT * FROM ofj_inasistencia i
                                                                                                                                                                                               WHERE i.id_reunion=r.cod AND i.doc_lector='$docid')
                                ORDER BY id_reunion ASC;"));
    $pdf = PDF::loadView('Reportes.Reporte2.reporte2asistencias',compact('lector','club','asistencias'));
    return $pdf->stream();
    }

    public function pre_reporte2grupos($docid)
    {   
     $clubes=DB::select(DB::raw("SELECT INITCAP(c.nombre) AS nombre,  c.cod AS cod FROM ofj_club c"));
     return view('Reportes.Reporte2.prereporte2grupos', ["docid" =>$docid,"clubes"=>$clubes]);
    }

    public function reporte2grupos(Request $request ,$docid){

    $fechai=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_ini)));
    $fechaf=date('Y-m-d', strtotime(str_replace('-','/', $request->fecha_fin)));
    $club=DB::select(DB::raw("SELECT INITCAP(c.nombre) AS nombre, c.cod AS cod FROM ofj_club c
                              WHERE c.cod='$cod'"));
    $lector=DB::select(DB::raw("SELECT INITCAP(l.nombre1) AS nombre, INITCAP(l.apellido1) AS apellido,
                                l.docidentidad AS docidentidad
                                FROM ofj_lector l
                                WHERE l.docidentidad='$docid'"));
    $grupos=DB::select(DB::raw("SELECT DISTINCT h.id_grupo AS grupo, h.fecha_ini AS fecha_ini, h.fecha_fin AS fecha_fin
                                FROM ofj_grupo_lectura g, ofj_club c, ofj_hist_grupo h
                                WHERE h.doc_lector_hist_lector=$docid AND h.id_club_hist_lector=$cod
                                      AND h.fecha_ini BETWEEN '$fechai' AND '$fechaf'"));
    $pdf = PDF::loadView('Reportes.Reporte2.reporte2grupos',compact('lector','club','grupos'));
    return $pdf->stream();
    } 

    public function reporte8($cod,$docid){
        $club=DB::select(DB::raw("SELECT INITCAP(c.nombre) AS nombre, c.cod AS cod FROM ofj_club c
                              WHERE c.cod='$cod'"));
    $lector=DB::select(DB::raw("SELECT INITCAP(l.nombre1) AS nombre, INITCAP(l.apellido1) AS apellido,
                                l.docidentidad AS docidentidad
                                FROM ofj_lector l
                                WHERE l.docidentidad='$docid'"));
    $libros=DB::select(DB::raw("SELECT DISTINCT li.titulo_original AS nombreo, li.titulo_espanol AS nombree  
                                FROM ofj_reunion r, ofj_inasistencia i, ofj_lector l, ofj_hist_grupo h, ofj_grupo_lectura g, ofj_libro li
                                WHERE h.doc_lector_hist_lector='$docid' AND h.id_grupo=r.id_grupo AND r.id_club_grupo='$cod' AND li.cod=r.id_libro AND NOT EXISTS(SELECT DISTINCT* FROM ofj_inasistencia i
                                                                                                                                                                    WHERE i.id_reunion=r.cod AND i.doc_lector='$docid')
                                ORDER BY nombreo,nombree ASC;"));
    $pdf = PDF::loadView('Reportes.reporte8',compact('lector','club','libros'));
    return $pdf->stream();
        
    }  
}
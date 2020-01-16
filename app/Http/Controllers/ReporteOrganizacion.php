<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Lector;
use App\Club;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Redirect;


class ReporteOrganizacion extends Controller
{
    public function index(Request $request)
    {

        if($request)
        {
            $query=trim($request->get('searchText'));
            $clubes=DB::table('ofj_club')->where('nombre','LIKE',strtoupper($query).'%')
            ->paginate(5);
            return view('Reportes.organizacion', ["clubes" =>$clubes , "searchText"=>$query]);
        }


    }

    public function miembros($codigo)
    {
        $clubes=DB::select(DB::raw("SELECT *FROM ofj_club c WHERE  c.cod=$codigo")); 
        $lectores=DB::select(DB::raw("SELECT l.docidentidad ,l.nombre1,l.apellido1,l.apellido2,c.nombre, c.direccion  
                                                    FROM ofj_hist_lector hit, ofj_lector l ,ofj_club c 
                                                                WHERE  hit.doc_lector =l.docidentidad and hit.id_club=c.cod
                                                                group by l.docidentidad ,l.nombre1,l.apellido1,l.apellido2,c.nombre, c.direccion"));    
            return view('Reportes.Reporte1.pre_reporte1', ["lectores" =>$lectores ,"clubes" =>$clubes]); 
            
    }

    public function ficha($codigo)
    {

        $lectores=DB::select(DB::raw("SELECT l.nombre1,l.apellido1,l.apellido2,hl.doc_lector,hg.doc_lector_hist_lector ,hg.id_grupo,gl.tipo_grupo ,gl.dia,gl.hora_ini,gl.hora_fin 
                                        from ofj_hist_lector hl,ofj_hist_grupo hg , ofj_reunion r ,ofj_grupo_lectura gl ,ofj_lector l
                                        where  l.docidentidad = hl.doc_lector and hg.doc_lector_hist_lector = $codigo and $codigo=hl.doc_lector and r.id_grupo =hg.id_grupo and r.id_grupo=gl.cod
                                        group by hl.doc_lector,hg.doc_lector_hist_lector ,hg.id_grupo,gl.tipo_grupo ,gl.dia,gl.hora_ini,gl.hora_fin,l.nombre1,l.apellido1,l.apellido2 ")); 

            return view('Reportes.Reporte1.orgFichamien', ["lectores" =>$lectores ]); 
            
    }

        
     
}
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Club;
use App\Http\Requests\ObraFormRequest;
use App\Reportes\Reporte8\ObraActuada;
use DB;
class Reporte8Controller extends Controller
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

    public function reporte8($codigo)
    {
        
    
    
            return view('Reportes.obra', ["obra" =>$obras , "searchText"=>$query]); // Retornar todo sobre la tabla club y la muestra en la pantalla conrespondiente 
        
    }

    public function calendario($codigo)
    {

        $calendario=DB::select(DB::raw("SELECT * FROM ofj_calendario WHERE id_obra = $codigo"));    
        
            return view('Reportes.Reporte8.pre_reporte8', ["calendario" =>$calendario]); 
            
    }


    public function ficha($codigo)
    {
        
        $report = new ObraActuada (array(
            "codigo"=>$codigo
        ));
        $report->run();
        return view("Reportes.Reporte8.reporte8",["report"=>$report]);
    }
    public function __contruct()
    {
        $this->middleware("guest");
    }
}
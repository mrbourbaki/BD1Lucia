<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Club;
use App\Http\Requests\libroFormRequest;
use App\Reportes\Reporte7\FichaLibro;
use DB;
class Reporte7Controller extends Controller
{
public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $libros=DB::table('ofj_libro')->where('titulo_original','LIKE',strtoupper($query).'%')
            ->paginate(5);
            return view('Reportes.libro', ["libros" =>$libros , "searchText"=>$query]); // Retornar todo sobre la tabla club y la muestra en la pantalla conrespondiente 
        }
    }
    public function ficha($codigo)
    {
         
        $report = new FichaLibro (array(
            "codigo"=>$codigo
        ));
        $report->run();

        return view("Reportes.Reporte7.reporte7",["report"=>$report]);
    }
    public function __contruct()
    {
        $this->middleware("guest");
    }
   
}

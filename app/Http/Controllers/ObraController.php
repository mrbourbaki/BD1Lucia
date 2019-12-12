<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Club;
use App\Calendario;
use App\Sala; // hago referencia al modelo
use App\Obra;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ObraFormRequest;
use DB;

class ObraController extends Controller
{
    public function __constructor(){

    }

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $obra=DB::table('obra_actuada')->where('titulo','LIKE','%'.strtoupper($query).'%')
            ->paginate(5);
            return view('Obra.index', ["obra"=>$obra, "searchText"=>$query]); // Retornar todo sobre la tabla editorial y la muestra en la pantalla conrespondiente 
        }
    }

    public function create()
    {
        $sala=DB::table('sala')->distinct()->get();
        return view('Obra.create',["sala"=>$sala]);
    }

    public function store(ObraFormRequest $request)
    {
        $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT *
                                                    FROM obra
                                                    WHERE titulo = UPPER('$request->titulo'))"));
        if ($yaExiste[0]->exists == FALSE) {
            $obra=new Obra;
            $obra->titulo=strtoupper($request->titulo);
            $obra->resumen=strtoupper($request->resumen);
            $obra->precio=$request->precio;
            $obra->estatus_actividad=1; // Siempre que se cree una nueva obra su estus es activo
            $obra->duracion=$request->duracion;
            $obra->fk_sala=$request->fk_sala;
            $obra->save();
            return Redirect::to('/Obra');
        } else {
            echo "no";
        }
    }

    public function edit($cod)
    {
        $obra=Obra::findOrFail($cod);

        return view("Obra.edit",["obra"=>$obra]);
    }

    public function update(ObraFromRequest $request, $cod)
    {
        $nuevoTitulo =$request->input('titulo');
        $nuevoResumen =$request->input('resumen');
        $nuevoPrecio =$request->input('precio');
        $nuevoEstatus =$request->input('estatus_actividad');
        $nuevoDuracion =$request->input('duracion');
        $nuevoSala = $request->input('fk_sala');
        //----------------------------------------------
        $obra=Obra::findOrFail($cod);
        $obra->titulo = $nuevoTitulo;
        $obra->resumen = $nuevoResumen;
        $obra->precio = $nuevoPrecio;
        $obra->estatus_actividad = $nuevoEstatus;
        $obra->duracion = $nuevoDuracion;
        $obra->fk_sala = $nuevoSala;
        $obra->save();    
        
        return Redirect::to('/Obra');
    }

    public function destroy($cod)
    {
        $obra=Obra::findOrFail($cod);
        $obra->delete();
        return Redirect::to('/Obra');
    }
}

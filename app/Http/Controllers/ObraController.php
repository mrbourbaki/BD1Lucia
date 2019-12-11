<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Club;
use App\Sala; // hago referencia al modelo
use App\Obra;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\EditorialFormRequest;
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
        $obra=DB::table('obra_actuada')->get();
        return view('Obra.create',["obra"=>$obra]);
    }

    public function store(ObraFormRequest $request)
    {
        $obra=new Obra;
        $obra->titulo=strtoupper($request->Titulo);
        $obra->resumen=strtoupper($request->resumen);
        $obra->precio=$request->precio;
        $obra->estatus_actividad=1; // Siempre que se cree una nueva obra su estus es activo
        $obra->duracion=$request->duracion;
        $obra->fk_sala=$request->fk_sala;
        $obra->save();
        return Redirect::to('/Obra');
    }

    public function edit($cod)
    {
        $obra=Obra::findOrFail($cod);

        return view("obra.edit",["obra"=>$obra]);
    }

    public function update(Request $request, $cod)
    {
        $nuevoTitulo =$request->input('titulo');
        $nuevoResumen =$request->input('resumen');
        $nuevoPrecio =$request->input('precio');
        $nuevoEstatus =$request->input('estatus_actividad');
        $nuevoDuracion =$request->input('duracion');
        $nuevoSala = $request->input('fk_sala');
        //----------------------------------------------
        $obra= Obra::find($cod);
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
        $obra = Obra::findOrFail($cod);
        $obra->delete();
        return Redirect::to('/Obra');
    }
}

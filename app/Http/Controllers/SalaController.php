<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Club;
use App\Sala; // hago referencia al modelo 
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SalaFormRequest;
use DB;

class SalaController extends Controller
{
     public function __constructor(){

    }

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $salas=DB::table('sala')->where('nombre','LIKE','%'.strtoupper($query).'%')
            ->paginate(5);
            return view('Sala.index', ["salas" =>$salas , "searchText"=>$query]); // Retornar todo sobre la tabla libro y la muestra en la pantalla conrespondiente 
        }
    }

    public function create()
    {
        $clubes=DB::table('club')->distinct()->get();
        $lugares=DB::table('lugar')->where('tipo', '=', 'CIUDAD')->get();
        return view('Sala.create',["club"=>$clubes,"lugar"=>$lugares]);
    }

    public function store(SalaFormRequest $request)
    {
        $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT *
                                                    FROM sala
                                                    WHERE nombre = UPPER('$request->nombre'))"));
        if ($yaExiste[0]->exists == FALSE) {
            $sala=new Sala;
            $sala->nombre=strtoupper($request->nombre);
            $sala->tipo=$request->tipo;
            $sala->capacidad=$request->capacidad;
            $sala->direccion=strtoupper($request->direccion);
            $sala->fk_club=$request->fk_club;
            $sala->fk_lugar=$request->fk_lugar;
            $sala->save();
            return Redirect::to('/Sala');
        } else {
            echo "no";
        }
    }

    public function show($id)
    {
        $sala=Sala::findOrFail($id);
        return view("Sala.infomodal", compact("sala"));
    }

    public function edit($cod)
    {
        $salaEdit=Sala::findOrFail($cod);
        $clubes=Club::get();
        $salas=Sala::get();
        $lugares=DB::select("SELECT * FROM lugar WHERE tipo =?", ['CIUDAD']);
        return view("Sala.edit",["salaEdit"=>$salaEdit, "salas"=>$salas, "club"=>$clubes,"lugar"=>$lugares]);
    }

    public function update(SalaFormRequest $request, $cod)
    {
        $nuevoNombre = $request->input('nombre');
        $nuevoCapacidad = $request->input('capacidad');
        $nuevoTipo = $request->input('tipo');
        $nuevoDireccion = $request->input('direccion');
        $nuevoClub = $request->input('fk_club');
        $nuevoLugar = $request->input('fk_lugar');
        //----------------------------------------------
        $sala = Sala::find($cod);
        $sala->nombre = strtoupper ($nuevoNombre);
        $sala->capacidad = $nuevoCapacidad;
        $sala->tipo = $nuevoTipo;
        $sala->direccion =strtoupper ($nuevoDireccion);
        $sala->fk_club = $nuevoClub;
        $sala->fk_lugar = $nuevoLugar;

        $sala->save();    
        
        return Redirect::to('/Sala');
    }

    public function destroy($cod)
    {
        $sala = Sala::findOrFail($cod);
        $sala->delete();
        return Redirect::to('/Sala');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libro;
use App\Estructura; // hago referencia al modelo 
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\EstrucutraFormRequest;
use DB;

class EstructuraController extends Controller
{
    public function __constructor(){

    }

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $estructura=DB::table('ofj_estructura')->where('nombre','LIKE','%'.strtoupper($query).'%')
            ->paginate(5);
            return view('Estructura.index', ["estructura" =>$estructura , "searchText"=>$query]); // Retornar todo sobre la tabla libro y la muestra en la pantalla conrespondiente 
        }
    }

    public function create()
    {
        $libro=DB::table('ofj_libro')->distinct()->get();
        return view('Estructura.create',["libro"=>$libro]);
    }

    public function store(EstructuraFormRequest $request)
    {
        $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT *
                                                    FROM ofj_estructura
                                                    WHERE nombre = UPPER('$request->nombre'))"));

        if ($yaExiste[0]->exists == FALSE){
            $estructura=new Estructura;
            $estructura->nombre=strtoupper($request->nombre);
            $estructura->titulo=$request->titulo;
            $estructura->tipo=$request->tipo;
            $estructura->id_libro=$request->id_libro;
            $estructura->save();
            return Redirect::to('/Estructura')->with('success','Se agregado exitosamente la estructura del libro');
        } else{
            return Redirect::to('/Estructura')->with('error','no se puedo agregar, el nombre de la estructura del libro ya existe ');
        }
    }

    public function show($id)
    {
        $estructura=Estructura::findOrFail($id);
        return view("Estructura.infomodal", compact("estructura"));
    }

    public function edit($cod)
    {
        $estructura=Estructura::findOrFail($cod);
        $libro=Libro::get();
        return view("Libro.edit",["libro"=>$libro,"estructura"=>$estructura]);
    }

    public function update(EstructuraFormRequest $request, $cod)
    {
        $nuevoNombre = $request->input('nombre');
        $nuevotitulo = $request->input('titulo');
        $nuevotipo = $request->input('tipo');
        $nuevoId_libro = $request->input('id_libro');
        //----------------------------------------------
        $estructura = Estructura::find($cod);
        $estructura->nombre = strtoupper ($nuevoNombre);
        $estructura->tipo = strtoupper ($nuevotipo);
        $estructura->titulo = $nuevotitulo;
        $estructura->Id_libro = $nuevoId_libro;
        $estructura->save();    
        
        return Redirect::to('/Estructura')->with('success','su cambio a sido exitoso ');
    }

    public function destroy($cod)
    {
        $estructura = Estructura::findOrFail($cod);
        $estructura->delete();
        return Redirect::to('/Estructura')->with('success','Se elimino sastifactoriamente la Estructura del libro ');
    }
}

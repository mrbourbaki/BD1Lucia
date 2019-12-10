<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Editorial;
use App\Clase;
use App\Libro; // hago referencia al modelo 
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\LibroFormRequest;
use DB;

class LibroController extends Controller
{

    //Aqui se desarrollaran las diferentes funciones para la peticiones a la base de datos 

    public function __constructor(){

    }

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $libros=DB::table('libro')->where('titulo_original','LIKE','%'.strtoupper($query).'%')
            ->paginate(5);
            return view('Libro.index', ["libros" =>$libros , "searchText"=>$query]); // Retornar todo sobre la tabla libro y la muestra en la pantalla conrespondiente 
        }
    }

    public function create()
    {
        $editorial=DB::table('editorial')->distinct()->get();
        $clase=DB::table('clase')->distinct()->get();
        return view('Libro.create',["editorial"=>$editorial,"clase"=>$clase]);
    }

    public function store(LibroFormRequest $request)
    {
        $libro=new Libro;
        $libro->titulo_original=strtoupper($request->titulo_original);
        $libro->sinopsis=$request->sinopsis;
        $libro->nro_pags=$request->nro_pags;
        $libro->ano=$request->ano;
        $libro->titulo_espanol=strtoupper($request->titulo_espanol);
        $libro->tema=strtoupper($request->tema);
        $libro->fk_editorial = $request->fk_editorial;
        $libro->fk_clase = $request->fk_clase;
        $libro->save();
        return Redirect::to('Libro');
    }

    public function show($id)
    {
        $libro=Libro::findOrFail($id);
        return view("Libro.infomodal", compact("libro"));
    }

    public function edit($cod)
    {
        $libro= Libro::findOrFail($cod);
        $editorial= Editorial::get();
        $clase= Clase::get();
        return view("Libro.edit",["libro"=>$libro,"editorial"=>$editorial,"clase"=>$clase]);
    }

    public function update(LibroFormRequest $request, $cod)
    {
        $libro= Libro::findOrFail($cod);
        $libro->titulo_original=strtoupper($request->titulo_original);
        $libro->sinopsis=$request->sinopsis;
        $libro->nro_pags=$request->nro_pags;
        $libro->ano=$request->ano;
        $libro->titulo_espanol=strtoupper($request->titulo_espanol);
        $libro->tema=strtoupper($request->tema);
        $libro->fk_editorial = $request->get('fk_editorial');
        $libro->fk_clase = $request->get('fk_clase');
        return redirect('/Libro');
    }

    public function destroy($cod)
    {
        $libro = Libro::findOrFail($cod);
        $libro->delete();
        return Redirect::to('Libro');
    }
}

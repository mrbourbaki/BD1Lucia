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
        $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT *
                                                    FROM libro
                                                    WHERE titulo_original = UPPER('$request->titulo_original'))"));

        if ($yaExiste[0]->exists == FALSE){
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
            return Redirect::to('/Libro');
        } else{
            echo "no";
        }
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
        $nuevoNombre = $request->input('titulo_original');
        $nuevoSinopsis = $request->input('sinopsis');
        $nuevoNropags = $request->input('nro_pags');
        $nuevoAno = $request->input('ano');
        $nuevoTituloespanol= $request->input('titulo_espanol');
        $nuevoTema = $request->input('tema');
        $nuevoEditorial = $request->input('fk_editorial');
        $nuevoClase = $request->input('fk_clase');
        //----------------------------------------------
        $libro = Libro::find($cod);
        $libro->titulo_original = strtoupper ($nuevoNombre);
        $libro->sinopsis = strtoupper ($nuevoSinopsis);
        $libro->nro_pags = $nuevoNropags;
        $libro->ano = $nuevoAno;
        $libro->titulo_espanol =strtoupper ($nuevoTituloespanol);
        $libro->tema = strtoupper ($nuevoTema);
        $libro->fk_editorial = $nuevoEditorial;
        $libro->fk_clase = $nuevoClase;
        $libro->save();    
        
        return Redirect::to('/Libro');
    }

    public function destroy($cod)
    {
        $libro = Libro::findOrFail($cod);
        $libro->delete();
        return Redirect::to('/Libro');
    }
}

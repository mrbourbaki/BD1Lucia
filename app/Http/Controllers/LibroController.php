<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

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
            $libros=DB::table('libro')->where('titulo_original','LIKE','%'.$query.'%')
            ->paginate(2);
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
        $libro->tema=$request->strtoupper(tema);
        $libro->fk_editorial = $request->fk_editorial;
        $libro->fk_clase = $request->fk_clase;
        $libro->save();
        return redirect('/Libro/create');
    }

    public function show($id)
    {
        return view("Libro.show",["libro"=>Libro::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("Libro.edit",["libro"=>Libro::findOrFail($id)]);
    }

    public function update(LibroFomRequest $request, $id)
    {

    }

    public function destroy($cod)
    {
        $libro = Libro::findOrFail($cod);
        $libro->delete();
        return redirect('/Libro');
    }
}

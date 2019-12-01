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
      
  
        $libros=DB::table('libro')->get() ;
        return view('Libro.index',["libros" =>$libros]); // aqui deberia de retornar todo sobre la tabla libro y mostrarla en la pantalla conrespondiente 

        
        
       
    }

    public function create()
    {
        return view('Libro.create');
    }

    public function store(LibroFormRequest $request)
    {
        $libro =new Libro; //hago referencia al modelo de libro 
        $libro->nombre=$request->get('nombre'); // se valida en el archivo de request
        $libro->descripcion=$request->get('descripcion');
        $libro->save(); // se guarda la informacion 
        return Redirect::to('Libro.index'); // redireccionamos la pag
        
    }

    public function show()
    {
        
    }

    public function edit()
    {
        
    }

    public function update()
    {
        
    }

    public function destroy()
    {
        
    }
}

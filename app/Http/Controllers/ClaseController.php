<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Clase; // hago referencia al modelo 
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ClaseFormRequest;
use DB;

class ClaseController extends Controller
{
    public function __constructor(){

    }

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $clases=DB::table('clase')->where('nombre','LIKE','%'.strtoupper($query).'%')
            ->paginate(5);
            return view('Clase.index', ["clase"=>$clases, "searchText"=>$query]); // Retornar todo sobre la tabla clase y la muestra en la pantalla conrespondiente 
        }
    }

    public function create()
    {
        $clases=Clase::get();
        return view('Clase.create',["clase"=>$clases]);
    }

    public function store(ClaseFormRequest $request)
    {
        $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT *
                                                    FROM clase
                                                    WHERE nombre = UPPER('$request->nombre'))"));
        if ($yaExiste[0]->exists == FALSE){
            $clase=new Clase;
            $clase->nombre=strtoupper($request->nombre);
            if ($request->fk_clase == 'Null') {
                $clase->fk_clase = NULL;
                $clase->tipo = 'SUBGENERO';
            } else {
                $clase->fk_clase=$request->fk_clase;
                $clase->tipo = 'OTRO';
            }
            $clase->save();
            return Redirect::to('/Clase');
        } else {
            echo "no";
        }
    }

    public function edit($cod)
    {
        $clase=Clase::findOrFail($cod);
        $clasesPadre=DB::table('clase')->where('cod', '!=', $cod)->get();
        return view("Clase.edit",["clase"=>$clase, "clasesPadre"=> $clasesPadre]);
    }

    public function update(Request $request, $cod)
    {
        $nuevoNombre =$request->input('nombre');
        $nuevoPadre = $request->input('fk_clase');
        //----------------------------------------------
        $clase=Clase::find($cod);
        $clase->nombre = $nuevoNombre;
        $clase->fk_clase = $nuevoPadre;
        $clase->save();    
        
        return Redirect::to('/Clase');
    }

    public function destroy($cod)
    {   
        $clase = Clase::findOrFail($cod);
        $clase->delete();
        return Redirect::to('/Clase');
    }
}

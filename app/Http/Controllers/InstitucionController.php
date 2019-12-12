<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Lugar;
use App\Institucion; // hago referencia al modelo 
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\InstitucionFormRequest;
use DB;

class InstitucionController extends Controller
{
    public function __constructor(){

    }

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $lugares=DB::table('lugar');
            $institucion=DB::table('institucion')->where('nombre','LIKE','%'.strtoupper($query).'%')
            ->paginate(5);
            return view('Institucion.index', ["lugar"=>$lugares, "institucion"=>$institucion, "searchText"=>$query]); // Retornar todo sobre la tabla editorial y la muestra en la pantalla conrespondiente 
        }
    }

    public function create()
    {
        $lugares=DB::table('lugar')->where('tipo', '=', 'CIUDAD')->get();
        return view('Institucion.create',["lugar"=>$lugares]);
    }

    public function store(InstitucionFormRequest $request)
    {
        $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT *
                                                    FROM institucion
                                                    WHERE nombre = UPPER('$request->nombre'))"));
        if ($yaExiste[0]->exists == FALSE){
            $institucion=new Institucion;
            $institucion->nombre=strtoupper($request->nombre);
            $institucion->detalle=strtoupper($request->detalle);
            $institucion->fk_lugar=$request->fk_lugar;
            $institucion->save();
            return Redirect::to('/Institucion');
        } else {
            echo "no";
        }
    }

    public function show($cod)
    {
        $inst=Institucion::findOrFail($cod);
        return view("Institucion.infomodal", compact("inst"));
    }

    public function edit($cod)
    {
        $institucion=Institucion::findOrFail($cod);
        $lugares=DB::table('lugar')->where('tipo', '=', 'CIUDAD')->get();
        return view("Institucion.edit",["institucion"=>$institucion,"lugar"=>$lugares]);  
    }

    public function update(InstitucionFormRequest $request, $cod)
    {
        $nuevoNombre = $request->input('nombre');
        $nuevoDetalle = $request->input('detalle');
        $nuevoLugar = $request->input('fk_lugar');

        //----------------------------------------------
        $inst = Institucion::find($cod);
        $inst->nombre = strtoupper ($nuevoNombre);
        $inst->detalle = strtoupper ($nuevoDetalle);
        $inst->fk_lugar = $nuevoLugar;
        $inst->save();    
        
        return Redirect::to('/Institucion');
    }

    public function destroy($cod)
    {
        $inst = Institucion::findOrFail($cod);
        $inst->delete();
        return Redirect::to('/Institucion');
    }
}

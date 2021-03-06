<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Editorial; // hago referencia al modelo
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\EditorialFormRequest;
use DB;

class EditorialController extends Controller
{
    public function __constructor(){

    }

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $lugares=DB::table('ofj_lugar')->where('tipo', '=', 'CIUDAD');
            $editoriales=DB::table('ofj_editorial')->where('nombre','LIKE','%'.strtoupper($query).'%')
            ->paginate(5);
            return view('Editorial.index', ["lugar"=>$lugares, "editorial"=>$editoriales, "searchText"=>$query]); // Retornar todo sobre la tabla editorial y la muestra en la pantalla conrespondiente 
        }
    }

    public function create()
    {
        $lugares=DB::table('ofj_lugar')->where('tipo', '=', 'CIUDAD')->get();
        return view('Editorial.create',["lugar"=>$lugares]);
    }

    public function store(EditorialFormRequest $request)
    {
        $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT *
                                                    FROM ofj_editorial
                                                    WHERE nombre = UPPER('$request->nombre'))"));
        if ($yaExiste[0]->exists == FALSE) {
            $editorial=new Editorial;
            $editorial->nombre=strtoupper($request->nombre);
            $editorial->fk_lugar=$request->fk_lugar;
            $editorial->save();
            return Redirect::to('/Editorial')->with('success','Se ha creado una nueva Editorial');
        } else {
            return Redirect::to('/Editorial')->with('success','ya existe esa Editorial');
        }
    }

    public function edit($cod)
    {
        $editorial=Editorial::findOrFail($cod);
        $lugares=DB::table('ofj_lugar')->where('tipo', '=', 'CIUDAD')->get();
        return view("Editorial.edit",["editorial"=>$editorial,"lugar"=>$lugares]);
    }

    public function update(Request $request, $cod)
    {
        $nuevoNombre =$request->input('nombre');
        $nuevoLugar = $request->input('fk_lugar');
        //----------------------------------------------
        $editorial= Editorial::find($cod);
        $editorial->nombre = $nuevoNombre;
        $editorial->fk_lugar = $nuevoLugar;
        $editorial->save();    
        
        return Redirect::to('/Editorial')->with('success','Se ha actualizado el Editorial');
    }

    public function destroy($cod)
    {
        $editorial = Editorial::findOrFail($cod);
        $editorial->delete();
        return Redirect::to('/Editorial')->with('success','Se ha Eliminado El Editorial');
    }
}

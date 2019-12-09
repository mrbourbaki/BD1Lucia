<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Editorial; // hago referencia al modelo
use App\Lugar;
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
            $lugares=DB::table('lugar')->where('tipo', '=', 'CIUDAD');
            $editoriales=DB::table('editorial')->where('nombre','LIKE','%'.strtoupper($query).'%')
            ->paginate(5);
            return view('Editorial.index', ["lugar"=>$lugares, "editorial"=>$editoriales, "searchText"=>$query]); // Retornar todo sobre la tabla editorial y la muestra en la pantalla conrespondiente 
        }
    }

    public function create()
    {
        $lugares=DB::table('lugar')->where('tipo', '=', 'CIUDAD')->get();
        return view('Editorial.create',["lugar"=>$lugares]);
    }

    public function store(EditorialFormRequest $request)
    {
        $editorial=new Editorial;
        $editorial->nombre=strtoupper($request->nombre);
        $editorial->fk_lugar=$request->fk_lugar;
        $editorial->save();
        return Redirect::to('Editorial');
    }

    public function show()
    {
        
    }

    public function edit($cod)
    {
        $editorial=Editorial::findOrFail($cod);
        $lugares=DB::table('lugar')->where('tipo', '=', 'CIUDAD')->get();
        return view("Editorial.edit",["editorial"=>$editorial,"lugar"=>$lugares]);   
    }

    public function update()
    {
        
    }

    public function destroy($cod)
    {
        $editorial = Editorial::findOrFail($cod);
        $editorial->delete();
        return Redirect::to('Editorial');
    }
}

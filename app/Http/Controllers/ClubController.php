<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Club;
use App\Lugar; 
use App\Lector;
use App\Pago;
use App\Institucion;
use App\Hist_lector;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\clubFormRequest;
use DB;

class ClubController extends Controller
{

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $clubes=DB::table('club')->where('nombre','LIKE',strtoupper($query).'%')
            ->paginate(5);
            $lectores=Lector::all();
            return view('Club.index', ["clubes" =>$clubes , "searchText"=>$query,"lectores"=>$lectores]); // Retornar todo sobre la tabla club y la muestra en la pantalla conrespondiente 
        }
    
    }

    public function create()
    {   
        $lugar=DB::select("SELECT * FROM lugar WHERE tipo =?", ['CIUDAD']);
        $institucion=Institucion::all()->get();
        return view('Club.create',["lugar"=>$lugar,"institucion"=>$institucion]);
    }


    public function store(ClubFormRequest $request)
    {
        $club=new Club;
        $club->nombre=strtoupper($request->nombre);
        $club->codigo_postal=$request->codigo_postal;
        $club->direccion=strtoupper($request->direccion);
        $club->fk_lugar= $request->fk_lugar;
        $club->fk_institucion= $request->fk_institucion;
        $club->cuota=$request->cuota;
        $club->save();
        return Redirect::to('Club');
    }
    public function show($cod)
    {
        //
    }


    public function edit($cod)
    {
        $club= club::findOrFail($cod);
        $lugar=DB::select("SELECT * FROM lugar WHERE tipo =?", ['CIUDAD']);
        $institucion=Institucion::all();
        return view("Club.edit",["club"=>$club,"lugar"=>$lugar,"institucion"=>$institucion]);
    }

    public function update(ClubFormRequest $request, $cod)
    {
        $club= Club::findOrFail($cod);
        $club->nombre=strtoupper($request->nombre);
        $club->codigo_postal=$request->codigo_postal;
        $club->direccion=strtoupper($request->direccion);
        $club->fk_lugar= $request->fk_lugar;
        $club->fk_institucion= $request->fk_institucion;
        $club->cuota=$request->cuota;
        return redirect('Club');
    }


    public function destroy($docidentidad)
    {
        $club = Club::findOrFail($docidentidad);
        $club->delete();
        return Redirect::to('Club');
    }

    public function agregaMiembro ($cod)
    {

        $club=Club::findOrFail($cod);
        $lectores=DB::table('lector')->where('fk_nacionalidad', '=', $club->fk_lugar)->get();
        return view("Club.miembro",["lectores"=>$lectores]);
    }
}

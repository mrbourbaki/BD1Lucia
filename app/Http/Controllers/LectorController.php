<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Lector;
use App\Lugar;
use App\Representante_externo; 
use App\Pago;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\LectorFormRequest;
use DB;

class LectorController extends Controller
{

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $lectores=DB::table('ofj_lector')->where('nombre1','LIKE',strtoupper($query).'%')
            ->paginate(10);
            return view('Lector.index', ["lectores" =>$lectores , "searchText"=>$query]); // Retornar todo sobre la tabla lector y la muestra en la pantalla conrespondiente 
        }
    
    }

    public function create()
    {   
        $lugar=DB::select("SELECT * FROM ofj_lugar WHERE tipo =?", ['PAIS']);
        $rep_externo=DB::select("SELECT * FROM ofj_representante_externo");
        $lectores=DB::select("SELECT * FROM ofj_lector");
        $libro=DB::table('ofj_libro')->distinct()->get();
        return view('Lector.create',["lugar"=>$lugar,"rep_externo"=>$rep_externo,"lectores"=>$lectores,"libro"=>$libro]);
    }

    public function store(LectorFormRequest $request)
    {
        $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT *
                                                    FROM ofj_lector
                                                    WHERE docidentidad = '$request->docidentidad')"));
        if ($yaExiste[0]->exists == FALSE) {
            $lector = new Lector;
            $lector->nombre1=strtoupper($request->nombre1);
            $lector->nombre2=strtoupper($request->nombre2);
            $lector->apellido1=strtoupper($request->apellido1);
            $lector->apellido2=strtoupper($request->apellido2);
            $lector->docidentidad=$request->docidentidad;
            $lector->fecha_nac=$request->fecha_nac;
            $lector->telefono = $request->telefono;
            $lector->genero = $request->genero;
            $lector->fk_nacionalidad= $request->fk_nacionalidad;
            $lector->fk_rep=$request->fk_rep;
            $lector->fk_rep_externo=$request->fk_rep_externo;
            $lector->save();
            return Redirect::to('Lector')->with('success','El lector fue agregado exitosamente  ');
        } else {
            return Redirect::to('Lector')->with('error','ya existe el lector');
        }
    }

    public function edit($docidentidad)
    {
        $rep_externo=DB::select("SELECT * FROM ofj_representante_externo");
        $representante=DB::select("SELECT * FROM ofj_lector");
        $lector= Lector::findOrFail($docidentidad);
        $lugar=DB::select("SELECT * FROM ofj_lugar WHERE tipo =?", ['PAIS']);
        return view("Lector.edit",["lector"=>$lector,"lugar"=>$lugar, "rep_externo"=>$rep_externo,"representante"=>$representante]);
    }

    public function update(LectorFormRequest $request, $docidentidad)
    {
        $lector= Lector::findOrFail($docidentidad);
        $lector->nombre1=strtoupper($request->nombre1);
        $lector->nombre2=strtoupper($request->nombre2);
        $lector->apellido1=strtoupper($request->apellido1);
        $lector->apellido2=strtoupper($request->apellido2);
        $lector->docidentidad=$request->docidentidad;
        $lector->telefono = $request->telefono;
        $lector->genero = $request->genero;
        $lector->fk_nacionalidad= $request->fk_nacionalidad;
        $lector->fk_rep=$request->fk_rep;
        $lector->fk_rep_externo=$request->fk_rep_externo;
        $lector->save();
        return redirect('Lector')->with('success','El lector fue Editado exitosamente  ');
    }

    public function destroy($docidentidad)
    {
        $lector = Lector::findOrFail($docidentidad);
        $lector->delete();
        return Redirect::to('Lector')->with('success','El lector fue eliminado exitosamente  ');
    }

    public function RepSearch(Request $request)
    { 
        $query=trim($request->get('searchText'));
        $rep_ext=DB::table('ofj_representante_externo')->where('nombre1','LIKE','%'.strtoupper($query).'%')
        ->paginate(5);
        return view ('Lector.create', ["rep_ext" =>$rep_ext]); // Retornar todo sobre la tabla lector y la muestra en la pantalla conrespondiente 
    }

    public function Pagos ($docidentidad){
        $pagos=DB::select("SELECT * FROM ofj_pago WHERE doc_lector_hist_lector =?", [$docidentidad]);
        return view('Lector.pago',["pagos"=>$pagos]);
    }
}

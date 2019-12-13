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
use App\Http\Requests\ClubFormRequest;
use DB;
use DateTime;

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

    public function edit($cod)
    {
        $club= club::findOrFail($cod);
        $lugar=DB::select("SELECT * FROM lugar WHERE tipo =?", ['CIUDAD']);
        $institucion=Institucion::all();
        return view("Club.edit",["club"=>$club,"lugar"=>$lugar,"institucion"=>$institucion]);
    }

    public function update(ClubFormRequest $request, $cod)
    {
        $club=Club::findOrFail($cod);
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

    public function filtraMiembro ($cod) 
    {
        $club=Club::findOrFail($cod);

        $lectores=DB::select(DB::raw("SELECT * 
                            FROM lector
                            WHERE fk_nacionalidad = (SELECT fk_lugar 
                                                    FROM lugar
                                                    WHERE codigo = '$club->fk_lugar')"));

        foreach ($lectores as $key => $lec){
            $estatus_hist=DB::select(DB::raw("SELECT estatus 
                                            FROM hist_lector
                                            WHERE doc_lector = '$lec->docidentidad' AND fecha_fin IS NULL;"));

            // LUEGO DE ARREGLAR LOS ID DE DOCID DE LAS PERSONAS VERIFICAR QUE ESTO FUNCIONE CORRECTAMENTE
            echo $estatus_hist;
            if ($estatus_hist != 'ACTIVO'){
                unset($lectores[$key]);
            }
        }
        return view("Club.miembro",["lectores"=>$lectores, "club"=>$club]);
    }

    public function agregaMiembro (Request $request, $cod)
    {
        date_default_timezone_set('America/Caracas');

        $lectoresDocid=$request->docidentidad;

        //Lector::findOrFail($lec_id)->nombre1;
/*        foreach ($lectoresDocid as $lec_id){
        
            $pago=DB::select(DB::raw("SELECT MAX(fecha_pago) 
                                    FROM pago
                                    WHERE doc_lector_hist_lector = '$lec_id'"));

            $date = new DateTime($pago[0]->max);
            $today = new DateTime(date("Y-m-d H:i:s"));

            $diff = $date->diff($today);

            echo (($diff->format('%y') * 12) + $diff->format('%m')) . " meses de diferencia";
        }
*/
    }
}

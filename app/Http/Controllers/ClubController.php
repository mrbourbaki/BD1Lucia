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
        $institucion=Institucion::all();
        return view('Club.create',["lugar"=>$lugar,"institucion"=>$institucion]);
    }

    public function store(ClubFormRequest $request)
    {
        $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT *
                                                    FROM editorial
                                                    WHERE nombre = UPPER('$request->nombre'))"));
        if ($yaExiste[0]->exists == FALSE) {
            $club=new Club;
            $club->nombre=strtoupper($request->nombre);
            $club->codigo_postal=$request->codigo_postal;
            $club->direccion=strtoupper($request->direccion);
            $club->fk_lugar= $request->fk_lugar;
            $club->fk_institucion= $request->fk_institucion;
            $club->cuota=$request->cuota;
            $club->save();
            return Redirect::to('Club');
        } else {
            echo "no";
        }
    }

    public function edit($cod)
    {
        $club=Club::findOrFail($cod);
        $lugar=DB::select("SELECT * FROM lugar WHERE tipo =?", ['CIUDAD']);
        $institucion=Institucion::all();
        return view("Club.edit",["club"=>$club,"lugar"=>$lugar,"institucion"=>$institucion]);
    }

    public function update(ClubFormRequest $request, $cod)
    {
        $nuevoNombre=strtoupper($request->input('nombre'));
        $nuevoCodPostal=$request->input('codigo_postal');
        $nuevoDireccion=strtoupper($request->input('direccion'));
        $nuevoLugar=$request->input('fk_lugar');
        $nuevoInstitucion=$request->input('fk_institucion');
        $nuevoCuota=$request->input('cuota');
        //----------------------------------------
        $club=Club::findOrFail($cod);
        $club->nombre=$nuevoNombre;
        $club->codigo_postal=$nuevoCodPostal;
        $club->direccion=$nuevoDireccion;
        $club->fk_lugar=$nuevoLugar;
        $club->fk_institucion=$nuevoInstitucion;
        $club->cuota=$nuevoCuota;
        $club->save();
        return Redirect::to('Club');
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

            if ($estatus_hist[0]->estatus != 'ACTIVO'){
                unset($lectores[$key]);
            }
        }
        return view("Club.miembro",["lectores"=>$lectores, "club"=>$club]);
    }

    public function agregaMiembro (Request $request, $cod)
    {
        date_default_timezone_set('America/Caracas');

        $lectoresDocid=$request->docidentidad;
        $today = new DateTime(date("Y-m-d H:i:s"));
        foreach ($lectoresDocid as $lec_id){
            // Verificando si el lector ya esxiste en el historial
            $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT * 
                                                            FROM hist_lector 
                                                            WHERE doc_lector = $lec_id)"));
            if ($yaExiste[0]->exists == TRUE){ // Si existe se actualiza el ultimo registro y se coloca una fecha fin
                $update_hist_lector = DB::update('UPDATE hist_lector 
                                            SET fecha_fin = ? 
                                            WHERE doc_lector = ? AND fecha_fin IS NULL', [$today, $lec_id]);
            }

            // Se inserta el nuevo registro del lector (nuevo club)
            $hist_lector = DB::insert('INSERT INTO hist_lector (fecha_ini,doc_lector,id_club,estatus) values (?, ?, ?, ?)', [$today, $lec_id, $cod, 'ACTIVO']);
        }

        return Redirect::to('Club');
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

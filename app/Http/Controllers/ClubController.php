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
            $clubes=DB::table('ofj_club')->where('nombre','LIKE',strtoupper($query).'%')
            ->paginate(5);
            $lectores=Lector::all();
            return view('Club.index', ["clubes" =>$clubes , "searchText"=>$query,"lectores"=>$lectores]); // Retornar todo sobre la tabla club y la muestra en la pantalla conrespondiente 
        }
    
    }

    public function create()
    {   
        $lugar=DB::select("SELECT * FROM ofj_lugar WHERE tipo =?", ['CIUDAD']);
        $institucion=Institucion::all();
        return view('Club.create',["lugar"=>$lugar,"institucion"=>$institucion]);
    }

    public function store(ClubFormRequest $request)
    {
        $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT *
                                                    FROM ofj_editorial
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
            return Redirect::to('Club')->with('success','Se agregado exitosamente el Club');;
        } else {
            return Redirect::to('Club')->with('warning',' Ya existe ');

        }
    }

    public function edit($cod)
    {
        $club=Club::findOrFail($cod);
        $lugar=DB::select("SELECT * FROM ofj_lugar WHERE tipo =?", ['CIUDAD']);
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
        return Redirect::to('Club')->with('success','Se actualizo exitosamente el Club');;
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
                            FROM ofj_lector
                            WHERE fk_nacionalidad = (SELECT fk_lugar 
                                                    FROM ofj_lugar
                                                    WHERE codigo = '$club->fk_lugar')"));

        foreach ($lectores as $key => $lec){
            // Obteniendo cantidad de meses atrasado en el pago
            $pago=DB::select(DB::raw("SELECT MAX(fecha_pago) 
                                    FROM ofj_pago
                                    WHERE doc_lector_hist_lector = '$lec->docidentidad'"));

            $date = new DateTime($pago[0]->max);
            $today = new DateTime(date("Y-m-d H:i:s"));

            $diff = $date->diff($today);

            $mesesDiferencia = ($diff->format('%y') * 12) + $diff->format('%m');
            // END

            // Obteniendo en estatus de activo o no del historial
            $estatus_hist=DB::select(DB::raw("SELECT estatus 
                                                FROM ofj_hist_lector
                                                WHERE doc_lector = '$lec->docidentidad' AND fecha_fin IS NULL;"));
            // END

            // Ya existe en el club actual y esta activo
            $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT * 
                                                            FROM ofj_hist_lector 
                                                            WHERE doc_lector = '$lec->docidentidad' AND id_club = $cod AND fecha_fin IS NULL)"));
            // END

            // Filtrando a los lectores que tienen retraso en el pago y/o estan retirados o inactivos
            if ($estatus_hist[0]->estatus != 'ACTIVO' || $mesesDiferencia > 0 || $yaExiste[0]->exists == TRUE){
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
            // Consultando los grupos en donde se insertaran los nuevo miembros del club
            $gruposNino = DB::select(DB::raw("SELECT g.cod, COUNT(h.id_grupo), g.tipo_grupo
                                            FROM ofj_hist_grupo h, ofj_grupo_lectura g
                                            WHERE g.cod = h.id_grupo AND g.tipo_grupo = 'NINO'
                                            GROUP BY g.cod, g.tipo_grupo
                                            HAVING COUNT(h.id_grupo) < 10"));

            $gruposJoven = DB::select(DB::raw("SELECT g.cod, COUNT(h.id_grupo), g.tipo_grupo
                                            FROM ofj_hist_grupo h, ofj_grupo_lectura g
                                            WHERE g.cod = h.id_grupo AND g.tipo_grupo = 'JOVEN'
                                            GROUP BY g.cod, g.tipo_grupo
                                            HAVING COUNT(h.id_grupo) < 10"));

            $gruposAdulto = DB::select(DB::raw("SELECT g.cod, COUNT(h.id_grupo), g.tipo_grupo
                                            FROM ofj_hist_grupo h, ofj_grupo_lectura g
                                            WHERE g.cod = h.id_grupo AND g.tipo_grupo = 'ADULTO'
                                            GROUP BY g.cod, g.tipo_grupo
                                            HAVING COUNT(h.id_grupo) < 15"));
            // END

            // Verificando si el lector ya esxiste en el historial
            $yaExiste=DB::select(DB::raw("SELECT EXISTS (SELECT * 
                                                            FROM ofj_hist_lector 
                                                            WHERE doc_lector = $lec_id)"));
            if ($yaExiste[0]->exists == TRUE){
                $update_hist_lector = DB::update('UPDATE ofj_hist_lector 
                                            SET fecha_fin = ? 
                                            WHERE doc_lector = ? AND fecha_fin IS NULL', [$today, $lec_id]);
            }
            // END

            // Se inserta el nuevo registro del lector (nuevo club)
            $hist_lector = DB::insert('INSERT INTO ofj_hist_lector (fecha_ini,doc_lector,id_club,estatus) values (?, ?, ?, ?)', [$today, $lec_id, $cod, 'ACTIVO']);
            
            $fechaNacLector =  new DateTime(Lector::findOrFail($lec_id)->fecha_nac);
            
            $diff = $fechaNacLector->diff($today);

            $edadLector = $diff->format('%Y');

            if ($edadLector < 13){
                // Nino
                if (empty($gruposNino)){
                    // Se crea un grupo
                    $insertGrupoLectura = DB::insert('INSERT INTO ofj_grupo_lectura (id_club,tipo_grupo,dia,hora_ini, hora_fin) 
                                                VALUES (?, ?, ?, ?, ?)', [$cod, 'NINO', 2, '13:00:00', '14:00:00']);
                    $insertHistorialGrupo = DB::insert('INSERT INTO ofj_hist_grupo (fecha_hist_lector,doclector_hist_lector,id_club_hist_lector,id_grupo,id_club_grupo, fecha_ini) 
                    VALUES (?, ?, ?, ?, ?, ?)', [$today, $lec_id , $cod, '13:00:00', '14:00:00']);;
                } else {
                    // Se inserta en el primer grupo
                    $gruposNino[0];
                    
                }

            } else if ($edadLector < 18) {
                // Adolescente
                if (empty($gruposJoven)){
                    // Se crea un grupo

                } else {
                    // Se inserta en el primer grupo

                }
            } else {
                // Adulto
                if (empty($gruposAdulto)){
                    // Se crea un grupo

                } else {
                    // Se inserta en el primer grupo

                }
            }
        }
<<<<<<< HEAD
        return Redirect::to('Club');
=======

        return Redirect::to('Club')->with('success','Se agregado exitosamente el miembro al club');;
        //Lector::findOrFail($lec_id)->nombre1;
/*        foreach ($lectoresDocid as $lec_id){
        
            $pago=DB::select(DB::raw("SELECT MAX(fecha_pago) 
                                    FROM ofj_pago
                                    WHERE doc_lector_hist_lector = '$lec_id'"));

            $date = new DateTime($pago[0]->max);
            $today = new DateTime(date("Y-m-d H:i:s"));

            $diff = $date->diff($today);

            echo (($diff->format('%y') * 12) + $diff->format('%m')) . " meses de diferencia";
        }
*/
>>>>>>> 0c8c95d989546209467510f59422b2c5a26d4a32
    }
}

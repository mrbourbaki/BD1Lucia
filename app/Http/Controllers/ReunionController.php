<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use App\Hist_grupo;

class ReunionController extends Controller
{

    public function index()
    {
        $clubes=DB::table('ofj_club')->get();
        return view('Reunion.index',["clubes"=>$clubes]);
    }


    public function postIndex(Request $request)
    {
        $tipo = $_POST["tipo"];
        $club = $_POST["club"];
        $libros=DB::table('ofj_libro')->get();
        $gruposNino = DB::select(DB::raw("SELECT g.cod, COUNT(h.id_grupo), g.tipo_grupo
                                          FROM ofj_hist_grupo h, ofj_grupo_lectura g
                                          WHERE g.cod = h.id_grupo AND g.cod='$club' AND g.tipo_grupo ='NINO' 
                                          GROUP BY g.cod, g.tipo_grupo
                                          HAVING COUNT(h.id_grupo) > 7")); 

        $gruposJoven = DB::select(DB::raw("SELECT g.cod, COUNT(h.id_grupo), g.tipo_grupo
                                            FROM ofj_hist_grupo h, ofj_grupo_lectura g
                                            WHERE g.cod = h.id_grupo AND g.cod='$club' AND g.tipo_grupo ='JOVEN' 
                                            GROUP BY g.cod, g.tipo_grupo
                                            HAVING COUNT(h.id_grupo) > 5"));

        $gruposAdulto = DB::select(DB::raw("SELECT g.cod, COUNT(h.id_grupo), g.tipo_grupo
                                            FROM ofj_hist_grupo h, ofj_grupo_lectura g
                                            WHERE g.cod = h.id_grupo AND g.cod='$club' AND g.tipo_grupo ='ADULTO'
                                            GROUP BY g.cod, g.tipo_grupo
                                            HAVING COUNT(h.id_grupo) > 10"));
        $today = new DateTime(date("Y-m-d H:i:s"));
            //Lista de Moderadores
        if ($tipo == 'NINO'){
            $miembrosClub=DB::select("SELECT doc_lector_hist_lector FROM ofj_hist_grupo WHERE  id_club_hist_lector=?" , [$request->club]);

                foreach ($miembrosClub as $key => $lec) {
                    $fechaNacLector = new DateTime($lec->fecha_nac);
                    $diff = $fechaNacLector->diff($today);
                    $edadLector = $diff->format('%Y');
                    if ($edadLector < 19){
                         unset($miembrosClub[$key]);                    
                    }
                }
                //Retorna vista para niños
                return view ('Reunion.createNino',["moderadores"=>$miembrosClub,"gruposNino"=>$gruposNino,"libros"=>$libros]);
        }
        else {
                //Retorna vista para jovenes y adultos
                return view ('Reunion.create',["gruposJoven"=>$gruposJoven,"gruposAdulto"=>$gruposAdulto,"libros"=>$libros]);
        }
        
    }

    public function store(Request $request)
    {
        $fecha=DB::select(DB::raw("SELECT MAX(fecha) 
                                    FROM ofj_reunion
                                    WHERE  = id_grupo = '$request->id_grupo'"));
        //Valido que la reunion no este creada en la misma semana 
        $date = new DateTime($fecha[0]->max);
        $today = new DateTime(date("Y-m-d H:i:s"));
        $diff = $date->diff($today);
        $diasDiferencia= ($diff->format('%a') % 7);
        //                            
        if ($diasDiferencia < 7) {
             return Redirect::to('Reunion')->with('error','No se pudo crear la reunión, ya hay una reunión creada para esta semana');
        }
        else {
            $grupo = $_POST["grupo"];
            $hist_grupo= Hist_grupo::findOrFail($grupo);
            $reunion=new Reunion;
            $reunion->id_grupo=$grupo;
            $reunion->id_club_grupo=$hist_grupo->id_club_grupo;
            $reunion->id_grupo_hist_grupo=$hist_grupo->id_grupo;
            $reunion->id_club_hist_grupo=$hist_grupo->id_club_grupo;
            $reunion->fecha_hlector=$hist_grupo->fecha_hist_lector;
            $reunion->doc_lector=$hist_grupo->doc_lector_hist_lector;
            $reunion->id_club_hist_lector=$request->id_club_hist_lector;
            $reunion->id_libro=$request->id_libro;
            $reunion->fecha=$request->fecha;
            $reunion->conclusiones=$request->conclusiones;
            $reunion->valoracion=$request->valoracion;
            $reunion->save();
            return Redirect::to('Reunion')->with('success','Se ha creado la reunion satisfactoriamente');
        }
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Reportes\Reporte7;
 

class FichaLibroCom extends \koolreport\KoolReport
{   
    use \koolreport\clients\Bootstrap;

    public function settings()
    {
        return array(
            "dataSources"=>array(
                "automaker"=>array(

                    "connectionString"=>"pgsql:host=localhost;port=5432;dbname=bd1lucia",
                    "username"=>"postgres",
                    "password"=>"1234",

                )
            )

        );

    }

    protected function setup(){
        $this->src("automaker")
        ->query("SELECT  l.titulo_original, l.titulo_espanol,l.tema,l.sinopsis ,cl.nombre,l.nro_pags,e.nombre,lu.nombre, l.ano, lc.titulo_original
                FROM ofj_libro l ,ofj_editorial e,ofj_lugar lu,ofj_clase cl , (select cod,titulo_original from ofj_libro )lc
                WHERE l.cod=:codigo and l.fk_editorial=e.cod and e.fk_lugar =lu.codigo and l.fk_clase=cl.cod and l.fk_libro_comp=lc.cod")
                ->params(array(
                    ":codigo"=>$this->params["codigo"]
                ))
        ->pipe($this->dataStore("result"));
    }

}
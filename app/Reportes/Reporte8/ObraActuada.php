<?php

namespace App\Reportes\Reporte8;

class ObraActuada extends \koolreport\KoolReport
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
        ->query("SELECT o.titulo,o.resumen,o.precio,e.doc_lector_hist_lector,l.nombre1,l.apellido1  
            FROM ofj_elenco e ,ofj_obra_actuada o,ofj_lector l
            WHERE o.cod=:codigo and e.id_obra_elenco = o.cod and e.doc_lector_hist_lector = l.docidentidad")
            ->params(array(
                ":codigo"=>$this->params["codigo"]
            ))
        ->pipe($this->dataStore("result"));
    }

}
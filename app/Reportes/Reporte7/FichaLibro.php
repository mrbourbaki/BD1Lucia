<?php

namespace App\Reportes\Reporte7;
 

class FichaLibro extends \koolreport\KoolReport
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
        ->query("SELECT l.titulo_original, l.titulo_espanol,l.tema,l.sinopsis ,cl.nombre  ,l.nro_pags ,
        e.nombre,  lu.nombre , l.ano
                FROM ofj_libro l ,ofj_editorial e,ofj_lugar lu,ofj_clase cl 
                WHERE l.cod=:codigo and l.fk_editorial=e.cod and e.fk_lugar =lu.codigo and l.fk_clase=cl.cod")
                ->params(array(
                    ":codigo"=>$this->params["codigo"]
                ))
        ->pipe($this->dataStore("result"));


        $this->src("automaker")
        ->query("SELECT  nombre 
                FROM ofj_estructura
                WHERE id_libro=:codigo ")
                ->params(array(
                    ":codigo"=>$this->params["codigo"]
                ))
        ->pipe($this->dataStore("cap")); 

    }

}
<?php
namespace App\Reportes\Reporte4;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;    


class Inasistencias extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;

    function settings()
    {
        return array(
            "dataSources"=>array(
                "automaker" =>array(
                    "connectionString"=>"pgsql:host=localhost;port=5432;dbname=bd1lucia",
                    "username"=>"postgres",
                    "password"=>"1234"
                )
            )
        );
    }


    public function setup()
    {
        $this->src("automaker")
        ->query("SELECT   s.Nombre_lector AS Nombre, s.Apellido_Lector AS Apellido, ROUND((s.Inasistencias::DECIMAL/s.Cantidad_reuniones)*100) AS Porcentaje_inasistencias
        FROM (SELECT COUNT(l.docidentidad) AS Inasistencias,l.nombre1 AS Nombre_lector, l.apellido1 AS Apellido_lector, c.cantidad AS Cantidad_Reuniones
               FROM ofj_reunion r, ofj_inasistencia i, ofj_lector l, ofj_grupo_lectura g,(SELECT COUNT(r.id_grupo)  AS cantidad, r.id_club_grupo AS grupo FROM ofj_reunion r, ofj_grupo_lectura g WHERE g.cod=r.id_grupo AND r.fecha BETWEEN :fecha_inicio AND :fecha_fin  GROUP BY g.cod,grupo) c
               WHERE i.id_reunion=r.cod AND l.docidentidad=i.doc_lector AND g.cod=r.id_grupo AND g.cod=c.grupo AND g.id_club=:club
               GROUP BY   l.nombre1, l.apellido1, c.cantidad) s
        WHERE (s.Inasistencias::DECIMAL/s.Cantidad_reuniones) >= 0.30
        GROUP BY s.Nombre_lector, s.Apellido_lector, Porcentaje_inasistencias;")
        ->params(array(
        ":club"=>$this->params["club"],
        ":fecha_inicio"=>$this->params["fecha_inicio"],
        ":fecha_fin"=>$this->params["fecha_fin"],
        ))
        ->pipe($this->dataStore("result"));
    }
}
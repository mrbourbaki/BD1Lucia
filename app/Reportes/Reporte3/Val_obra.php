<?php
namespace App\Reportes\Reporte3;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;   
use App\Reportes\Reporte3\PostgreSQL;
use DB;

class Val_obra extends \koolreport\KoolReport
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
        ->query((DB::table('ofj_reunion')
                ->join('ofj_libro', 'ofj_reunion.id_libro', '=', 'ofj_libro.cod')
                ->select('ofj_libro.titulo_original')
                ->groupby('ofj_libro.cod')
                ->sum('ofj_reunion.valoracion')))

        ->pipe($this->dataStore("result"));
    }

}








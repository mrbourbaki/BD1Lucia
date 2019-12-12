<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table ='calendario';   
    
    protected $primaryKey = array('fecha', 'id_obra');

    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
    'hora_i' ,
    'estatus_realizada' ,
    'valoracion', 
    'cantidad_asistencia'
    ];
}

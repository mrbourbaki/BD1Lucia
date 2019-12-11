<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    protected $table ='obra_actuada';   
    
    protected $primaryKey = 'cod'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
    'resumen', 
    'precio' ,
    'titulo' ,
    'estatus_actividad' ,
    'duracion', 
    'fk_sala'
    ];
}

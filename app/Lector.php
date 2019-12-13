<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lector extends Model
{
    protected $table ='ofj_lector';   
    
    protected $primaryKey = 'docidentidad'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
        'docidentidad', 
        'fecha_nac' ,
        'nombre1' ,
        'apellido1' ,
        'apellido2', 
        'genero',
        'telefono',
        'fk_nacionalidad' ,
        'fk_rep',
        'fk_rep_externo',
        'nombre2'
        ];

}

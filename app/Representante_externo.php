<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representante_externo extends Model
{
    protected $table ='representante_externo';   
    
    protected $primaryKey = 'docidentidad'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
        'docidentidad', 
        'nombre1' ,
        'apellido1' ,
        'apellido2', 

        ];

}

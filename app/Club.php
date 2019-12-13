<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $table ='ofj_club';   
    
    protected $primaryKey = 'cod'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
    'codigo_postal', 
    'nombre' ,
    'direccion' ,
    'fk_lugar' ,
    'fk_institucion', 
    'cuota',
    ];
}
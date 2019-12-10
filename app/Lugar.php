<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    protected $table ='lugar';   
    
    protected $primaryKey = 'cod'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
    'nombre', 
    'tipo' ,
    'moneda' ,
    'nacionalidad' ,
    'idioma', 
    'fk_lugar',
    ];
}

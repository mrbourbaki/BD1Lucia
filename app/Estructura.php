<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estructura extends Model
{
    protected $table ='ofj_libro';   
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
    'cod', 
    'id_libro' ,
    'nombre' ,
    'tipo' ,
    'titulo'
    ];
}

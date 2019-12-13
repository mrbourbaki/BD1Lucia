<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table ='ofj_sala';   
    
    protected $primaryKey = 'cod'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
    'tipo', 
    'capacidad' ,
    'nombre' ,
    'direccion' ,
    'fk_lugar', 
    'fk_club' 
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo_lectura extends Model
{
    protected $table ='ofj_grupo_lectura';   
    
    protected $primaryKey = 'cod'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  // aqui deberan ir los atributos de las tablas lo que tengo entendido  
    ];

}

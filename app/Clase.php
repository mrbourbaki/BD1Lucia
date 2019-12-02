<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $table ='clase';   // hago referencia a la tabla de libro supuestamente 
    
    protected $primaryKey = 'cod'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  // aqui deberan ir los atributos de las tablas  lo que tengo entendido  
    'nombre', 
    'fk_clase' ,
    'tipo' ,
    ];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table ='libro';   // hago referencia a la tabla de libro supuestamente 
    
    protected $primaryKey = 'cod'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  // aqui deberan ir los atributos de las tablas  lo que tengo entendido  
    'titulo_original', 
    'sinopsis' ,
    'nro_pags' ,
    'ano' ,
    'titulo_espanol', 
    'tema',
    'fk_editorial',
    'fk_clase' ,
    'fk_libro_comp' 
    ];
}

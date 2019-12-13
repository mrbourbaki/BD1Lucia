<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table ='ofj_libro';   
    
    protected $primaryKey = 'cod'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
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

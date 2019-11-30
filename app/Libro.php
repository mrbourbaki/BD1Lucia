<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table ='libro';   // hago referencia a la tabla de  libro supuestamente 

    protected $primaryKey = 'id'; 

    protected $fillable =[  // aqui deberan ir los atributos de las tablas  lo que tengo entendido
        
    'nombre',
    'descripcion',

    ];
}

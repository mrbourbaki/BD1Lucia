<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    protected $table ='lugar';   
    
<<<<<<< HEAD
    protected $primaryKey = 'codigo'; 
=======
    protected $primaryKey = 'cod'; 
>>>>>>> d39700445ceb4c797ab750379c5b4fbd395751fd
    
    protected $hidden = [
    ];

    public $timestamps = false;

<<<<<<< HEAD
    protected $fillable = [  
    'nombre', 
    'tipo' ,
    'moneda' ,
    'nacionalidad' ,
    'idioma', 
    'fk_lugar',
    ];
=======
>>>>>>> d39700445ceb4c797ab750379c5b4fbd395751fd
}

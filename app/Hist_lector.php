<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table ='hist_lector';   
    
    protected $primaryKey = 'pk_hist_lector'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
    'fecha_ini', 
    'doc_lector' ,
    'id_club', 
    'estatus', 
    'motivo_retiro' ,
    'fecha_fin' 
    ];
}
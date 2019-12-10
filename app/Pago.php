<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table ='pago';   
    
    protected $primaryKey = ''; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
    'fecha_hist_lector', 
    'doc_lector_hist_lector' ,
    'id_club_hist_lector' ,
    'fecha_pago' ,
    'tipo_pago', 
    ];
}
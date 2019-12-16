<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table ='ofj_hist_grupo';   
    
    protected $primaryKey = 'pk_hist_grupo'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
 
    ];
}
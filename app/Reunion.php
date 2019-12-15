<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    protected $table ='ofj_reunion';   
    
    protected $primaryKey = 'cod'; 
    
    protected $hidden = [
    ];

    public $timestamps = false;

    protected $fillable = [  
        'id_grupo',
        'id_club_grupo',
        'id_grupo_hist_grupo',
        'id_club_hist_grupo',
        'fecha_hlector',
        'doc_lector',
        'id_club_hist_lector',
        'id_libro',
        'fecha',
        'conclusiones',
        'valoracion'
    ];
}
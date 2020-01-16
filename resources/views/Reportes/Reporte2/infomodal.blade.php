<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-info2{{$lector->docidentidad}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"> Ficha del Lector   </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>

            <div class="modal-body">
                <p> Documento de Identidad : {{$lector->docidentidad}}</p>
            </div>



            <div class="modal-body">
                <p> Nombres : {{$lector->nombre1}} {{DB::table('ofj_lector')->where('docidentidad','=', $lector->docidentidad)->value('nombre2')}} </p> 
            </div>

            <div class="modal-body">
                <p> Apellidos :  {{$lector->apellido1}}  , {{DB::table('ofj_lector')->where('docidentidad','=', $lector->docidentidad)->value('apellido2')}}</p> 
            </div>

            
            <div class="modal-body">
                <p> Fecha de Nacimiento : {{DB::table('ofj_lector')->where('docidentidad','=', $lector->docidentidad)->value('fecha_nac')}}</p>
            </div>

            <div class="modal-body">
                <p>  Telefono  : {{DB::table('ofj_lector')->where('docidentidad','=', $lector->docidentidad)->value('telefono')}}</p>
            </div>

            <div class="modal-body">
                <p>  Nacionalidad  : {{DB::table('ofj_lector')->where('docidentidad','=', $lector->docidentidad )
                                        ->join('ofj_lugar','ofj_lector.fk_nacionalidad', '=', 'ofj_lugar.codigo')->value('nombre')}}</p>
            </div>





            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
            </div>
        </div>
    </div>
</div>
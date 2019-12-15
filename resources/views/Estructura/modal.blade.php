<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$est->cod}}">

    <div class="modal-dialog">
        <form action="/Estructura/{{$est->cod}}" id="deleteForm" method="post"> {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE">

            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"> Eliminar Estrucutra : {{$est->nombre}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Esta seguro que desea eliminar '{{$este->nombre}}'?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary">Eliminar</button></a>
                </div>
            </div>
        </form> 
    </div>
</div>
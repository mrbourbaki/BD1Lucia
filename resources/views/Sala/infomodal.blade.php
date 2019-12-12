<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-info{{$sala->cod}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Sala: {{$sala->nombre}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>

            <div class="modal-body">
                <p> Capacidad: {{$sala->capacidad}}</p>
            </div>

            <div class="modal-body">
                <p> Tipo :  {{$sala->tipo}}</p>
            </div>

            <div class="modal-body">
                <p> Direccion :  {{$sala->direccion}}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
            </div>
        </div>
    </div>
</div>
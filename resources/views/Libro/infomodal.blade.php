<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-info{{$lib->cod}}" >

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>

                <h4 class="modal-title"> Libro : {{$lib->titulo_original}} </h4>
            </div>

            <div class="modal-body">
                <p>Titulo en Español :  {{$lib->titulo_espanol}}</p>
            </div>

            <div class="modal-body">
                <p>Sinopsis :  {{$lib->sinopsis}}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
            </div>
        </div>
    </div>
</div>

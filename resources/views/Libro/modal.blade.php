<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$lib->cod}}">

    <div class="modal-dialog">
    <form action="/Libro/{{$lib->cod}}" id="deleteForm" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="DELETE">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>

                <h4 class="modal-title"> Eliminar Libro: {{$lib->titulo_original}}</h4>
            </div>

            <div class="modal-body">
                <p>Esta seguro que desea eliminar '{{$lib->titulo_original}}'?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                <button class="btn btn-primary">Eliminar</button></a>


            </div>
        </div>
     </form> 
    </div>
</div>

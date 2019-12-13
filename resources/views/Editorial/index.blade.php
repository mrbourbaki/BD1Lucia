@extends('Layouts.admin')   <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de editoriales
                <a style="padding-left: 1%;" href="/Editorial/create">
                    <button type="button" class="btn btn-success">Nuevo Editorial</button>
                </a>
            </h3>
            @include ('Editorial.search') <!-- hago la llamdada a la plantilla del buscador que esta en esta carpeta y hara la funcion de buscar -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Opciones</th>
                    </thead>

                    <!--  Aqui debera ir el foreach para mostrar el contenido de las tablas -->
                    @foreach($editorial as $edi)
                        <tr>
                            <td>{{ $edi->nombre }}</td>
                            <td>{{ DB::table('ofj_lugar')->where('codigo', '=', $edi->fk_lugar)->value('nombre') }}</td>
                            <td>
                                <a href="{{route('Editorial.edit',$edi->cod)}}"><button class="btn btn-info">Editar</button></a>
                                <a data-target="#modal-delete-{{$edi->cod}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </td>
                        </tr>
                        @include('Editorial.modal') <!-- modal delete -->          
                    @endforeach
                </table>
            </div>
            {{$editorial->render()}} <!--Esto es la paginacion -->
        </div>
    </div>
@endsection <!-- fin de la etiqueta section-->

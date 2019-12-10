@extends('Layouts.admin')   <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de clases
                <a style="padding-left: 1%;" href="/Clase/create">
                    <button type="button" class="btn btn-success">Nueva Clase</button>
                </a>
            </h3>
            @include ('Clase.search') <!-- hago la llamdada a la plantilla del buscador que esta en esta carpeta y hara la funcion de buscar -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Opciones</th>
                    </thead>

                    <!--  Aqui debera ir el foreach para mostrar el contenido de las tablas -->
                    @foreach($clase as $clas)
                        <tr>
                            <td>{{ $clas->nombre }}</td>
                            <td>{{ $clas->tipo }}</td>
                            <td>
                                <a href="{{route('Clase.edit',$clas->cod)}}"><button class="btn btn-info">Editar</button></a>
                                <a data-target="#modal-delete-{{$clas->cod}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </td>
                        </tr>
                        @include('Clase.modal') <!-- modal delete -->          
                    @endforeach
                </table>
            </div>
            {{$clase->render()}} <!--Esto es la paginacion -->
        </div>
    </div>
@endsection <!-- fin de la etiqueta section-->

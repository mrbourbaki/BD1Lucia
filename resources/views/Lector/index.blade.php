@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3> Miembros
                <a style="padding-left: 1%;" href="/Lector/create">
                    <button type="button" class="btn btn-success">Nuevo lector</button>
                </a>
            </h3>
            @include ('Lector.search') <!-- hago la llamdada a la plantilla del buscador que esta en esta carpeta y hara la funcion de buscar -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Nombre de lector</th>
                        <th>Apellido de lector</th>
                        <th>Opciones</th>     
                    </thead>

                    <!--  Aqui debera ir el foreach para mostrar el contenido de las tablas -->
                    <!--  Libros as lib  significa etiqueta lib sera una etiqueta que hace referencia a la tabla de libro  -->
                    @foreach($lectores as $lec)
                        <tr>
                            <td>{{$lec->nombre1}}</td>
                            <td>{{$lec->apellido1}}</td>
                            <td>
                                <a href="{{route('Lector.edit',$lec->docidentidad)}}"><button class="btn btn-info">Editar</button></a>
                                <a data-target="#modal-delete-{{$lec->docidentidad}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                <a data-target="#modal-info{{$lec->docidentidad}}" data-toggle="modal"><button class="btn btn-primary">Informacion</button></a>
                            </td>
                        </tr>
                        @include('Lector.infomodal') <!-- info delete --> 
                        @include('Lector.modal') <!-- modal delete -->          
                    @endforeach
                </table>
            </div>
            {{$lectores->render()}}  <!--  Esto es la paginacion -->
        </div>
    </div>
@endsection <!-- fin de la etiqueta section-->

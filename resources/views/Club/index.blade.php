@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3> Clubes
                <a style="padding-left: 1%;" href="/Club/create">
                    <button type="button" class="btn btn-success">Nuevo club</button>
                </a>
            </h3>
            @include ('Club.search') <!-- hago la llamdada a la plantilla del buscador que esta en esta carpeta y hara la funcion de buscar -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Nombre de Club</th>
                        <th>Ubicación</th>
                        <th>Cantidad de miembros</th>
                        <th>Opciones</th>     
                    </thead>

                    <!--  Aqui debera ir el foreach para mostrar el contenido de las tablas -->
                    <!--  Libros as lib  significa etiqueta lib sera una etiqueta que hace referencia a la tabla de libro  -->
                    @foreach($clubes as $club)
                        <tr>
                            <td>{{$club->nombre}}</td>
                            <td>{{DB::table('lugar')->where('codigo','=', $club->fk_lugar)->value('nombre')}}</td>
                            <td>{{DB::table('hist_lector')->where('id_club','=', $club->cod)->count()}} </td>
                            <td>
                                <a href="{{route('Club.edit',$club->cod)}}"><button class="btn btn-info">Editar</button></a>
                                <a data-target="#modal-delete-{{$club->cod}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                <a data-target="#modal-info{{$club->cod}}" data-toggle="modal"><button class="btn btn-primary">Informacion</button></a>
                                <a href="filtraMiembro/{{$club->cod}}"><button class="btn btn-info">Agregar miembro</button></a>
                            </td>
                        </tr>
                        @include('Club.infomodal') <!-- info delete --> 
                        @include('Club.modal') <!-- modal delete -->          
                    @endforeach
                </table>
            </div>
            {{$clubes->render()}}  <!--  Esto es la paginacion -->
        </div>
    </div>
@endsection <!-- fin de la etiqueta section-->

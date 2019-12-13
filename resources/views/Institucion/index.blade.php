@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Instituciones 
                <a style="padding-left: 1%;" href="/Institucion/create">
                    <button type="button" class="btn btn-success">Nueva institucion </button>
                </a>
            </h3>
            @include ('Institucion.search') <!-- hago la llamdada a la plantilla del buscador que esta en esta carpeta y hara la funcion de buscar -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Nombre de la Institucion </th>
                        <th>Detalle</th>    
                    </thead>

                    <!--  Aqui debera ir el foreach para mostrar el contenido de las tablas -->
                    <!--  Libros as lib  significa etiqueta lib sera una etiqueta que hace referencia a la tabla de libro  -->
                    @foreach($institucion as $inst)
                        <tr>
                            <td>{{$inst->nombre}}</td>
                            <td>{{$inst->detalle}}</td>
                            <td>
                                <a href="{{route('Institucion.edit',$inst->cod)}}"><button class="btn btn-info">Editar</button></a>
                                <a data-target="#modal-delete-{{$inst->cod}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                <a data-target="#modal-info{{$inst->cod}}" data-toggle="modal"><button class="btn btn-primary">Informacion</button></a>
                            </td>
                        </tr>
                        @include('Institucion.infomodal') <!-- info --> 
                        @include('Institucion.modal') <!-- modal delete -->          
                    @endforeach
                </table>
            </div>
            {{$institucion->render()}} <!--Esto es la paginacion -->
        </div>
    </div>
@endsection <!-- fin de la etiqueta section-->

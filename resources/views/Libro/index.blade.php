@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
    
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3> Listado de libros <a href="/Libro/create"> <button type="button" class="btn btn-success"> Nuevo libro</button> </a> </h3>
            @include ('Libro.search') <!-- hago la llamdada a la plantilla del buscador que esta en esta carpeta y hara la funcion de buscar -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">

            <table class ="table table-striped table-bordered table-condensed table-hover">

                <thead>
                    <th>Titulo</th>
                    <th>tema</th>
                    <th>Opciones</th>     
                </thead>

                <!--  Aqui debera ir el foreach para mostrar el contenido de las tablas -->
                <!--  Libros as lib  significa etiqueta lib sera una etiqueta que hace referencia a la tabla de libro  -->
                @foreach($libros as $lib)
                <tr>
                    <td>{{$lib->titulo_original}}</td>
                    <td>{{$lib->tema}}</td>
                    <td>
                        <a href="/libro/editar"><button class="btn btn-info">Editar</button></a>
                        <a data-target="#modal-delete-{{$lib->cod}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                    </td>
                </tr>
               @include('Libro.modal') <!-- llama al modal que es la pantalla emergente -->
               @endforeach
            </table>
        </div>
    {{$libros->render()}} <!--Esto es la paginacion -->
    </div>
</div> 
@endsection <!-- fin de la etiqueta section-->

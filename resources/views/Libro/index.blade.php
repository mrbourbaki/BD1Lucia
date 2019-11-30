@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
    
  <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3> Listado de libros <a href="Libro/create"> <button type="button" class="btn btn-success"> Nuevo libro</button> </a> </h3>
                @include ('Libro.search') <!-- hago la llamdada a la plantilla del buscador que esta en esta carpeta -->
            </div>
           

        </div>
  </div>

  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="table-responsive">

            <table class ="table table-striped table-bordered table-condensed table-hover">

                <thead>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Opciones</th>     
                </thead>

            <!--  Aqui debera ir el foreach para mostrar el contenido de las tablas -->
            @foreach($libros as $cat)
                <tr>
                    <td>{{$cat->nombre}}</td>
                    <td>{{$cat->descripcion}}</td>
                    <td>
                        <a href=""><button class= "btn btn-info">Editar</button></a>
                        <a href=""><button class="btn btn-danger">Eliminar</button></a>
                    </td>
                </tr>
               @endforeach 
     
            </table>

        </div>

      </div>
  </div> 
@endsection <!-- fin de la etiqueta section-->
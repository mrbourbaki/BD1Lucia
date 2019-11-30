@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
    
  <div class="row">
        <div class="col-lg-8 col- md-8 col-sm-8 col-xs-12">

            <div>
                buscador
            </div>

            <div>
                <h3> Listado de libros <a href="Libro/create"> <button> Nuevo libro </button> </a> </h3>
                @include ('Libro.search')
            </div>
           

        </div>
  </div>

  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="responsive">

            <table class = "table table-striped table-bordered table-condensed table-hover">

            <thead>
    
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Opciones</th>     
            </thead>

     
            <tr>
    
                <td></td>
                <td></td>
                <td>
                    <a href=""><button class= "btn btn-info">Editar</button></a>
                    <a href=""><button class="btn btn-danger">Eliminar</button></a>
                </td>
            </tr>
      
            

            </table>

        </div>

      </div>
  </div> 
@endsection <!-- fin de la etiqueta section-->
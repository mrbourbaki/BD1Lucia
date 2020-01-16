@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3> Ficha del lector  </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                  
                        <th>Nombre del lector</th>
                        <th>Apellidos  del lector</th>
                        <th> Grupo al que pertenece</th>
                        <th> Tipo del grupo </th>         
                        <th> Dia de la semana </th>         
                        <th>  Hora incio de la reunion </th>         
                        <th>  Hora fin de la reunion </th>         
                    </thead>

                    <!--  Aqui debera ir el foreach para mostrar el contenido de las tablas -->
                    <!--  Libros as lib  significa etiqueta lib sera una etiqueta que hace referencia a la tabla de libro  -->
                    @foreach($lectores as $lector)
                        <tr>
                            <td>{{$lector->nombre1}}</td>
                            <td>{{$lector->apellido1}} , {{$lector->apellido2}}</td>
                            <td>{{$lector->id_grupo}}</td>
                            <td>{{$lector->tipo_grupo}}</td>
                            <td>{{$lector->dia}}</td>
                            <td>{{$lector->hora_ini}}</td>
                            <td>{{$lector->hora_fin}}</td>
                            
 
                        </tr>

                    @endforeach
                </table>
            </div>

    </div>
</div>

        </div>
    </div>
@endsection <!-- fin de la etiqueta section-->
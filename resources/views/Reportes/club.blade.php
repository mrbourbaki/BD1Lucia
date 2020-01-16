@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3> Clubes </h3>
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
                        <th>Opciones</th>     
                    </thead>

                    <!--  Aqui debera ir el foreach para mostrar el contenido de las tablas -->
                    <!--  Libros as lib  significa etiqueta lib sera una etiqueta que hace referencia a la tabla de libro  -->
                    @foreach($clubes as $club)
                        <tr>
                            <td>{{$club->nombre}}</td>
                            <td>{{DB::table('ofj_lugar')->where('codigo','=', $club->fk_lugar)->value('nombre')}}</td>
                            <td>
                                <a href="/reportesClub/{{$club->cod}}/pre4"><button class="btn btn-info">Inasistencias</button></a>
                                <a href="/reportesClub/{{$club->cod}}/pre_reporte3"><button class="btn btn-success">Obras analizadas</button></a>
                                <a href="/reportesClub/{{$club->cod}}/pre_reporte11"><button class="btn btn-warning">Obras actuadas</button></a>   
                            </td>
                        </tr>
          
                    @endforeach
                </table>
            </div>
            {{$clubes->render()}}  <!--  Esto es la paginacion -->
        </div>
    </div>
@endsection <!-- fin de la etiqueta section-->

@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3> Miembros  </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Documento identidad del lector</th> 
                        <th>Nombre del lector</th>
                        <th>Apellido del lector</th>   
                    </thead>

                    <!--  Aqui debera ir el foreach para mostrar el contenido de las tablas -->
                    <!--  Libros as lib  significa etiqueta lib sera una etiqueta que hace referencia a la tabla de libro  -->
                    @foreach($lectores as $lector)
                        <tr>
                            <td>{{$lector->docidentidad}}</td>
                            <td>{{$lector->nombre1}}</td>
                            <td>{{$lector->apellido1}}</td>
                            <td>
                                <a data-target="#modal-info2{{$lector->docidentidad}}" data-toggle="modal"><button class="btn btn-primary">Ficha miembro</button></a>
                                <a href="/reportesMiembro/{{$lector->docidentidad}}/prepagos"><button class="btn btn-warning">Pagos</button></a>
                                <a href="/reportesMiembro/{{$lector->docidentidad}}/preasistencias"><button class="btn btn-info">Asistencias</button></a>
                                <a href="/reportesMiembro/{{$lector->docidentidad}}/pregrupos"><button class="btn btn-success">Grupos</button></a> 
                                <a href="{{route( 'Reportelibrosanalizados', ['docid' => $lector->docidentidad]) }}"><button class="btn btn-danger">Libros analizados</button></a> 
                            </td>
                        </tr>
                        @include('Reportes.Reporte2.infomodal') <!-- info --> 
                    @endforeach
                </table>
            </div>

    </div>
</div>

        </div>
    </div>
@endsection <!-- fin de la etiqueta section-->

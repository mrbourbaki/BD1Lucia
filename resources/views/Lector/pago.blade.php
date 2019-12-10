@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3> Miembros
                <a style="padding-left: 1%;" href="/Lector/create">
                    <button type="button" class="btn btn-success">Control de pagos</button>
                </a>
            </h3>
  
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Fecha de pago</th>
                        <th>Tipo de pago </th>    
                    </thead>

                    <!--  Aqui debera ir el foreach para mostrar el contenido de las tablas -->
                    <!--  Libros as lib  significa etiqueta lib sera una etiqueta que hace referencia a la tabla de libro  -->
                    @foreach($pagos as $pago)
                        <tr>
                            <td>{{$pago->fecha_pago}}</td>
                            <td>{{$pago->tipo_pago}}</td>
                        </tr>
                        @include('Lector.infomodal') <!-- info delete --> 
                        @include('Lector.modal') <!-- modal delete -->          
                    @endforeach
                </table>
            </div>
            {{$pagos->render()}}  <!--  Esto es la paginacion -->
        </div>
    </div>
@endsection <!-- fin de la etiqueta section-->

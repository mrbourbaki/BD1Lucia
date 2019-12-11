@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')       <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3> Clubes
                <a style="padding-left: 1%;" href="/club/create">
                    <button type="button" class="btn btn-success">Nuevo club</button>
                </a>
            </h3>
 <!-- hago la llamdada a la plantilla del buscador que esta en esta carpeta y hara la funcion de buscar -->
        </div>
    </div>
    {!!Form::open(array('url'=>'/agregarMiembro/{{$club->cod}}','method'=>'GET', 'autocomplete'=> 'off'))!!}
        {{Form::token()}}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Documento de identidad</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                    </thead>

                        <tr>
                        </tr>         
                </table>
                    @foreach($lectores as $lec)
                        <input type="checkbox" name="nombre1" value="{{$lec->docidentidad}}">{{$lec->nombre1}}</td>
                    @endforeach
                <div class="form-group col-md-8">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-dager" type="reset">Cancelar</button>
                </div>
            </div>    
            {!!Form::close() !!}
            </div>
  <!--  Esto es la paginacion -->
        </div>
    </div>
@endsection <!-- fin de la etiqueta section-->

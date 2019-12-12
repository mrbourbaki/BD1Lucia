@extends('Layouts.admin') <!-- Esta etiqueta hace que extiendas de layouts que es el menu de todo el aplicativo -->

@section('contenido')     <!-- esta etiqueta permitira mostrar los diferentes contenidos de las diferentes pantallas en el layouts  -->
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Posibles miembros para el club</h3>
        </div>
    </div>
    {!!Form::open(array('url'=>'agregaMiembro/{{$club->cod}}','method'=>'POST', 'autocomplete'=> 'off'))!!}
    {{Form::token()}}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @foreach($lectores as $lec)
            <div class="form-group col-md-8">
                <input type="checkbox" name="docidentidad[]" value="{{$lec->docidentidad}}">{{$lec->nombre1}}</td>
            </div>
            @endforeach
            <div class="form-group col-md-8">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-dager" type="reset">Cancelar</button>
            </div>            
        </div>
    </div>
    {!!Form::close()!!}
@endsection <!-- fin de la etiqueta section-->

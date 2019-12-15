@extends('Layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg6 col-md-6 col-sm-6 col-xs-12">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!!Form::open(array('url'=>'Estructura','method'=>'POST', 'autocomplete'=> 'off'))!!}
            {{Form::token()}}
            <div class="form-group">
                <div class="form-row">
                    <h4>Informacion de la Estructura </h4>
                    <div class="form-group col-md-12">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Tiulo</label>
                        <input type="text" class="form-control" name="nombre" placeholder="">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Tipo de Estructura </label>
                        <select name="tipo"class="form-control" > 
                                <option value="CAPITULO">Capitulo</option>
                                <option value="SECCION">Seccion</option>
                                <option value="OTRO">Otro</option>
                        </select>
                    </div>

                    <h4>Libro a escoger </h4>
                    <div class="form-group col-md-12">
                        <label>Nombre de libros </label>
                        <select name="fk_libro"class="form-control" > 
                            @foreach($libro as $lib)
                                         <option value="{{$lib->cod}}" selected>{{ucwords(strtolower($lib->titulo_original))}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-8">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-default" type="reset" >Cancelar</button>
            </div>    
            {!!Form::close() !!}
        </div>
    </div>
@endsection
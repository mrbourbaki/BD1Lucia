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

            {!!Form::open(array('url'=>'Libro','method'=>'POST', 'autocomplete'=> 'off'))!!}
            {{Form::token()}}
            <div class="form-group">
                <div class="form-row">
                    <h4> Informacion del Libro </h4>
                    <div class="form-group col-md-12">
                        <label>Titulo</label>
                        <input type="text" class="form-control" name="titulo_original" placeholder="Guerra de 1984">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Titulo en español</label>
                        <input type="text" class="form-control" name="titulo_espanol" placeholder="Guerra de 1984">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Tema del libro </label>
                        <input type="text" class="form-control" name="tema" placeholder="Guerra">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Año del Libro</label>
                        <input type="text" class="form-control" name="ano" placeholder="1984">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Numero de paginas</label>
                        <input type="text" class="form-control" name="nro_pags" placeholder="Guerra de 1984">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Sinopsis</label>
                        <input type="text" class="form-control" name="sinopsis" placeholder="El libro trata de la guerra de 1984...">
                    </div>

                    <h4> Editorial </h4>
                    <div class="form-group col-md-12">
                        <label>Nombre del editorial</label>
                        <select name="fk_editorial"class="form-control" > 
                            @foreach($editorial as $edit)
                                <option value="{{$edit->cod}}">{{ucwords(strtolower($edit->nombre))}}</option>
                            @endforeach
                        </select>
                    </div>

                    <h4> Clase </h4>
                    <div class="form-group col-md-12">
                        <label>Nombre de la clase</label>
                        <select name="fk_clase"class="form-control"> 
                            @foreach($clase as $clas)
                                <option value="{{$clas->cod}}">{{ucwords(strtolower($clas->nombre))}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-8">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-dager" type="reset">Cancelar</button>
            </div>    
            {!!Form::close() !!}
        </div>
    </div>
@endsection
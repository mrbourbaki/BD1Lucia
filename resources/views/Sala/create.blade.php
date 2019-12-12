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

            {!!Form::open(array('url'=>'Sala','method'=>'POST', 'autocomplete'=> 'off'))!!}
            {{Form::token()}}
            <div class="form-group">
                <div class="form-row">
                    <h4>  Informacion de la Sala  </h4>
                    <div class="form-group col-md-12">
                        <label>Nombre de la sala</label>
                        <input type="text" class="form-control" name="nombre" placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label>capacidad</label>
                        <input type="number" class="form-control" name="capacidad" placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Direccion </label>
                        <input type="text" class="form-control" name="direccion" placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Tipo de La sala </label>
                        <input type="text"  class="form-control" name="tipo" placeholder="1984">
                    </div>

                    <h4>Club </h4>
                    <div class="form-group col-md-12">
                        <label> Club de pertenencia</label>
                        <select name="fk_club"class="form-control"> 
                            @foreach($club as $club)
                                <option value="{{$club->cod}}">{{ucwords(strtolower($club->nombre))}}</option>
                            @endforeach
                        </select>
                    </div>

                    <h4> Lugar </h4>
                    <div class="form-group col-md-12">
                        <label>Nombre del editorial</label>
                        <select name="fk_lugar"class="form-control" > 
                            @foreach($lugar as $lugar)
                                <option value="{{$lugar->cod}}">{{ucwords(strtolower($lugar->nombre))}}</option>
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
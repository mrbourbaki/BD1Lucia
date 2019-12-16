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

            <form action="Reunion/postIndex" method="post">
             {{ csrf_field() }}
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Nombre del Club </label>
                        <select name="club" class="form-control" > 
                            @foreach($clubes as $club )
                                <option value="{{$club->cod}}">{{ucwords(strtolower($club->nombre))}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Tipo de Club </label>
                        <select name="tipo"class="form-control" > 
                                <option value="NINO">Niño</option>
                                <option value="JOVEN">Joven</option>
                                <option value="ADULTO">Adulto</option>
                        </select>
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
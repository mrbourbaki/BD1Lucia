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

            {!!Form::open(array('url'=>'Editorial','method'=>'POST', 'autocomplete'=> 'off'))!!}
            {{Form::token()}}
            <div class="form-group">
                <div class="form-row">
                    <h4>Informacion del editorial</h4>
                    <div class="form-group col-md-12">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Editorial Planeta">
                    </div>

                    <h4>Lugar</h4>
                    <div class="form-group col-md-12">
                        <label>Nombre de la ciudad</label>
                        <select name="fk_lugar"class="form-control" > 
                            @foreach($lugar as $ciudad)
                                <option value="{{$ciudad->codigo}}">{{ucwords(strtolower($ciudad->nombre))}}</option>
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
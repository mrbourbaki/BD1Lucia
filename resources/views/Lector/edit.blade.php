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

            {!!Form::open(array('url'=>'Lector/{{$lector->docidentidad}}','method'=>'POST', 'autocomplete'=> 'off'))!!}
            {{Form::token()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <div class="form-row">
                    <h4> Información del Lector</h4>
                    <div class="form-group col-md-12">
                        <label>Primer nombre</label>
                        <input type="text" maxlength="15" class="form-control" name="nombre1" value = "{{$lector->nombre1}}"placeholder = "Campo obligatorio">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Segundo nombre</label>
                        <input type="text" maxlength="15" class="form-control" name="nombre2" value = "{{$lector->nombre2}}" placeholder = "Campo opcional">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Primer Apellido</label>
                        <input type="text" maxlength="15" class="form-control" name="apellido1" value = "{{$lector->apellido1}}" placeholder = "Campo obligatorio" >
                    </div>

                    <div class="form-group col-md-6">
                        <label>Segundo Apellido </label>
                        <input type="text" maxlength="15" class="form-control" name="apellido2" value = "{{$lector->apellido2}}" placeholder = "Campo obligatorio">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Documento de identidad</label>
                        <input type="number" maxlength="10" class="form-control" name="docidentidad" value = "{{$lector->docidentidad}}" placeholder = "Campo opcional">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Fecha de nacimiento</label>
                        <input type="date" min="01/01/1930" max= "31/12/2011" class="form-control" value = "{{$lector->fecha_nac}}" name="docidentidad" placeholder = "Campo opcional">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Número de teléfono </label>
                        <input type="number" maxlength="12" class="form-control" name="telefono" value = "{{$lector->telefono}}" placeholder = "Campo opcional">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Género </label>
                        <select name="genero"class="form-control" > 
                                <option value="'M'">Hombre</option>
                                <option value="'F'">Mujer</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label>País</label>
                        <select name="fk_nacionalidad"class="form-control"> 
                            @foreach($lugar as $lug)
                                <option value="{{$lug->codigo}}">{{ucwords(strtolower($lug->nombre))}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Representante </label>
                        @include('Lector.searchRep')
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
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

            {!!Form::open(array('url'=>'Club','method'=>'POST', 'autocomplete'=> 'off'))!!}
            {{Form::token()}}
            <div class="form-group">
                <div class="form-row">
                    <h4>Nuevo Club</h4>
                    <div class="form-group col-md-12">
                        <label>Nombre del club</label>
                        <input type="text" maxlength="15" class="form-control" name="nombre" placeholder = "Campo obligatorio">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Codigo postal</label>
                        <input type="text" maxlength="15" class="form-control" name="codigo_postal" placeholder = "Campo opcional">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Dirección</label>
                        <input type="text" maxlength="15" class="form-control" name="direccion" placeholder = "Campo obligatorio" >
                    </div>

                    <div class="form-group col-md-6">
                        <label>Cuota mensual</label>
                        <input type="number" min="0" max=10000 class="form-control" name="cuota" placeholder = "Campo obligatorio">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Ciudad de ubicación</label>
                        <select name="fk_lugar"class="form-control"> 
                            @foreach($lugar as $lug)
                                <option value="{{$lug->codigo}}">{{ucwords(strtolower($lug->nombre))}}</option>
                            @endforeach
                        </select>
                </div>

                    <div class="form-group col-md-12">
                        <label>Institución asociada</label>
                        <select name="fk_institucion"class="form-control"> 
                            @foreach($institucion as $ins)
                                <option value="{{$ins->codigo}}">{{ucwords(strtolower($ins->nombre))}}</option>
                            @endforeach
                        </select>

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
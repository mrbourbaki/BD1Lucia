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

            {!!Form::open(array('url'=>'Obra','method'=>'POST', 'autocomplete'=> 'off'))!!}
            {{Form::token()}}
            <div class="form-group">
                <div class="form-row">
                    <h4>Informacion de la Obra</h4>
                    <div class="form-group col-md-12">
                        <label>Titulo</label>
                        <input type="text" class="form-control" name="titulo" placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Duracion</label>
                        <input type="number" class="form-control" name="duracion" placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Precio</label>
                        <input  type="number" class="form-control" name="precio" placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Resuemn de la obra</label>
                        <input type="text" class="form-control" name="resumen" placeholder="">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Estatus  Error Aqui auque en el controlador se lo seleccione directo 1 </label>
                        <input type="number" class="form-control" name="estatus_actividad" placeholder="  Para cambiar estatus '1' o '0'">
                    </div>

                    <h4>Sala</h4>
                    <div class="form-group col-md-12">
                        <label>Nombre de la Sala </label>
                        <select name="fk_sala"class="form-control" > 
                            @foreach($sala as $sala )
                                <option value="{{$sala->cod}}">{{ucwords(strtolower($sala->nombre))}}</option>
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
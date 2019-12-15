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


             <form action="/Reunion" method="post">
             {{ csrf_field() }}
            <div class="form-group">
                <div class="form-row">
                    <h4>Informacion de la Reunion</h4>
                    <div class="form-group col-md-12">
                        <label>Grupo </label>
                        <select name="id_grupo"class="form-control" > 
                            @foreach($gruposNino as $grupo )
                                <option value="{{$grupo->cod}}">Grupo {{$grupo->cod}}</option>
                            @endforeach
                        </select>
                    </div>
 
                    <div class="form-group col-md-12">
                        <label>Fecha</label>
                        <input type="date" data-date-format="DD MMMM YYYY" min= "{{$today}}" name="fecha" class="form-control" name="resumen" placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label> Libro </label>
                        <select name="id_libro"class="form-control" > 
                            @foreach($libros as $lib )
                                <option value="{{$lib->cod}}">{{ucwords(strtolower($lib->nombre))}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label> Moderador </label>
                        <select name="fk_hist_lector"class="form-control" > 
                            @foreach($ $miembrosClub as $miembro )
                                <option value="{{$miembro->docidentidad}}">{{$miembro->docidentidad}}{{ucwords(strtolower($miembro->nombre1))}} {{ucwords(strtolower($miembro->apellido2))}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            <div class="form-group col-md-8">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-default" type="reset" >Cancelar</button>
            </div>    
            </form>
        </div>
    </div>
@endsection
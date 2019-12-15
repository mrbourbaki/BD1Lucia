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
                        <select name="grupo"class="form-control" > 
                            @foreach($gruposAdulto as $grupo )
                                <option value="{{$grupo->cod}}">Grupo {{$grupo->cod}}</option>
                            @endforeach
                            @foreach($gruposJoven as $grupo )
                                <option value="{{$grupo->cod}}">Grupo {{$grupo->cod}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Horario inicio (Formato 24 horas)</label>
                        <input  type="number" class="form-control" name="precio" placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Horario Fin (Formato 24 horas)</label>
                        <input type="number" class="form-control" name="resumen" placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label> Libro </label>
                        <select name="fk_libro"class="form-control" > 
                            @foreach($libros as $lib )
                                <option value="{{$lib->cod}}">{{ucwords(strtolower($lib->nombre))}}</option>
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
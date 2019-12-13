@extends('Layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg6 col-md-6 col-sm-6 col-xs-12">
        <h4>Editar Sala: {{$salaEdit->nombre}} </h4>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
           </div>
        </div>
        <!--<div style="margin-left:16%; margin-top:30px">-->
        <div id="formulario">
            <form action="/Sala/{{$salaEdit->cod}}" method="post">{{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group col-md-12">
                    <label> Lugar de la sala </label>
                    <select name="fk_lugar"class="form-control">
                        @foreach($lugar as $lug)
                            @if ($salaEdit->fk_lugar == $lug->codigo)
                                <option value="{{$lug->codigo}}" selected>{{ $lug->nombre }}</option>
                            @else
                                <option value="{{$lug->codigo}}">{{ $lug->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label>Tipo de sala</label>
                    <select name="tipo"class="form-control" >
                        @if ($salaEdit->tipo == "ALQUILADA")
                            <option value="ALQUILADA" selected>ALQUILADA</option>
                        @else
                            <option value="PROPIA">PROPIA</option>
                        @endif
                    </select>
                </div> 

                <div class="form-group col-md-12">
                    <label>Nombre del club</label>
                    <select name="fk_club"class="form-control" >
                        @foreach($club as $cl)
                            @if ($salaEdit->fk_club == $cl->cod)
                                <option value="{{$cl->cod}}" selected>{{ $cl->nombre }}</option>
                            @else
                                <option value="{{$cl->cod}}">{{ $cl->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <table>
                    <td>Nombre de la sala:</td>
                    <td>
                        <input type="text" class="form-control" name="nombre" value="{{$salaEdit->nombre}}" placeholder="">
                    </td>

                    <tr>
                        <td>Direccion:</td>
                        <td>
                            <input type="text" class="form-control" name="direccion" value="{{$salaEdit->direccion}}"placeholder="">
                        </td>
                    </tr>

                    <tr>
                        <td>Capacidad:</td>
                        <td>
                            <input type="text" class="form-control" name="capacidad" value="{{$salaEdit->capacidad}}"placeholder="">
                        </td>
                    </tr>

                </table>

                <br>

                <div class="form-group col-md-8">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-default" href="/Sala/">Volver</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('Layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg6 col-md-6 col-sm-6 col-xs-12">
        <h4>Editar Sala : {{$sala->nombre}} </h4>
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
            <form action="/Sala/{{$sala->cod}}" method="post">
            {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group col-md-12">
                    <label> Lugar de la sala </label>
                    <select name="fk_lugar"class="form-control">
                        @foreach($lugar as $lugar)
                            @if ($sala->fk_lugar == $lugar->lugar)
                                <option value="{{$lugar->cod}}" selected>{{ $lugar->nombre }}</option>
                            @else
                                <option value="{{$lugar->cod}}">{{ $lugar->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label>tipo de sala</label>
                    <select name="fk_club"class="form-control" >
                        @foreach($sala as $sala)
                            @if ($sala->tipo == "ALQUILADA")
                                <option value="{{$sala->tipo}}" selected>{{ $sala->tipo }}</option>
                            @else
                                <option value="{{$sala->tipo}}">{{ $sala->tipo }}</option>
                            @endif
                        @endforeach
                    </select>
                </div> 

                <div class="form-group col-md-12">
                    <label>Nombre del club</label>
                    <select name="fk_club"class="form-control" >
                        @foreach($club as $club)
                            @if ($sala->fk_club == $club->cod)
                                <option value="{{$club->cod}}" selected>{{ $club->nombre }}</option>
                            @else
                                <option value="{{$club->cod}}">{{ $club->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div> 

                


                <table>
                     <tr>
                        <td> Lugar :</td>
                        <td>
                            <input type="text" class="form-control" name="fk_lugar" value="{{$sala->fk_lugar}}" placeholder="">
                        </td>
                    </tr>

                    <tr>
                        <td> Club :</td>
                        <td>
                            <input type="text" class="form-control" name="titulo_original" value="{{$sala->fk_club}}" placeholder="">
                        </td>
                    </tr>

                    <td> Nombre de la sala:</td>
                    <td>
                        <input type="text" class="form-control" name="nombre" value="{{$sala->nombre}}" placeholder="">
                    </td>

                    <tr>
                        <td>Direccion:</td>
                        <td>
                            <input type="text" class="form-control" name="direccion" value="{{$sala->direccion}}"placeholder="">
                        </td>
                    </tr>

                    <tr>
                        <td>Capacidad: </td>
                        <td>
                            <input type="text" class="form-control" name="capacidad"  value="{{$sala->capacidad}}"placeholder="">
                        </td>
                    </tr>


                    <tr>
                        <td>Sinopsis:</td>
                        <td>
                            <input type="text" class="form-control" name="tipo" value="{{$sala->tipo}}" placeholder=".">
                        </td>
                    </tr>
                </table>

                <br>

                <div class="form-group col-md-8">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-default" href="/Libro/" >Volver</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('Layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg6 col-md-6 col-sm-6 col-xs-12">
        <h4>Obra a editar : {{$obra->titulo}} </h4>
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
            <form action="/Obra/{{$obra->cod}}" method="post">
            {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group col-md-12">
                    <label>Nombre del editorial</label>
                    <select name="fk_sala"class="form-control">
                        @foreach($obra )
                            @if ($obra->fk_sala == $sala->cod)
                                <option value="{{$sala->cod}}" selected>{{ $sala->nombre }}</option>
                            @else
                                <option value="{{$sala->cod}}">{{ $sala->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>


                <table>
                     <tr>
                        <td>Sala:</td>
                        <td>
                            <input type="text" class="form-control" name="fk_editorial" value="{{$obra->fk_sala}}" placeholder="Guerra de 1984">
                        </td>
                    </tr>

                    <tr>
                        <td>Titulo de la obra </td>
                        <td>
                            <input type="text" class="form-control" name="titulo" value="{{$obra->titulo}}" placeholder="Guerra de 1984">
                        </td>
                    </tr>

                    <td>Fecha de publicación:</td>
                    <td>
                        <input type="text" class="form-control" name="ano" value="{{$obra->resumen}}" placeholder="1950">
                    </td>

                    <tr>
                        <td>Titulo en espanol:</td>
                        <td>
                            <input type="text" class="form-control" name="titulo_espanol" value="{{$obra->precio}}"placeholder="Guerra de 1984">
                        </td>
                    </tr>

                    <tr>
                        <td>Tema del libro: </td>
                        <td>
                            <input type="text" class="form-control" name="tema"  value="{{$obra->duracion}}"placeholder="Guerra">
                        </td>
                    </tr>

                    <tr>
                        <td>Numero de paginas:</td>
                        <td>
                            <input type="text" class="form-control" name="nro_pags" value="{{$obra->estatus_actividad}}" placeholder="Guerra de 1984">
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

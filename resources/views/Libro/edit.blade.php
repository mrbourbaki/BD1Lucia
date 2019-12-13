@extends('Layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg6 col-md-6 col-sm-6 col-xs-12">
        <h4>Libro a editar : {{$libro->titulo_original}} </h4>
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
            <form action="/Libro/{{$libro->cod}}" method="post">{{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group col-md-12">
                    <label>Nombre del editorial</label>
                    <select name="fk_editorial"class="form-control">
                        @foreach($editorial as $edi)
                            @if ($libro->fk_editorial == $edi->cod)
                                <option value="{{$edi->cod}}" selected>{{ $edi->nombre }}</option>
                            @else
                                <option value="{{$edi->cod}}">{{ $edi->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label>Nombre de la clase</label>
                    <select name="fk_clase"class="form-control" >
                        @foreach($clase as $clas)
                            @if ($libro->fk_clase == $clas->cod)
                                <option value="{{$clas->cod}}" selected>{{ $clas->nombre }}</option>
                            @else
                                <option value="{{$clas->cod}}">{{ $clas->nombre }}</option>
                            @endif
                        @endforeach
                    </select>

                <table>
                     <tr>
                        <td>Editorial:</td>
                        <td>
                            <input type="text" class="form-control" name="fk_editorial" value="{{$libro->fk_editorial}}" placeholder="Guerra de 1984">
                        </td>
                    </tr>

                    <tr>
                        <td>Titulo original:</td>
                        <td>
                            <input type="text" class="form-control" name="titulo_original" value="{{$libro->titulo_original}}" placeholder="Guerra de 1984">
                        </td>
                    </tr>

                    <td>Fecha de publicación:</td>
                    <td>
                        <input type="text" class="form-control" name="ano" value="{{$libro->ano}}" placeholder="1950">
                    </td>

                    <tr>
                        <td>Titulo en espanol:</td>
                        <td>
                            <input type="text" class="form-control" name="titulo_espanol" value="{{$libro->titulo_espanol}}"placeholder="Guerra de 1984">
                        </td>
                    </tr>

                    <tr>
                        <td>Tema del libro: </td>
                        <td>
                            <input type="text" class="form-control" name="tema"  value="{{$libro->tema}}"placeholder="Guerra">
                        </td>
                    </tr>

                    <tr>
                        <td>Numero de paginas:</td>
                        <td>
                            <input type="text" class="form-control" name="nro_pags" value="{{$libro->nro_pags}}" placeholder="Guerra de 1984">
                        </td>
                    </tr>

                    <tr>
                        <td>Sinopsis:</td>
                        <td>
                            <input type="text" class="form-control" name="sinopsis" value="{{$libro->sinopsis}}" placeholder="El libro trata de la guerra de 1984...">
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
@extends('Layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg6 col-md-6 col-sm-6 col-xs-12">
        <h4>Clase a editar : {{$clase->nombre}} </h4>
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
            <form action="/Clase/{{ $clase->cod }}" method="post">{{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group col-md-12">
                    <label>Clase Padre</label>
                    <select name="fk_clase" class="form-control" >
                        @foreach($clasesPadre as $clas)
                            @if ($clas->cod == $clase->fk_clase)
                                <option value="{{ $clas->cod }}" selected>{{ $clas->nombre }}</option>
                            @else
                                <option value="{{ $clas->cod }}">{{ $clas->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <table>
                        <tr>
                            <label>Nombre</label>
                            <td>
                                <input type="text" class="form-control" name="nombre" value="{{$clase->nombre}}" placeholder="Novela">
                            </td>
                        </tr>
                    </table>
                </div>

                <br>

                <div class="form-group col-md-8">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-default" href="/Clase/" >Volver</button>
                </div>
            </form>
        </div>
    </div>
@endsection
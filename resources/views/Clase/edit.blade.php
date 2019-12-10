@extends('Layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg6 col-md-6 col-sm-6 col-xs-12">
        <h4>Editorial a editar : {{$editorial->nombre}} </h4>
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
            <form action="/Editorial/{{ $editorial->cod }}" method="post">{{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group col-md-12">
                    <label>Nombre de la ciudad</label>
                    <select name="fk_lugar" class="form-control" > 
                        @foreach($lugar as $lug)
                            @if ($editorial->fk_lugar == $lug->codigo)
                                <option value="{{$lug->codigo}}" selected>{{ $lug->nombre }}</option>
                            @else
                                <option value="{{$lug->codigo}}">{{ $lug->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <table>
                    <tr>
                        <td>Nombre:</td>
                        <td>
                            <input type="text" class="form-control" name="nombre" value="{{$editorial->nombre}}" placeholder="Editorial Cool">
                        </td>
                    </tr>
                </table>

                <br>

                <div class="form-group col-md-8">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-default" href="/Editorial/" >Volver</button>
                </div>
            </form>
        </div>
    </div>
@endsection
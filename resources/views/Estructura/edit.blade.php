@extends('Layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg6 col-md-6 col-sm-6 col-xs-12">
        <h4> Estructura a editar: {{$est->titulo}} </h4>
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
            <form action="/Estructura/{{ $est->cod }}" method="post">{{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group col-md-12">
                    <label>Nombre del Libro</label>
                    <select name="id_libro" class="form-control" > 
                        @foreach($libro as $lib)
                            @if ($est->fk_lugar == $lib->cod)
                                <option value="{{$lib->cod}}" selected>{{ $lib->titulo_original }}</option>
                            @else
                                <option value="{{$lib->cod}}">{{ $lib->titulo_original }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-8">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="{{$est->nombre}}" placeholder=" ">
                </div>

                <div class="form-group col-md-8">
                    <label>Titulo:</label>
                    <input type="text" class="form-control" name="titulo" value="{{$est->titulo}}" placeholder=" ">
                </div>

                <div class="form-group col-md-12">
                        <label>Tipo de Estructura </label>
                        <select name="tipo"class="form-control" > 
                                <option value="CAPITULO">Capitulo</option>
                                <option value="SECCION">Seccion</option>
                                <option value="OTRO">Otro</option>
                        </select>
                </div>

                <br>

                <div class="form-group col-md-8">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-default" href="/Editorial/" >Volver</button>
                </div>
            </form>
        </div>
    </div>
@endsection
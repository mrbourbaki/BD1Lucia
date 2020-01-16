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

            <div id="formulario">
                <form action= "/reportesMiembro/{{$docid}}/asistencias" method="post">{{ csrf_field() }}
                <div class="form-group">
                    <div class="form-row">
                        <h4>Seleccione las  siguientes opciones:</h4>
            
                        <div class="form-group col-md-12">
                        <label>Clubes de lectura</label>
                        <select name="id_club"class="form-control"> 
                            @foreach($clubes as $club)
                                <option value="{{$club->cod}}">{{$club->nombre}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="caja">
                            <label>Fecha inicio</label>
                            <input type="date" data-date-format="DD-MM-YYYY"  class="form-control" name="fecha_ini" placeholder = "Campo obligatorio">
                        </div>
                        <div class="caja">
                            <label>Fecha fin</label>
                            <input type="date" data-date-format="DD-MM-YYYY"  class="form-control" name="fecha_fin" placeholder = "Campo obligatorio">
                        </div>

                </div>

                    <div class="form-group col-md-8">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button class="btn btn-dager" type="reset">Cancelar</button>
                    </div>    
                </form>
            </div>
        </div>
    </div>
@endsection
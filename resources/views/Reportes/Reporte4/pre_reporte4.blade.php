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
                <form action="/reportesClub/pre4/{{$codigo}}/reporte4" method="post">{{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <div class="form-row">
                        <h4>En el siguiente reporte se visualizarán los miembros del club que posean 30% o más de inasistencia </h4>
                        <h4>Seleccione una opción:</h4>
                        <div class="form-group col-md-12">
                            <label>Periodo bimestral</label>
                            <select name="fecha" class="form-control"> 
                                <option value="01-01-2019|28-02-2019">ENERO-FEBRERO 2019</option>
                                <option value="01-03-2019|30-04-2019">MARZO-ABRIL 2019</option>
                                <option value="01-05-2019|30-06-2019">MAYO-JUNIO 2019</option>
                                <option value="01-07-2019|31-08-2019">JULIO-AGOSTO 2019</option>
                                <option value="01-09-2019|31-10-2019">SEPTIEMBRE-OCTUBRE 2019</option>
                                <option value="01-11-2019|31-12-2019">NOVIEMBRE-DICIEMBRE 2019</option>
                            </select>
                        </div>
                        <?php         
                                $fecha="01-01-2019|28-02-2019";
                                $fecha_explode = explode('|',$fecha);
                                echo $fecha_explode[0];
                                echo "xdddddddddddddd";
                                echo $fecha_explode[1];
                        ?>
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
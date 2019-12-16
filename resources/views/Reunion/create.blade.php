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
                        <label>Fecha</label>
                        <input type="date" data-date-format="DD MMMM YYYY"  name="fecha" class="form-control" name="resumen" placeholder="">
                    </div>  
                    <div class="form-group col-md-12">
                        <label> Libro </label>
                        <select name="fk_libro"class="form-control" > 
                            @foreach($libros as $lib)
                                <option value="{{$lib->cod}}">{{ucwords(strtolower($lib->titulo_original))}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label> Valoración </label>
                        <select name="valoracion"class="form-control" > 
                        <option disabled selected value> -- OPCIONAL -- </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Conclusión</label>
                        <input type="text"   name="conclusiones" class="form-control"  placeholder="Campo opcional">
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
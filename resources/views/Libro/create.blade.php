@extends('Layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg6 col-md-6 col-sm-6 col-xs-12">
            <h3> Create de lector</h3>

            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {!!Form::open(array('url'=>'Libro','method'=>'POST', 'autocomplete'=> 'off'))!!}
             {{Form::token()}}
                <div class="form-group">
                    <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder=" harry poter">
                            </div>

                            <div class="form-group col-md-6">
                                    <label for="inputPassword4">Descripcion</label>
                                    <input type="text" class="form-control" name="descripcion" placeholder="le gusta">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder=" harry poter">
                            </div>

                            <div class="form-group col-md-6">
                                    <label for="inputPassword4">Descripcion</label>
                                    <input type="text" class="form-control" name="descripcion" placeholder="le gusta">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder=" harry poter">
                            </div>

                            <div class="form-group col-md-6">
                                    <label for="inputPassword4">Descripcion</label>
                                    <input type="text" class="form-control" name="descripcion" placeholder="le gusta">
                            </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-dager" type="reset">Cancelar</button>
                </div>    
            {!!Form::close() !!}

         </div>   
    </div>
    
@endsection
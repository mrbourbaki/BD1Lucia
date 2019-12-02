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


            {!!Form::open(array('url'=>'Libro','method'=>'POST', 'autocomplete'=> 'off'))!!}
             {{Form::token()}}
                <div class="form-group">
                    <div class="form-row">
                        <h4> Informacion del Libro </h4>
                            <div class="form-group col-md-6">
                                <label > Titulo</label>
                                <input type="text" class="form-control" name="titulo_original" placeholder=" harry poter">
                            </div>


                            <div class="form-group col-md-6">
                                    <label >Año del Libro</label>
                                    <input type="text" class="form-control" name="ano" placeholder="le gusta">
                            </div>

                            <div class="form-group col-md-6">
                                <label >Titulo en español</label>
                                <input type="text" class="form-control" name="titulo_espanol" placeholder=" harry poter">
                            </div>

                            <div class="form-group col-md-6">
                                    <label >Tema del libro </label>
                                    <input type="text" class="form-control" name="tema" placeholder="le gusta">
                            </div>

                            <div class="form-group col-md-12">
                                    <label >Sinopsis</label>
                                    <input type="text" class="form-control" name="sinopsis" placeholder="">
                            </div>


                            <h4> Editorial </h4>
                            <div class="form-group col-md-4">
                                <label>Nombre del editorial</label>
                           {{--       <select name="cod"class="form-control"> 
                                       @foreach($editorial as $edit)
                                       <option value="{{$cat->cod}}">{{$edit->nombre}}</option>
                                    @endforeach
                                   </select>--}}
                                 
                                        <select id="inputState" class="form-control">
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>

                            </div>

                            <div class="form-group col-md-4">
                                    <label > Direccion</label>
                                    <input type="text" class="form-control" name="sinopsis" placeholder="">
                            </div>


                            <div class="form-group col-md-4">
                                    <label for="inputPassword4">Ciuedad/Pais</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="le gusta">
                            </div>


                    </div>
                </div>

                <div class="form-group col-md-8">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-dager" type="reset">Cancelar</button>
                </div>    
            {!!Form::close() !!}

         </div>  

           
    </div>
    
@endsection
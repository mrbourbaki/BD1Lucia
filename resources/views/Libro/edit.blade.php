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
             <!--   <div style="margin-left:16%; margin-top:30px">-->
                    <div id="formulario">
                        <form action="/Libro/{{$libro->cod}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <table>
                                <tr>
                                    <td>Titulo original :</td>
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
                                    <td>Tema del libro : </td>
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
                            </div>

                            <div class="form-group col-md-12">
                                <label>Nombre del editorial</label>
                                     <select name="fk_editorial"class="form-control"> 
                                        @foreach($editorial as $edit)
                                            <option value=>{{$edit->nombre}}</option>
                                        @endforeach
                                     </select>
                             </div>

                             <div class="form-group col-md-12">
                                 <label>Nombre de la clase</label>
                                      <select name="fk_clase"class="form-control" > 
                                         @foreach($clase as $clas)
                                             <option value=>{{$clas->nombre}}</option>
                                         @endforeach
                                      </select>
 
                              </div>

                            </table>
                                    <div class="form-group col-md-8">
                                         <button class="btn btn-primary" type="submit">Guardar</button>
                                         <td><a href="/Libro/">Volver</td>
                                     </div>  
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
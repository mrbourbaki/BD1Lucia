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

             <div class="form-group">
                <div class="form-row">
                    <h4>Ficha del Libro </h4>
            
                   
                 <div class="form-group col-md-8">
                     <button class="btn btn-dager" type="reset">volver</button>
                </div>    
        </form>
        </div>
        </div>
    </div>
@endsection
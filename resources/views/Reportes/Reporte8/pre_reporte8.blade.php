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
                    <div class="form-group col-md-12">
                                <label>Elegir fecha que se presento  </label>
                                <select name="fecha" class="form-control" > 
                                    @foreach($calendario as $cal)
                                            <option value="{{$cal->fecha}}" selected>{{ $cal->fecha }}</option>         
                                    @endforeach
                                </select>
                            </div>

                    <div class="form-group col-md-8">
                        <button class="btn btn-primary" type="submit">filtrar </button>

                    </div>    
                </form>
            </div>
        </div>
    </div>
@endsection
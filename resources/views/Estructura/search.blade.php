{!! Form::open(array('url'=>'Estructura','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
    <div class="form-group">
        <div class="input-group">
            <input type="text" class= "form-control" name="searchText" value ="{{$searchText}}">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-dark">Buscar</button>
            </span>
        </div>
    </div>
{{Form::close()}}
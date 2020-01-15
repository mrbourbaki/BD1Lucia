<style>
		.table {
			width: 100%;
			border: 1px solid #999999;
		}
		div.a {
  			text-transform: capitalize;
		}
</style>
<body>
<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
           <center> <h2> Historial de grupos </h3> </center>
        </div>
		<div class="a"> 
            @foreach($lector as $lec)
			<h5> Miembro: {{$lec->nombre}} {{$lec->apellido}} </h5>
            @endforeach
		</div>
		<div class="a"> 
            @foreach($club as $cl)
			<h5> Club: {{$cl->nombre}}  </h5>
            @endforeach
		</div>
    </div>
	<table class="table">
		<thead>
			<tr>
				<th>ID Grupo</th>
				<th>Fecha de ingreso </th>
                <th>Fecha de egreso </th>
			</tr>
		</thead>
		<tbody>
			@foreach($grupos as $grupo)
			<tr>
			<td>{{$grupo->grupo}}</td>
            <td>{{$grupo->fecha_ini}}</td>
            <td>{{$grupo->fecha_fin}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
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
           <center> <h2> Miembros con 30% o más de inasistencias: </h3> </center>
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
				<th>Nombre y Apellido del miembro</th>
				<th>Porcentaje de inasistencias</th>
			</tr>
		</thead>
		<tbody>
			@foreach($inasistencias as $ina)
			<tr>
			<td>{{$ina->nombre}},{{$ina->apellido}}</td>
            <td>{{$ina->porcentaje}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
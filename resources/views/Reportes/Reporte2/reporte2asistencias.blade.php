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
           <center> <h2> Historial de asistencias </h3> </center>
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
				<th>ID Reunión</th>
				<th>Fecha de asistencia </th>
			</tr>
		</thead>
		<tbody>
			@foreach($asistencias as $asistencia)
			<tr>
			<td>{{$asistencia->id_reunion}}</td>
            <td>{{$asistencia->fecha_reunion}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
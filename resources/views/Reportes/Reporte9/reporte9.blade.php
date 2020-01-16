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
           <center> <h2> Presentaciones obra actuada con mejor actor: </h3> </center>

           <h4>Nombre de la obra:{{$obras[0]->titulo}}</h4>
           <h4> Periodo de consulta: {{$fechainicio}} al {{$fechafinal}} </h4>
        </div>

	<table class="table">
		<thead>
			<tr>
				<th>Valoración obra actuada</th>
				<th>Nombre actor</th>
                <th>Valoración general</th>
			</tr>
		</thead>
		<tbody>
			@foreach($presentaciones as $pre)
			<tr>
			<td>{{$pre->valoracion_obra}}</td>
            <td>{{$pre->nombre}}, {{$pre->apellido}}</td>
            <td>{{$pre->valoracion_global}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
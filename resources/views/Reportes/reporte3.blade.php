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
           <center> <h2> Listado de libros analizados ordenados por valoración </h3> </center>
        </div>
		<div class="a"> 
			<h5> CLUB: {{$club->nombre}} </h3>
		</div>
    </div>
	<table class="table">
		<thead>
			<tr>
				<th>Valoración</th>
				<th>Nombre original</th>
			</tr>
		</thead>
		<tbody>
			@foreach($obras as $obra)
			<tr>
			<td>{{$obra->valoracion}}</td>
            <td>{{$obra->nombre_libro}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
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
           <center> <h2> Obras actuadas con ingresos generados: </h3> </center>
        </div>
		<div class="a"> 
			@foreach($club as $cl)
			<h5> Club: {{$cl->nombre}}  </h5>
            @endforeach
            <h5>Periodo de consulta: {{$fechainicio}} al {{$fechafinal}}</h5>
		</div>
    </div>
	<table class="table">
		<thead>
			<tr>
				<th>Título original del libro</th>
				<th>Ganancias generadas</th>
			</tr>
		</thead>
		<tbody>
			@foreach($obras as $obra)
			<tr>
			<td>{{$obra->titulo}}</td>
            <td>{{$obra->ganancias}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
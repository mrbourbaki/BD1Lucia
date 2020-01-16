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
           <center> <h2> Historial de pagos </h3> </center>
        </div>
		<div class="a"> 
            @foreach($lector as $lec)
			<h5> Miembro: {{$lec->nombre}} {{$lec->apellido}} </h5>
            @endforeach
			@foreach($club as $cl)
			<h5> Club: {{$cl->nombre}}  </h5>
            @endforeach
			<h5>Periodo de consulta: {{$fechainicio}} al {{$fechafinal}}</h5> 
		</div>

    </div>
	<table class="table">
		<thead>
			<tr>
				<th>Comprobante de pago</th>
				<th>Fecha del pago </th>
                <th>Tipo de pago </th>
			</tr>
		</thead>
		<tbody>
			@foreach($pagos as $pago)
			<tr>
			<td>{{$pago->numero_pago}}</td>
            <td>{{$pago->fecha_pago}}</td>
            <td>{{$pago->tipo_pago}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
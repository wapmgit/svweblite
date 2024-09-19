@extends ('layouts.master')
@section ('contenido')
@include('almacen.articulo.empresa')
<div>
	<div class="col-lg-12 col-md-2 col-sm-12 col-xs-12">
		<h3>Ajustes 
		@if($rol->crearajuste==1) <a href="{{route('newajuste')}}"><button class="btn btn-primary btn-sm">Nuevo</button></a>@endif</h3>
		@include('compras.ajuste.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Responsable</th>
					<th>Valorizado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ajustes as $ing)
				<tr>
					
					<td><?php echo date("d-m-Y h:i:s a",strtotime($ing->fecha_hora)); ?></td>
					<td>{{ $ing->concepto}}</td>
					<td>{{ $ing->responsable}}</td>
					<td><?php echo number_format( $ing->monto, 2,',','.'); ?></td>
				
				
					<td>
					<a href="{{route('etiquetasajuste',['id'=>$ing->idajuste])}}" ><button class="btn btn-secondary btn-xs"> Etiquetas</button></a>
				<a href="{{route('showajuste',['id'=>$ing->idajuste])}}"><button class="btn btn-primary btn-xs">Detalles</button></a>
					</td>
				</tr>
			@include('compras.ajuste.modal')
				@endforeach
			</table>
		</div>
		{{$ajustes->render()}}
	</div>
</div>

@endsection
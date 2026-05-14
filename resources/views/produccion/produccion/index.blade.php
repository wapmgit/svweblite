@extends ('layouts.master')
@section ('contenido')
@include('almacen.articulo.empresa')
<?php
$ceros=5;
function add_ceros($numero,$ceros) {
  $numero=$numero;
$digitos=strlen($numero);
  $recibo=" ";
  for ($i=0;$i<8-$digitos;$i++){
    $recibo=$recibo."0";
  }
return $insertar_ceros = $recibo.$numero;
};
?>
<div>
	<div class="col-lg-12 col-md-2 col-sm-12 col-xs-12">
		<h3>Produccion basica 
		@if($rol->newproduccion==1) <a href="{{route('newproduccion')}}"><button class="btn btn-primary btn-sm">Nuevo</button></a>@endif</h3>
		@include('compras.ajuste.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				
					<th>Fecha</th>
					<th>Documento</th>
					<th>Concepto</th>
					<th>Responsable</th>
					<th>Valorizado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($data as $ing)
				<tr>
					
					<td><?php echo date("d-m-Y",strtotime($ing->fecha)); ?></td>
					<td><?php echo add_ceros($ing->controlp,$ceros); ?></td>
					<td>{{ $ing->concepto}}</td>
					<td>{{ $ing->responsable}}</td>
					<td><?php echo number_format( $ing->valor, 2,',','.'); ?></td>				
					<td>
				<a href="{{route('showproduccion',['id'=>$ing->idproduccion])}}"><button class="btn btn-primary btn-xs">Detalles</button></a>
					</td>
				</tr>

				@endforeach
			</table>
		</div>
		{{$data->render()}}
	</div>
</div>

@endsection
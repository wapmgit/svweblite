@extends ('layouts.master')
@section ('contenido')
@include('almacen.articulo.empresa')
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Gastos
		@if($rol->creargasto==1)<a href="{{route('newgasto')}}"><button class="btn btn-primary btn-sm">Nuevo</button></h3>@endif</a>
		@include('gastos.gasto.search')
	</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				
					<th>Fecha</th>
					<th>Documento</th>
					<th>Razon</th>
					<th>Monto</th>
					<th>Por Pagar</th>
					<th>Opciones</th>
				</thead>
               @foreach ($gasto as $ing)
				<tr>
					
					<td><?php echo date("d-m-Y",strtotime($ing->fecha)); ?></td>
					<td>{{ $ing->documento}}</td>

					<td>{{ $ing->nombre}}</td>
					<td><?php echo number_format( $ing->monto, 2,',','.'); ?></td>
					<td><?php echo number_format( $ing->saldo, 2,',','.'); ?></td>
				
				
					<td><?php if($ing->estatus==0){ ?>
					@if($rol->anulargasto==1)<a href="" data-target="#modal-delete-{{$ing->idgasto}}" data-toggle="modal" ><button class="btn btn-danger btn-xs">Anular</button></a>@endif	<?php } else {?>
					<button class="btn btn-warning btn-xs">Anulado</button> <?php } 
					$direccion=$ing->idgasto."-1";
					?>
				<a href="{{route('showgasto',['id'=>$direccion])}}"><button class="btn btn-primary btn-xs">Detalles</button></a>
					</td>
				</tr>
				@include('gastos.gasto.modal')
				@endforeach
			</table>
		</div>
		{{$gasto->render()}}
	</div>
</div>

@endsection
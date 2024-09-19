@extends ('layouts.master')
@section ('contenido')
	<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Cuentas por Pagar </h3>
		@include('proveedores.pagar.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					
					<th>Nombre</th>
					<th>Rif</th>
					<th>Telefono</th>
					<th>Monto</th>
					<th>Opciones</th>
				</thead>
				<?php $acumnd=$acumnc=0; $tmonto=$nc=0;?>
               @foreach ($proveedores as $cat)
			   <?php $tmonto=($tmonto+$cat->acumulado); $nd=$nc=0;?>
				<tr>
					
					<td><small>{{ $cat->nombre}}</small></td>
					<td><small>{{ $cat->rif}}</small></td>
					<td><small>{{ $cat->telefono}}</small></td>
					 <td><?php echo number_format($cat->acumulado, 2,',','.')." $";?></td>
			<td>@if($rol->abonarcxp==1)	<a href="{{route('showcxp',['id'=>$cat->idproveedor])}}"><button class="btn btn-info btn-xs">Abono</button></a>@endif
			@if($rol->crearcompra==1)	<a href="{{route('faccompra',['id'=>$cat->idproveedor])}}"><button class="btn btn-success btn-xs">Facturar</button></a>@endif
                  
					</td>
				</tr>
				@endforeach
				
				<tr><td colspan="5"> <button class="btn bg-olive btn-flat margin"><strong>Cuentas por Pagar: <?php echo number_format($tmonto,2,',','.')." $"; ?> </strong></button></td>
				</tr>
			
			</table>
		</div>
		{{$proveedores->render()}}
	</div>
</div>

@endsection
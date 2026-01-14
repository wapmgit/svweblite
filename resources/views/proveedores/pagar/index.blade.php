@extends ('layouts.master')
@section ('contenido')
<?php 		$longitud = count($proveedores);
			$array = array();
			foreach($proveedores as $t){
			$arrayidcliente[] = $t->idproveedor;
			}
			$longitudn = count($gastos);
			$arrayn = array();
			foreach($gastos as $n){
			$arraynidcliente[] = $n->idproveedor;
			} 			
			for ($i=0;$i<$longitud;$i++){
				for($j=0;$j<$longitudn;$j++){
				if ($arrayidcliente[$i]==$arraynidcliente[$j]){
					$arraynidcliente[$j]=0;
				};
				}
			}			
			?>
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
					 	 @foreach ($gastos as $not) <?php if($cat->idproveedor==$not->idproveedor){ 
					 $acumnd=$acumnd+$not->tpendiente; $acumnc=$not->tpendiente; }?>
					 @endforeach
					<td> <?php echo number_format(($cat->acumulado+$acumnc), 2,',','.')." $"; ?>	</td>
			<td>@if($rol->abonarcxp==1)	<a href="{{route('showcxp',['id'=>$cat->idproveedor])}}"><button class="btn btn-info btn-xs">Abono</button></a>@endif
			@if($rol->crearcompra==1)	<a href="{{route('faccompra',['id'=>$cat->idproveedor])}}"><button class="btn btn-success btn-xs">Facturar</button></a>@endif
                  
					</td>
				</tr>
				@endforeach
							@foreach ($gastos as $not)
				 	<?php 
					$nc=0;$nd=0;
					for ($i=0;$i<$longitudn;$i++){
						if ($not->idproveedor==$arraynidcliente[$i]){  
						$tmonto=($tmonto+$not->tpendiente); 
						?>
				<tr>
					<td><small>{{$not->nombre}}</small></td>
					<td><small>{{$not->rif}}</small></td>
					<td><small>{{$not->telefono}}</small></td>
					<td><?php echo number_format( $not->tpendiente, 2,',','.')." $";?></td>
					<td>
					<a href="{{route('showcxp',['id'=>$not->idproveedor])}}"><button class="btn btn-info btn-xs">Abono</button></a>
					<a href="{{route('faccompra',['id'=>$not->idproveedor])}}"><button class="btn btn-success btn-xs">Facturar</button></a>
					</td>
				</tr>
						<?php }
					} ?>
				@endforeach
				<tr><td colspan="5"> <button class="btn bg-olive btn-flat margin"><strong>Cuentas por Pagar: <?php echo number_format($tmonto,2,',','.')." $"; ?> </strong></button></td>
				</tr>
			
			</table>
		</div>
		{{$proveedores->render()}}
	</div>
</div>

@endsection
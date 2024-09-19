@extends ('layouts.master')
@section ('contenido')
@include('almacen.articulo.empresa')
	<div class="row px-2">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Ventas 
		@if($rol->crearventa==1)<a  href="{{route('newventa')}}"> <button class="btn btn-primary btn-sm">Nuevo</button></a>@endif</h3>
		@include('ventas.venta.searchcaja')
	</div>
</div>
<div class="row px-2">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Tipo comp</th>
					<th>Total</th>
					<th>Condicion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ventas as $ven)
               <?php 
$newdate=date("d-m-Y h:i:s a",strtotime($ven->fecha_hora));
    ?>
				<tr>
					<td><?php echo $newdate; ?></td>
					<td>{{ $ven->nombre}}</td>
					<td>{{ $ven->tipo_comprobante.':'.$ven->serie_comprobante.'-'.$ven->num_comprobante}}</td>
					<td>{{ $ven->total_venta}}</td>
					<td>{{ $ven->estado}}</td>
				
					<td>
                 <div class="btn-group">
                    <button type="button" class="btn btn-success btn-xs">Detalles</button>
                    <button type="button" class="btn btn-success dropdown-toggle btn-xs" data-toggle="dropdown">
                      <span class="sr-only"></span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="{{route('tcarta',['id'=>$ven->idventa])}}">Diseño Carta</a>
                      <a class="dropdown-item" href="{{route('recibo',['id'=>$ven->idventa])}}">Modo Tikect</a>
                    </div>
                  </div>    
				   <?php if ( $ven->devolu == 0){?> 
				  @if($rol->anularventa==1) <a href="{{route('showdevolucion',['id'=>$ven->idventa])}}"   ><button class="btn btn-warning btn-xs">Devolucion</button></a> @endif<?php } else {?><button class="btn btn-danger btn-xs">Devuelta</button><?php } ?>
					</td>
				</tr>
		
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}
	</div>
</div>

@endsection
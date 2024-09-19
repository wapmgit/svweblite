@extends ('layouts.master')
@section ('contenido')
@include('almacen.articulo.empresa')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Ventas 
		@if($rol->crearventa==1)<a  href="{{route('newventa')}}"> <button class="btn btn-primary btn-sm">Nuevo</button></a>@endif</h3>
		@include('ventas.venta.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="ventastable" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Tipo comp</th>
					<th>Total</th>
					<th>Usuario</th>
					<th>Condicion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ventas as $ven)
               <?php 
				$newdate=date("d-m-Y h:i:s a",strtotime($ven->fecha_hora));
					?>
				<tr>
					<td><small><?php echo $newdate; ?></small></td>
					<td><small>{{ $ven->nombre}}</small></td>
					<td><small>{{ $ven->tipo_comprobante.':'.$ven->serie_comprobante.'-'.$ven->num_comprobante}} <?php if ($ven->flibre==1){ echo "*"; } ?></td>
					<td>{{ $ven->total_venta}}</small></td>
					<td><small>{{ $ven->user}}</small></td>
					<td><small>{{ $ven->estado}}</small></td>
				
					<td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-xs">Detalles</button>
                    <button type="button" class="btn btn-success dropdown-toggle btn-xs" data-toggle="dropdown">
                      <span class="sr-only"></span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="{{route('tcarta',['id'=>$ven->idventa])}}">Diseño Carta</a>
                      <a class="dropdown-item" href="{{route('recibo',['id'=>$ven->idventa])}}">Modo Tikect</a>
                       <?php if ($ven->flibre==1){?>   <a class="dropdown-item" href="{{route('fbs',['id'=>$ven->idventa])}}">Diseño Bs</a><?php } ?>
                    </div>
                  </div>				
                  <?php if ( $ven->devolu == 0){?> 
				  @if($rol->anularventa==1) <a href="{{route('showdevolucion',['id'=>$ven->idventa])}}"   ><button class="btn btn-warning btn-xs">Devolucion</button></a> @endif<?php } else {?><button class="btn btn-danger btn-xs">Devuelta</button><?php } ?>
					</td>
				</tr>
		
				@endforeach
				<tfoot>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Tipo comp</th>
					<th>Total</th>
					<th>Usuario</th>
					<th>Condicion</th>
					<th>Opciones</th>
				</tfood>
			</table>
		</div>
		{{$ventas->render()}}
	</div>
</div>
@push ('scripts')
<script>
$(document).ready(function(){
	$(function () {
    $("#ventastable").DataTable({
		"order":[0,'desc'],
		"searching": true,
		"bPaginate": false,
		"bInfo":false,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#ventastable_wrapper .col-md-6:eq(0)');

  });
});
</script>
@endpush
@endsection
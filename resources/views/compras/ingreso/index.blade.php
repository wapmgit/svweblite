@extends ('layouts.master')
@section ('contenido')
@include('almacen.articulo.empresa')
	<div class="row">
		<h3>Compras 
		@if($rol->crearcompra==1)<a href="{{route('newcompra')}}"><button class="btn btn-primary btn-sm">Nuevo</button></a>@endif</h3>
		@include('compras.ingreso.search')
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table  id="comprastable" class="table table-bordered table-striped">
				<thead>	<tr>		
					<th>Fecha</th>
					<th>Proveedor</th>
					<th>Documento</th>
					<th>Monto</th>
					<th>Estado</th>
					<th>Opciones</th></tr>
				</thead>
				<tbody>
               @foreach ($ingresos as $ing)
				<?php $status=$ing->estatus;				
					$newdate=date("d-m-Y",strtotime($ing->fecha_hora));
				 ?>
				<tr>
					<td><?php echo $newdate; ?></td>
					<td>{{ $ing->nombre}}</td>
					<td>{{ $ing->tipo_comprobante.':'.$ing->serie_comprobante.'-'.$ing->num_comprobante}}</td>
					<td><?php echo number_format( $ing->total, 2,',','.'); ?></td>
					<td>{{ $ing->estado}}</td>			
					<td>					
					<?php $direccion=$ing->idingreso."-1"; ?>
				  <a href="{{route('showcompra',['id'=>$direccion])}}"><button class="btn btn-primary btn-xs">Detalles</button></a>	
				  <a href="{{route('etiquetascompra',['id'=>$ing->idingreso])}}"><button class="btn btn-secondary btn-xs"> Etiquetas</button></a>
					<?php if($status=="0"){?>                 
					@if($rol->anularcompra==1) <a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal" ><button class="btn btn-danger btn-xs">anular</button></a>@endif	
					<?php } else {?> <button class="btn btn-warning btn-xs">Anulada</button><?php } ?>
					</td>
				</tr>		
				@include('compras.ingreso.modal')
				@endforeach
				</tbody>		
				<tfoot>	<tr>		
					<th>Fecha</th>
					<th>Proveedor</th>
					<th>Documento</th>
					<th>Monto</th>
					<th>Condicion</th>
					<th>Opciones</th></tr>
				</tfoot>
			</table>
		</div>
		{!!$ingresos->links() !!}
	</div>
</div>
@push ('scripts')
<script>
$(document).ready(function(){
	$(function () {
    $("#comprastable").DataTable({
		"searching": true,
		"bPaginate": false,
		"bInfo":false,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#comprastable_wrapper .col-md-6:eq(0)');

  });
});
</script>
@endpush
@endsection

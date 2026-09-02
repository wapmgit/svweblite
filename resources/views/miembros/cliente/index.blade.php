@extends ('layouts.master')
@section ('contenido')
@include('clientes.cliente.empresa')
<?php $fserver=date('Y-m-d'); ?>
	<div class="row" id="principal">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Miembros  
			@if($rol->newcliente==1)<a href="{{route('newregistro')}}">
			<button class="btn btn-primary btn-sm"> Nuevo</button>@endif</a></h3>
		@include('miembros.cliente.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="clientestable" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombre</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Ultimo Pago</th>
					<th>Opciones</th>
				</thead>
               @foreach ($pacientes as $cat)
				<tr>
					<td><small> {{ $cat->cedula}} {{ $cat->nombre}}</small></td>
					<td><small>{{ $cat->codpais}}{{ $cat->telefono}}</small></td>
					<td><small><small> <?php echo substr( $cat->direccion, 0, 20 ); ?></small></small></td>
					<td><?php if($cat->ult_pago==NULL){ echo "Sin Registro"; }else{  echo date("d-m-Y",strtotime($cat->ult_pago));} ?></td>
					<td>
					<a href="{{route('editmiembro',['id'=>$cat->id_cliente])}}"><button class="btn btn-warning btn-xs">Editar</button></a>
					
				<a href="{{route('edomienbro',['id'=>$cat->idmiembro])}}"><button class="btn btn-success btn-xs">Cuenta</button></a>	
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$pacientes->render()}}
	</div>
</div>
@push ('scripts')
<script>
$(document).ready(function(){
	const cuerpoDelDocumento = document.body;
	cuerpoDelDocumento.onload = miFuncion;
	function miFuncion() {
		// alert('La página terminó de cargar');
  	document.getElementById('imgcarga').style.display="none"; 
	document.getElementById('principal').style.display=""; 
	} 

	$("#btn").click(function(){
		document.getElementById('imgcarga').style.display=""; 
		document.getElementById('principal').style.display="none"; 
	})
	
	$(function () {
    $("#clientestable").DataTable({
		"searching": true,
		"bPaginate": false,
		"bInfo":false,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#clientestable_wrapper .col-md-6:eq(0)');

  });
});
</script>
@endpush
@endsection
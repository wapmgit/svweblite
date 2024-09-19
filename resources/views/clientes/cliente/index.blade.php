@extends ('layouts.master')
@section ('contenido')
@include('clientes.cliente.empresa')
@include('clientes.cliente.modalcsv')
	<div class="row" id="principal">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Clientes 
			@if($rol->newcliente==1)<a href="{{route('newcliente')}}">
			<button class="btn btn-primary btn-sm"> Nuevo</button>@endif</a></h3>
		@include('clientes.cliente.search')
	</div>
</div>
<div class="row"  id="imgcarga"  style="display:none">
<div  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">  
<img src="{{asset('dist/img/loading.gif')}}"  width="120"></div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="clientestable" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombre</th>
					<th>Cedula</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Vendedor</th>
					<th>Opciones</th>
				</thead>
               @foreach ($pacientes as $cat)
				<tr>
					<td><small>{{ $cat->nombre}}</small></td>
					<td><small>{{ $cat->cedula}}</small></td>
					<td><small>{{ $cat->telefono}}</small></td>
					<td><small><small> <?php echo substr( $cat->direccion, 0, 20 ); ?></small></small></td>
					<td><small>{{ $cat->vendedor}}</small></td>
					<td>
					@if($rol->editcliente==1)<a href="{{route('editcliente',['id'=>$cat->id_cliente])}}"><button class="btn btn-warning btn-xs">Editar</button></a>@endif
					 @if($rol->crearventa==1)<a href="{{route('facventa',['id'=>$cat->id_cliente])}}"><button class="btn btn-primary btn-xs">Facturar</button></a>@endif					
					@if($rol->edoctacliente==1)<a href="{{route('edocuenta',['id'=>$cat->id_cliente])}}"><button class="btn btn-success btn-xs">Edo. Cta.</button></a>@endif	
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
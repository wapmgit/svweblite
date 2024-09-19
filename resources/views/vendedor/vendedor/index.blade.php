@extends ('layouts.master')
@section ('contenido')
@include('clientes.cliente.empresa')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Vendedores 
		@if($rol->newvendedor==1) <a href="{{route('newvendedor')}}"><button class="btn btn-primary btn-sm">Nuevo</button></a>@endif</h3>
		@include('vendedor.vendedor.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="vendedortable" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Cedula</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($vendedores as $cat)
				<tr>
					<td>{{ $cat->id_vendedor}}</td>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->cedula}}</td>
					<td>{{ $cat->telefono}}</td>
					<td>{{ $cat->direccion}}</td>
					<td>
			@if($rol->editvendedor==1)		
			<a href="{{route('editarvendedor',['id'=>$cat->id_vendedor])}}"><button class="btn btn-warning btn-xs">Editar</button></a>@endif
			<a href="{{route('clientesvendedor',['id'=>$cat->id_vendedor])}}"><button class="btn btn-success btn-xs">Ver Clientes</button></a>
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$vendedores->render()}}
	</div>

</div>
@push ('scripts')
<script>
$(document).ready(function(){
	$(function () {
    $("#vendedortable").DataTable({
		"searching": false,
		"bPaginate": false,
		"bInfo":false,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#vendedortable_wrapper .col-md-6:eq(0)');

  });
});
</script>
@endpush
@endsection
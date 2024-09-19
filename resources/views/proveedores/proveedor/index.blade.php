@extends ('layouts.master')
@section ('contenido')
<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	 <div class="form-group">
            			<label >{{$empresa->nombre}}</label></br>
            			<label >{{$empresa->rif}}</label>	
            	 </div>  
	    </div>
</div>
	<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Proveedores<a href="{{route('newproveedor')}}"> 
		@if($rol->newproveedor==1)<button class="btn btn-primary btn-sm">Nuevo</button>@endif</h3></a>
		@include('proveedores.proveedor.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="proveedortable" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Empresa</th>
					<th>RIF</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($proveedor as $cat)
				<tr>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->rif}}</td>
					<td>{{ $cat->telefono}}</td>
					<td><?php echo substr($cat->direccion,0,20); ?></td>
					<td>
					@if($rol->editproveedor==1)	<a href="{{route('editproveedor',['id'=>$cat->idproveedor])}}"><button class="btn btn-warning btn-xs">Editar</button></a> @endif
					@if($rol->crearcompra==1)	<a href="{{route('faccompra',['id'=>$cat->idproveedor])}}"><button class="btn btn-primary btn-xs">Facturar</button></a> @endif
                   		@if($rol->edoctaproveedor==1)<a  href="{{route('historico',['id'=>$cat->idproveedor])}}"><button class="btn btn-success btn-xs">Edo. Cta.</button></a>	@endif
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$proveedor->render()}}
	</div>
</div>
@push ('scripts')
<script>
$(document).ready(function(){
	$(function () {
    $("#proveedortable").DataTable({
		"searching": false,
		"bPaginate": false,
		"bInfo":false,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#proveedortable_wrapper .col-md-6:eq(0)');

  });
});
</script>
@endpush
@endsection
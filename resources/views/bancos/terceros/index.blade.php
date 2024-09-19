@extends ('layouts.admin')
@section ('contenido')
@include('pacientes.paciente.empresa')
	<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Terceros en Banco 
		@include('bancos.terceros.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Cedula/Rif</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($personas as $cat)
				<tr>
					<td>{{ $cat->id_persona}}</td>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->rif}}</td>
					<td>{{ $cat->telefono}}</td>
					<td><small>{{ $cat->direccion}}</small></td>
					
					<td>
				<a href="{{URL::action('TercerosController@edit',$cat->id_persona)}}"><button class="btn btn-warning">Editar</button></a>              
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$personas->render()}}
	</div>
</div>

@endsection
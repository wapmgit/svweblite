@extends ('layouts.master')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Empresas <a href="{{route('newempresa')}}"><button class="btn btn-primary btn-sm">Nuevo</button></a></h3>
		@include('empresas.empresa.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>UUID</th>
					<th>Nombre</th>
					<th>Rif</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($empresas as $cat)
				<tr>
					<td>{{ $cat->idempresa}}</td>
					<td>{{ $cat->uuid}}</td>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->rif}}</td>
					<td>{{ $cat->telefono}}</td>
					<td>{{ $cat->direccion}}</td>
					<td>
						<a href="{{route('empresa',['id'=>$cat->idempresa])}}"><button class="btn btn-warning btn-sm">Editar</button></a>
                        
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$empresas->render()}}
	</div>
</div>
@endsection
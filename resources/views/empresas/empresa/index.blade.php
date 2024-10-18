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
					
					<th>Telefono</th>
				
					<th>Opciones</th>
					<th>Ult.</th>
				</thead>
               @foreach ($empresas as $cat)
				<tr>
					<td>{{ $cat->idempresa}}</td>
					<td><small>{{ $cat->uuid}}</small></td>
					<td><small>{{ $cat->rif}} {{ $cat->nombre}}</small></td>
				
					<td>{{ $cat->telefono}}</td>
						
					<td><?php echo date("d-m-Y h:i:s a",strtotime($cat->lastact)); ?></td>
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
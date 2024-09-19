@extends ('layouts.master')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Grupos <a href="{{route('newcategoria')}}"><button class="btn btn-primary btn-sm">Nuevo</button></a></h3>
		@include('almacen.categoria.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
               @foreach ($categorias as $cat)
				<tr>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->descripcion}}</td>
					<td>
						<a href="{{route('editcategoria',['id'=>$cat->idcategoria])}}"><button class="btn btn-warning btn-sm">Editar</button></a>
                        <a href="{{route('showcategoria',['id'=>$cat->idcategoria])}}"><button class="btn btn-success btn-sm">Ver articulos</button></a>
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$categorias->render()}}
	</div>
</div>
@endsection
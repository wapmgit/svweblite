@extends ('layouts.master')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Monedas <a href="{{route('newmoneda')}}">	@if($rol->newmoneda==1)<button class="btn btn-primary btn-sm">Nuevo</button>@endif</a></h3>
		@include('sistema.monedas.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Simbolo</th>
					<th>Tipo</th>
					<th>Valor</th>
					<th>Opciones</th>
				</thead>
               @foreach ($monedas as $cat)
				<tr>
					<td>{{ $cat->idmoneda}}</td>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->simbolo}}</td>
					<td><?php if($cat->tipo==0){echo "=";}?>
					<?php if($cat->tipo==1){echo "Multiplica";}?>
					<?php if($cat->tipo==2){echo "Divide";}?></td>
					<td>{{ $cat->valor}}</td>
					<td>
					@if($rol->editmoneda==1)		<a href="{{route('editmoneda',['id'=>$cat->idmoneda])}}"><button class="btn btn-warning btn-sm">Editar</button></a>@endif
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$monedas->render()}}
	</div>
</div>
@endsection
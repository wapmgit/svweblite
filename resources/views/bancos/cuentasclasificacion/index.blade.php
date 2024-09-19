@extends ('layouts.master')
@section ('contenido')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Cuentas de Clasificacion <a href="{{route('newcta')}}"><button class="btn btn-primary btn-sm">Nuevo</button></a></h3>
		@include('bancos.cuentasclasificacion.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="ing" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					
					<th>Codigo</th>
					<th>Nombre</th>					
					<th>Tipo</th>
					<th>Estatus</th>
					<th>opciones</th>

				</thead>
				<tbody>
               @foreach ($ctas as $cla)
				<tr>
					<td>{{ $cla->codigo}}</td>
					<td>{{ $cla->descrip}}</td>					
					<td><?php if($cla->tipo=='1'){echo "Ingreso";}; if($cla->tipo=='2'){echo "Egreso";}; if($cla->tipo=='3'){echo "Ambos";}; ?></td>
					<td><?php if($cla->inactiva=='1'){echo "Inactivo";}else{echo "Activo";}; ?></td>
			
		<td>	
				
				<a href="{{route('editca',['id'=>$cla->idcod])}}"><button class="btn btn-warning btn-sm">Editar</button></a>
					</td>
				</tr>@endforeach
				</tbody>
				
			<tfoot>
				<th>codigo</th>
					<th>Nombre</th>					

					<th>Tipo</th>
					<th>Estatus</th>
					<th>Opciones</th>
			</tfoot>
			</table>
		</div>
	{{$ctas->render()}}
	</div>
</div>
@endsection
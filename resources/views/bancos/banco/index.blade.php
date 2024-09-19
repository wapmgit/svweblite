@extends ('layouts.master')
@section ('contenido')
@include('bancos.banco.modalbanco')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Bancos	@if($rol->newbanco==1) <a href="" data-target="#modalbanco" data-toggle="modal"><button class="btn btn-success btn-sm">Nuevo</button></a>@endif</h3>
  
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="bancos" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					
					<th>Codigo</th>
					<th>Nombre</th>					
					<th>Cuenta</th>
					<th>Titular</th>
					<th>Opciones</th>

				</thead>
				<tbody>
               @foreach ($bancos as $ban)
				<tr>
					<td>{{ $ban->codigo}}</td>
					<td>{{ $ban->nombre}}</td>					
					<td>{{ $ban->cuentaban}}</td>
					<td>{{ $ban->titular}}</td>
					<td>	
					@if($rol->editbanco==1)<a href="{{route('editbanco',['id'=>$ban->idbanco])}}"><button class="btn btn-warning btn-xs">Editar</button></a>@endif
					@if($rol->accesobanco==1)<a href="{{route('showbanco',['id'=>$ban->idbanco])}}"><button class="btn btn-info btn-xs"> Ingresar</button></a>  @endif
					</td>
				</tr>@endforeach
				</tbody>
				
			<tfoot>
					<th>Codigo</th>
					<th>Nombre</th>					
					<th>Cuenta</th>
					<th>Titular</th>
					<th>Opciones</th>
			</tfoot>
			</table>
		</div>
			{{$bancos->render()}}
	
	</div>
</div>
@endsection
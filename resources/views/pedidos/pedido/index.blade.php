@extends ('layouts.master')
@section ('contenido')
@include('almacen.articulo.empresa')
<div class="row" id="principal">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<h3>Pedidos 
		@if($rol->crearpedido==1)<a  href="{{route('newpedido')}}"> <button class="btn btn-primary btn-sm">Nuevo</button></a>@endif</h3>
		@include('pedidos.pedido.search')
	</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" align="right">
		@if($rol->web==1)<a href="{{route('send-orders')}}" title="Bajar Pedidos Webs"><button class="btn btn-info btn-sm" id="btn"><i class="fa fa-fw fa-cloud-arrow-down"></i></button></a>@endif
	</div>
</div>
<div class="row"  id="imgcarga"  style="display:none">
<div  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">  
<img src="{{asset('dist/img/loading.gif')}}"  width="120"></div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Tipo comp</th>
					<th>Total</th>
					<th>Vendedor</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ventas as $ven)
               <?php 
				$newdate=date("d-m-Y",strtotime($ven->fecha_hora));
					?>
				<tr>
					<td><?php echo $newdate; ?></td>
					<td>{{ $ven->nombre}}</td>
					<td><?php if($ven->pweb==1){ echo "<i class='fa fa-fw fa-cloud-upload'></i>";}?>
					{{ $ven->tipo_comprobante.':'.$ven->serie_comprobante.'-'.$ven->num_comprobante}}					
					</td>
					<td>{{ $ven->total_venta}}</td>
					<td>{{ $ven->user}}</td>				
					<td>			
					<a href="{{route('showpedido',['id'=>$ven->idpedido])}}">
					<button class="btn btn-success btn-sm">Detalles</button></a>
                  @if($rol->anularpedido==1) <a href="" data-target="#modal-delete-{{$ven->idpedido}}" data-toggle="modal" ><button class="btn btn-danger btn-sm">anular</button></a>
					@endif
					</td>
				</tr>
			@include('pedidos.pedido.modalanular')
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}
	</div>
</div>
@push ('scripts')
<script>

$(document).ready(function() {    
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

});

</script>
@endpush
@endsection
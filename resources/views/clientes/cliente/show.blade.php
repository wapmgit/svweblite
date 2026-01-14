@extends ('layouts.master')
@section ('contenido')
<?php 
$ceros=5; 
function add_ceros($numero,$ceros) {
  $numero=$numero;
	$digitos=strlen($numero);
  $recibo=" ";
  for ($i=0;$i<8-$digitos;$i++){
    $recibo=$recibo."0";
  }
return $insertar_ceros = $recibo.$numero;
};
?>
<style type="text/css">
#capa{
	height: 500px;
	width: 100%;
	border: 1px solid #ddd;
	background: #f1f1f1;
	overflow-y: scroll;
}
</style>
  	<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                  <img src="{{asset('dist/img/iconosistema.png')}}" title="NKS">SysVent@s</img>
                    <small class="float-right"></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3 ">
			{{$empresa->nombre}}
			<address>
			<strong>{{$empresa->rif}}</strong><br>
					{{$empresa->direccion}}<br>
					Tel: {{$empresa->telefono}}<br>
			</address>
	</div>
				 	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
		<h3 align="center"><u>  Estado de Cuenta </u></h3>		
	</div>	
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 " align="center">
<img src="{{ asset('dist/img/'.$empresa->logo)}}" width="60%" height="90%" title="NKS">
	</div>
              </div>
<div class="row"><?php $acummonto=0; ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table width="100%"border="1"><tr><td width="30%"><strong>Rif -> Cliente</strong></td><td width="20%"><strong>Telefono</strong></td><td width="30%"><strong>Direccion</strong></td><td width="20%"><strong>Vendedor</strong></td>
			</tr>
			<tr><td>{{$cliente->cedula}} -> {{$cliente->nombre}}</td><td>{{$cliente->telefono}}</td><td>{{$cliente->direccion}}</td><td>{{$cliente->vendedor}} </td>
			</tr>
			</table></br>
		</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="divbotones" align="right">
                 <div class="form-group">
					@if($rol->abonarcxc==1)<a href="{{route('showcxc',['id'=>$cliente->id_cliente])}}"><button class="btn btn-info btn-xs">Abono</button></a>@endif
                    <a href="" data-target="#modalrecibos-{{$cliente->id_cliente}}" data-toggle="modal"><button class="btn btn-success btn-xs">Recibos</button></a>
					</div>
			</div>

	<!-- @include('clientes.cliente.modalcredito') -->

@include('clientes.cliente.modalrecibos')
</div>
@include('clientes.cliente.modaldetalle')


		<div class="row">	
	<div id="capac">
			   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive" >
			<table width="100%">
				<thead>
				<th class="filap1"></th>
					<th>Documento</th>
					<th>Ref.</th>
					<th>Desc.</th>
					<th>Fecha</th>
					<th>Condicion</th>
					<th>Monto Doc.</th>
					<th>Descto.</th>
					<th>Monto Des.</th>
					<th>Saldo</th>						
				</thead>
				<?php $vendido=0; $acum=0; $link=2; $saldo=$saldond=$saldonc=0; $cont=$contnd=$contnc=0; ?>
               @foreach ($ventas as $cat) 
			   <?php if($cat->devolu==0){ $vendido=$vendido+$cat->total_venta;  $saldo=$saldo+$cat->saldo; }
			   $cont++; 
			   ?>
				<tr>
				<td class="filap1"> <a  href="{{route('tcarta',['id'=>$cat->idventa.'-'.$link])}}"><i class="fa fa-fw fa-eye" title="Ver Documento"></i></a></td>
					<td> <?php if($cat->devolu==1){echo "*DEV";}?>             
					{{ $cat->serie_comprobante}}<?php $idv=$cat->idventa; echo add_ceros($idv,$ceros); ?> C{{$cat->control}}
					</td>
					<td></td><td></td>
					<td><small><?php echo date("d-m-Y h:i:s a",strtotime($cat->fecha_hora)); ?></small></td>
					<td>{{ $cat->estado}}</td>
					<td>{{ $cat->total_venta}}</td>
					<td>{{ $cat->descuento}}</td>
					<td>{{ $cat->total_pagar}}</td>
					<td> {{ $cat->saldo}}</td>				
				</tr>
				
					@foreach($pagos as $p)
					<?php if($cat->idventa==$p->idventa){ ?>
					<tr style="line-height:80%"><td></td><td colspan="4"><small>------------> Recibo-{{$p->idrecibo}} <?php echo date("d-m-Y",strtotime($p->fecha)); ?></small></td><td colspan="4"><small>{{$p->idbanco}}->{{$p->recibido}}->{{$p->monto}}$</small></td><td></td><td></td></tr>
					<?php } ?>
					@endforeach
				@endforeach
				<tr><td class="filap1"></td><td colspan="5"><strong>Facturas: <?php echo $cont. " -> N/D: ".$contnd." -> N/C: ".$contnc; ?></strong></td><td><strong>Facturado: <?php echo$vendido; ?> $.</strong></td><td colspan="2"></td><td><strong><?php echo (($saldo+$saldond)-$saldonc); ?> $.</strong></td></tr>
			</table>
			
		</div>
		</div>
	     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></br>
                    <div class="form-group" align="center">
					<button type="button" id="regresar" class="btn btn-danger btn-sm" data-dismiss="modal">Regresar</button>
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>

                    </div>
                </div> 
	</div>
 

			<form action="{{route('clientes')}}" method="POST" id="formulariodetalle" enctype="multipart/form-data" >  
			 {{csrf_field()}}
    <input type="hidden" name="comprobante" id="pidcomprobante" value="0">
	 <input type="hidden" name="tipo" id="pidtipo" value="0">
	 </form>
     

	<div id="capaprint" style="display:none">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table width="100%">
				<thead>
					<th>Documento</th>
					<th>Ref.</th>
					<th>Desc.</th>
					<th>Fecha</th>
					<th>Condicion</th>
					<th>Monto Doc.</th>
					<th>Des. %</th>
					<th>Monto Des.</th>
					<th>Saldo</th>						
				</thead>
				<?php $vendido=0; $acum=0; $saldo=$saldond=$saldonc=0; $cont=$contnd=$contnc=0; ?>
               @foreach ($ventas as $cat) 
			   <?php if($cat->devolu==0){ $vendido=$vendido+$cat->total_venta;  $saldo=$saldo+$cat->saldo; }
			   $cont++; 
			   ?>
				<tr>
					<td> <?php if($cat->devolu==1){echo "*DEV";}?>{{ $cat->serie_comprobante}}<?php $idv=$cat->idventa; echo add_ceros($idv,$ceros); ?>
					</td>
					<td></td><td></td>
					<td><small><?php echo date("d-m-Y h:i:s a",strtotime($cat->fecha_hora)); ?></small></td>
					<td>{{ $cat->estado}}</td>
					<td>{{ $cat->total_venta}}</td>
					<td>{{ $cat->descuento}}</td>
					<td>{{ $cat->total_pagar}}</td>
					<td>{{ $cat->saldo}}</td>				
				</tr>
				@foreach($pagos as $p)
					<?php if($cat->idventa==$p->idventa){ ?>
					<tr style="line-height:80%"><td></td><td colspan="4">------------><small> Recibo-{{$p->idrecibo}} <?php echo date("d-m-Y",strtotime($p->fecha)); ?></small></td><td colspan="4"><small>{{$p->idbanco}}->{{$p->recibido}}->{{$p->monto}}$</small></td><td></td><td></td></tr>
					<?php } ?>
					@endforeach
				@endforeach
				<tr><td colspan="5"><strong>Facturas: <?php echo $cont; ?></strong></td><td><strong>Facturado: <?php echo$vendido; ?> $.</strong></td><td colspan="2"></td><td><strong><?php echo (($saldo+$saldond)-$saldonc); ?> $.</strong></td></tr>
			</table>
			
		</div>

	</div>
</div>
@push ('scripts')
<script>
$(document).ready(function(){

    $('#ing').DataTable();	

    $('#imprimir').click(function(){
		$(".filap1").remove();
  //  alert ('si');
  document.getElementById('divbotones').style.display="none";
  document.getElementById('capac').style.display="none";
  document.getElementById('capaprint').style.display="";
  document.getElementById('imprimir').style.display="none";
  document.getElementById('regresar').style.display="none";
  window.print(); 
  window.location.href="/edocuenta/{{$cliente->id_cliente}}";
    });
$('#regresar').on("click",function(){
  window.location="{{route('clientes')}}";
  
});
$('#btndedito').on("click",function(){
  document.getElementById('btndedito').style.display="none"; 
});
$('#btncredito').on("click",function(){
  document.getElementById('btncredito').style.display="none"; 
});
$('#btn-cerrar').on("click",function(){
$(".otrafila").remove();
});
$('#btn-cerrarnc').on("click",function(){
$(".filadelete").remove();
});
$('#btn-close').on("click",function(){
$(".otrafila").remove();
});


});
</script>
@endpush
@endsection
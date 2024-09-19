	<div class="col-sm-6 invoice-col">
		{{$empresa->nombre}}
			<address>
			<strong>{{$empresa->rif}}</strong><br>
					{{$empresa->direccion}}<br>
					Tel: {{$empresa->telefono}}<br>
			</address>
	</div>
                <!-- /.col -->
	<div class="col-sm-3 invoice-col">
		<h2 align="center"><u>  NOTA DE ENTREGA </u></h2><div align="center">
		{{$venta->tipo_comprobante}} {{$venta->serie_comprobante}} <?php $idv=$venta->num_comprobante; echo add_ceros($idv,$ceros); ?>
		<span><strong><?php if($venta->devolu>0){ echo "**Devuelta**";} ?></span></strong></div>		
	</div>	
	<div class="col-sm-3 invoice-col" align="center">
<img src="{{ asset('dist/img/'.$empresa->logo)}}" width="50%" height="80%" title="NKS">
	</div>
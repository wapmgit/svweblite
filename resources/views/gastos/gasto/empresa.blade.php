
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
		<h2 align="center"><u>  GASTO </u></h2><div align="center"><span><?php echo add_ceros($gasto-> idgasto,$ceros); ?><strong><?php if($gasto->estatus==1){ echo "**Anulado**";} ?></span></strong></div>		
	</div>	
	<div class="col-sm-3 invoice-col" align="center">
<img src="{{ asset('dist/img/'.$empresa->logo)}}" width="50%" height="80%" title="NKS">
	</div>
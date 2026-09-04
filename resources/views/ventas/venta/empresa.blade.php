	<div class="col-sm-6 invoice-col">
	
			<address>@if($empresa->mnombre==1){{$empresa->nombre}} @endif
			<strong>@if($empresa->mrif==1) {{$empresa->rif}} @endif</strong><br>
					@if($empresa->mdireccion==1) {{$empresa->direccion}} @endif<br>
				@if($empresa->mtel==1)	Tel: {{$empresa->telefono}} @endif<br>
			</address>
	</div>
                <!-- /.col -->
	<div class="col-sm-3 invoice-col">
		<h4 align="center"><u>  NOTA DE ENTREGA </u></h4><div align="center">
		CONTROL {{$venta->control}}
		<span><strong><?php if($venta->devolu>0){ echo "**Devuelta**";} ?></span></strong></div>		
	</div>	
	<div class="col-sm-3 invoice-col" align="center">
<img src="{{ asset('dist/img/'.$empresa->logo)}}" width="50%" height="80%" title="NKS">
	</div>
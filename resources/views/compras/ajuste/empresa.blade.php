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
		<h2 align="center">  Ajuste de Inventario </h2><div align="center"><span><strong><?php echo add_ceros($ajuste-> controlajuste,$ceros); ?></span></strong></div>		
	</div>	
	<div class="col-sm-3 invoice-col" align="center">
<img src="{{ asset('dist/img/'.$empresa->logo)}}" width="50%" height="80%" title="NKS">
	</div>
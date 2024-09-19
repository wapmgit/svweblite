	<div class="col-sm-8 invoice-col">
				{{$empresa->nombre}}
                  <address>
                    <strong>{{$empresa->rif}}</strong><br>
                   {{$empresa->direccion}}<br>
                     Tel: {{$empresa->telefono}}<br>
                  </address>
	</div>
                <!-- /.col -->
	<div class="col-sm-4 invoice-col">

				  <h4>Cuentas por Cobrar</h4><span><?php if ($vendedor <> ""){ echo "Vendedor: ".$vendedor->nombre; } ?></span>
	</div>
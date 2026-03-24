	<div class="col-sm-6 invoice-col">
				<b>{{$empresa->nombre}}</b>
                  <address>
                    <strong>{{$empresa->rif}}</strong><br>
                   {{$empresa->direccion}}<br>
                     Tel: {{$empresa->telefono}}<br>
                  </address>
	</div>
                <!-- /.col -->
	<div class="col-sm-3 invoice-col">
				  <h4>Catalogo de Ventas</h4>           
	</div>
			<div class="col-sm-3 invoice-col">
				<div align="center">  
			<img src="{{ asset('dist/img/'.$empresa->logo)}}" width="50%" height="80%" title="NKS">
			</div>
	    </div>
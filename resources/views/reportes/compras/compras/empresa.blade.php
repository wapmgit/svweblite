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

				  <h4>Resumen de Compras</h4>
                <?php echo date("d-m-Y",strtotime($searchText)); ?> al <?php echo date("d-m-Y",strtotime($searchText2)); ?>
	</div>
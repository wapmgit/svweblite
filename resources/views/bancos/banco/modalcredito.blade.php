<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modalcredito">
<form action="{{route('addcredito')}}" method="POST" id="formcredito" enctype="multipart/form-data" >         
{{csrf_field()}}
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registro de Credito Bancario </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">
								<div class="row">

									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
										  <div class="form-group">
											    <label for="nombre">Numero: </label>
											<input type="text" name="numero" required value="<?php echo add_ceros($idv,$ceros,$bco); ?>" class="form-control" placeholder="Numero...">
											<input type="hidden" name="idbanco" value="{{$banco->idbanco}}" class="form-control" >
										</div>
									</div>
									
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
									  <div class="form-group">
										<label for="saco">Clasificador de transaccion</label>
				                             <select name="clasificador"  class="form-control selectpicker" data-live-search="true">
				                      @foreach ($clasificador as $clasi)
				                      <?php if($clasi->tipo == 1){ ?>
				                              <option value="{{$clasi->idcod}}">{{$clasi->codigo}} - {{$clasi->descrip}}</option> <?php } ?>
				                              @endforeach 
				                              </select>
										</div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
										 <div class="form-group">
											    <label for="nombre">Razon:</label>
										    <select name="cliente" id="clientecre" class="form-control selectpicker" data-live-search="true">
											 <option value="">Seleccione...</option> 
				                      @foreach ($clientes as $cli)
				                              <option value="{{$cli->id}}_{{$cli->nombre}}_{{$cli->cedula}}_{{$cli->tipo}}">{{$cli->cedula}} - {{$cli->nombre}}</option> 
				                              @endforeach
				                              </select>
										</div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
										 <div class="form-group">
											    <label for="nombre">Concepto</label>
											<input type="text" name="concepto"  required value="" class="form-control" placeholder="Concepto...">
										</div>
									</div>	
									<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12" align="center">
										 <div class="form-group">
											    <label for="nombre">Fecha</label>
											<input type="date" required name="fecha" value=""  class="form-control">
										</div>
									</div>
									
							<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12" align="center">
										 <div class="form-group">
											    <label for="nombre">Monto</label>
											<input type="number" required name="monto" id="montonc" value="" step="0.01" class="form-control" placeholder="monto...">
										</div>
									</div>
														
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12" align="center" id="divncadm" style="display:none">
            <div class="form-group">
            	<label for="productor">¿ Generar N/C administrativa?</label></br>
				<input type="checkbox" name="cxc" id="cbx1" value="0" >		
            </div>
	</div>	
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12" align="center" id="divndp" style="display:none">
            <div class="form-group">
            	<label for="productor">¿ Generar N/D al Proveedor?</label></br>
				<input type="checkbox" name="ndp" id="cbx2" value="0" >		
            </div>
	</div>	
								
				   
											
								</div>
			</div>
		<div class="modal-success">
			<div class="modal-footer">
			 <div class="form-group">
				<button type="button" id="cerrarnc" class="btn btn-default btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btn_nc" class="btn btn-primary btn-outline pull-right">Confirmar</button>
				</div>
			</div>
				</div>
		</div>
	</div>
	</form>

</div>
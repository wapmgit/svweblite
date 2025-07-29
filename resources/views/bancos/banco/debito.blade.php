<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modaldebito">
<?php $fserver=date('Y-m-d'); ?>
<form action="{{route('adddebito')}}" method="POST" id="formdebito" enctype="multipart/form-data" >         
{{csrf_field()}}
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Entrada </h4>
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
	<div class="form-group">
	<label for="nombre">Fecha</label>
		<input type="date" class="form-control" name="fecha"  value="{{$fserver}}">
	</div>
</div>
</div>

									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
										 <div class="form-group">
											    <label for="nombre">Persona</label>	
								<input type="text" name="persona"  required value="" class="form-control" >												
										</div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
										 <div class="form-group">
											    <label for="nombre">Concepto</label>
											<input type="text" name="concepto"  required value="" class="form-control" placeholder="Concepto...">
										</div>
									</div>	

						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
										 <div class="form-group">
											    <label for="nombre">Recibido</label>
											<input type="number" required name="recibido" step="0.01" value="" class="form-control" placeholder="monto...">
										</div>
									</div>
									<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
									  <label for="nombre">Moneda</label>
										  <select name="moneda" class="form-control selectpicker" data-live-search="true">				                  
				                              <option value="Bs">Bolivares </option>                 
				                              <option value="Ps">Pesos </option>                 
				                              <option value="Ds">Dolares </option>                 
				                              <option value="Dt">USDT </option>                 
				                              <option value="Eu">Euro </option>                 
				                              </select>
									</div>
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
										 <div class="form-group">
											    <label for="nombre">Para $</label>
											<input type="number" required name="monto" id="montond" step="0.01" value="" class="form-control" placeholder="monto...">
										</div>
									</div>
											
								</div>
			</div>
		<div class="modal-success">
			<div class="modal-footer">
			 <div class="form-group">
				<button type="button" id="cerrarnd"  class="btn btn-default btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btn_nd" class="btn btn-primary btn-outline pull-right">Confirmar</button>
				</div>
			</div>
				</div>
		</div>
	</div>
</form>

</div>
<div class="modal modal-warning" aria-hidden="true"
role="dialog" tabindex="-1" id="modaldebito">

		<form action="{{route('pagoeventual')}}" method="get" id="formularidebito" enctype="multipart/form-data" >    	
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Generar Cobro Eventual </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">
	<div class="row">
				<div class="col-12 col-lg-12">
				<label for="cliente">Cliente</label>
                    	<select name="id_cliente" id="id_cliente" class="form-control selectpicker" data-live-search="true">						
                           @foreach ($clientes as $cli)
                           <option value="{{$cli -> id_cliente}}">{{$cli -> cedula}}-{{$cli -> nombre}}</option> 
                           @endforeach
                        </select>
						</div>

					<div class="col-6 col-lg-6">
					<div class="form-group">
            			<label for="codigo">Horas</label>
            			<input type="number" name="hrs" id="hrs" required step="0.01" min="0.1" class="form-control" value="1">
            		</div>
					</div>

  
					<div class="col-6 col-lg-6">
					<div class="form-group">
            			<label for="codigo">Monto</label>
            			<input type="number" name="monto" id="mnt" required step="0.01" min="0.1" class="form-control" value="1">
            		</div>
					</div>
		  <div class ="row" id="divdesglose">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3 align="center">TOTAL <input type="number" id="divtotal" value="1" disabled ><span id="pasapago" title="haz click para hacer cobro total">RESTA</span> <input type="number" id="resta" disabled value="1">
					<input type="hidden" name="tdeuda" id="tdeuda" value=""  >		
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<select name="pidpago" id="pidpago" class="form-control">
					<option value="100" selected="selected">Selecione...</option>
					@foreach ($monedas as $m)
					 <option value="{{$m-> idmoneda}}_{{$m->tipo}}_{{$m->valor}}">{{$m -> nombre}}</option> 
					@endforeach
					</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<input type="number" class="form-control" name="pmonto" id="pmonto" placeholder="Esperando Seleccion"  min="1" step="0.01">
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<input type="text" name="preferencia" class="form-control" id="preferencia" onchange="conMayusculas(this);" placeholder="Referencia...">
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<button type="button" id="bt_pago" class="form-control" > <i class="fa fa-fw fa-plus-square"></i> </button>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="table-responsive">
						<table id="det_pago" class="table table-striped table-bordered table-condensed table-hover">
						  <thead style="background-color: #54b279">
							  <th>Supr</th>
							  <th width="15%">Tipo</th>
							   <th width="15%">Monto</th>
							  <th>Monto $</th>
							  <th>Referencia</th>

						  </thead>
							<tfoot> 
							<th></th>
							  <th></th>
							   <th></th>
							  <th><h3>Total $</h3></th>
							  <th><h3 id="total_abono">$.  0.00</h3></th><input type="hidden" name="totala" id="totala" value="0.00">
							  </tfoot>
							<tbody></tbody>
						</table>
					</div>
				</div>
				
				</div>	
			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" id="btnregresar" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="procesa" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
</form>

</div>

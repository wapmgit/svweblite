<div class="modal fade" id="modalrecibos-{{$cliente->id_cliente}}">
<form action="{{route('cobromes')}}" method="get" id="formulario" enctype="multipart/form-data" >    
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registrar Pago </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">
	<div class ="row" id="divdesglose">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					   <input type="hidden" value="{{$empresa->tc}}" id="valortasa" name="tc" class="form-control">
						<input type="hidden" value="{{$empresa->peso}}" id="valortasap" name="peso" class="form-control">
						<input type="hidden" value="{{$cliente->montomes}}" id="total_venta" name="total_venta" class="form-control">
						<input type="hidden" value="{{$cliente->idmiembro}}"  name="doc" class="form-control">
					   <h3  align="center">TOTAL <input type="number" id="divtotal" value="{{$cliente->montomes}}" disabled ><span id="pasapago" title="haz click para hacer cobro total">RESTA</span> <input type="number" id="resta" disabled value="{{$cliente->montomes}}">
						<input type="hidden" name="tdeuda" id="tdeuda" value="{{$cliente->montomes}}" class="form-control"> 
						</h3>
		</div>
				

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
						<select name="pidpago" id="pidpago" class="form-control">
						<option value="100" selected="selected">Selecione...</option>
						@foreach ($monedas as $m)<?php $count++;?>
						<option id=vm<?php echo $count; ?> value="{{$m-> idmoneda}}_{{$m->tipo}}_{{$m->valor}}">{{$m -> nombre}}</option>
						@endforeach
						</select>
						</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
						<input type="number" class="form-control" name="pmonto" id="pmonto" placeholder=""  min="1" step="0.01">
						</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						<div class="form-group">
						<input type="text" name="preferencia" class="form-control" id="preferencia" onchange="conMayusculas(this);" placeholder="Referencia...">
						</div>
		</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						<div class="form-group">
		<input type="date" name="fecha_emi"  id="fecha_emi" value="<?php echo $fserver;?>" class="form-control control">
							</div>
		</div>	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						<div class="form-group">
						<button type="button" id="bt_pago" class="form-control" > <i class="fa fa-fw fa-plus-square"></i> </button>
						</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<table id="det_pago" class="table table-striped table-bordered table-condensed table-hover">
                      <thead style="background-color: #54b279">
                          <th>Supr</th>
                          <th width="15%">Tipo</th>
						   <th width="15%">Monto</th>
                          <th>Monto $</th>
                          <th>Referencia</th>
						         <th>Fecha</th>
                      </thead>
                      <tfoot> 
                      <th></th>
                          <th></th>
						   <th></th>
						   <th></th>
                          <th><h3>Total $</h3></th>
                          <th><h3 id="total_abono">$.  0.00</h3></th><input type="hidden" name="totala" id="totala" value="0.00">
                          </tfoot>
                      <tbody></tbody>
                    </table>
	
		</div>
			
		<div class="col-lg-12 ol-md-12 col-sm-12 col-xs-12" align="right">	
			<div class="col-lg-4 ol-md-4 col-sm-4 col-xs-4" align="right" style="display: none" id="cfl">
							¿ Forma Libre ? <input type="checkbox" id="convertir" name="convertir" />							
							</div>
					<div class="col-lg-8 ol-md-8 col-sm-8 col-xs-8" align="right">
						<button type="button" class="btn btn-danger btn-sm" id="regresarp" data-dismiss="modal">Cancelar</button>
						<input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
						<button type="button" id="procesa" class="btn btn-primary btn-sm">Procesar</button>
						<div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
					  
						</div>
		</div>
</div>	
	</form>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>


</div>
 <div class="modal fade" id="modal">
	  <form action="{{route('pagocxc')}}" method="get" enctype="multipart/form-data" >    
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Abono Total de Facturas </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">
				<p>Seleccione Moneda:
				@foreach ($datos as $cat1)				
				<input type="hidden" value="{{$cat1->idventa}}" name="factura[]" class ="form-control"></input>
				<input type="hidden" value="{{$cat1->saldo}}" name="saldo[]" class ="form-control"></input>
					@endforeach
				</p>
					<select name="pidpagomodal" id="pidpagomodal" class="form-control">
					
						@foreach ($monedas as $mo)
						<?php if($mo->tipo==0){?> 
							<option value="{{$mo->idmoneda}}_{{$mo->nombre}}">{{$mo->idmoneda}}-{{$mo->nombre}}</option>
						<?php } ?>
						@endforeach
						</select>
			</div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Confirmar </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
		</form>
        <!-- /.modal-dialog -->
      </div>

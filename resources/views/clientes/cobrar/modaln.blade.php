<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modaln">
<form action="{{route('pagocxcnd')}}" method="GET" enctype="multipart/form-data" >    
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Abono Total de Notas de Debito </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">
				<p>Seleccione Moneda:
				@foreach ($notas as $cat2)				
				<input type="hidden" value="{{$cat2->idnota}}" name="nota[]" class ="form-control"></input>
				<input type="hidden" value="{{$cat2->pendiente}}" name="pendiente[]" class ="form-control"></input>
					@endforeach
				</p>
						<select name="pidpagomodaln" id="pidpagomodaln" class="form-control">
					
						@foreach ($monedas as $mo)
						<?php if($mo->tipo==0){?> 
							<option value="{{$mo->idmoneda}}_{{$mo->nombre}}">{{$mo->idmoneda}}-{{$mo->nombre}}</option>
						<?php } ?>
						@endforeach
						</select>
			<input type="hidden" value="{{$cliente->id_cliente}}" name="idcliente" class ="form-control"></input>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
</form>
</div>

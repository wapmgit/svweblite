<div class="modal  modal-primary" aria-hidden="true"
role="dialog" tabindex="-1" id="modalcredito-{{$datos->idproveedor}}">

			<form action="{{route('notasadmp')}}" method="GET" id="formulariocredito" enctype="multipart/form-data" >    

	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Generar Nota de Credito </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">

            	 <div class="form-group">
            			<label for="codigo">Cliente</label>
            			<input type="text" name="cliente"  required  value="{{$datos->nombre}}" class="form-control" readonly>
            						<input type="hidden" name="idcliente"  value="{{$datos->idproveedor}}" class="form-control" >
						<input type="hidden" name="tipo"  value="2" class="form-control" >
					</div>
	          
            	 <div class="form-group">
            			<label for="codigo">Descripcion</label>
            			<input type="text" name="descripcion"  required  class="form-control" placeholder="Descripcion...">
            		</div>

            	 <div class="form-group">
            			<label for="codigo">Referencia</label>
            			<input type="text" name="referencia"  required  class="form-control" placeholder="Referencia...">
            		</div>

            	 <div class="form-group">
            			<label for="codigo">Monto</label>
            			<input type="number" name="monto"  required  class="form-control" step="0.01" placeholder="Monto...">
            		</div>
            </div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btncredito" class="btn btn-primary">Confirmar</button>
			</div>
			</div>
		</div>
	</div>
</form>


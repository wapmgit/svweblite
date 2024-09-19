<div class="modal modal-warning" aria-hidden="true"
role="dialog" tabindex="-1" id="modaldebito-{{$cliente->id_cliente}}">

		<form action="{{route('notasadm')}}" method="get" id="formularidebito" enctype="multipart/form-data" >    	
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Generar Nota de Debito </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">

					<div class="form-group">
            			<label for="codigo">Cliente</label>
            			<input type="text" name="cliente"  required  value="{{$cliente->nombre}}" class="form-control" readonly>
						<input type="hidden" name="idcliente"  value="{{$cliente->id_cliente}}" class="form-control" >
						<input type="hidden" name="tipo"  value="1" class="form-control" >
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
            			<input type="number" name="monto"  required step="0.01" min="0.1" class="form-control" placeholder="Monto...">
            		</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btndedito" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
</form>

</div>

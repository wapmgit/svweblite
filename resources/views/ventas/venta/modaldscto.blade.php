<div class="modal modal-danger" aria-hidden="true"
role="dialog" tabindex="-1" id="modaldscto">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Descuento Global</h5>
				     <button type="button" class="close" data-dismiss="modal" 
			        	aria-label="Close">
                     <span aria-hidden="true">×</span>
                      </button>
                 
			    </div>
	    	</div>
			<div class="modal-body">
			 <div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            		 <div class="form-group">
					 <label for="stock">Modo </label> 
					 <select name="modo" id="modo" class="form-control">          			            			
            				<option value="0">Seleccione</option>
            				<option value="1">Porcentaje</option>
            				<option value="2">Monto</option>  							
            			</select>
						</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<label for="stock">Descuento </label> 
            		 <div class="form-group">
						<input type="number" class="form-control" min="1" id="mdscto" step="0.01" name="mdescuento"  value="0" >
						
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<label for="stock">Total Venta </label> 
            		 <div class="form-group">
						<input type="number" class="form-control" min="1" id="tvdscto" readonly >
						
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<label for="stock">Total con Dscto.</label> 
            		 <div class="form-group">
						<input type="number" class="form-control" min="1" id="tvcondscto"   readonly >
					
						
					</div>
				</div>
			</div>
		</div>  <!-- del modal body-->
			<div class="modal-primary">
			    <div class="modal-footer">
                    <div class="form-group">
                    <button type="button" id="btn-closedscto" class="btn btn-default btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btn-dscto" class="btn btn-primary btn-outline pull-right" data-dismiss="modal">Confirmar</button>
                    </div>
		    	</div>
			</div>
	</div>
</div>
</div>
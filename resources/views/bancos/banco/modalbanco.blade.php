
<div class="modal fade modal-slide-in-right  " aria-hidden="true"
role="dialog" tabindex="-1" id="modalbanco">
      <form action="{{route('almacenarbanco')}}"  method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
	<div class="modal-dialog">
		<div class="modal-content bg-primary">
		<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Registrar Usuario</h5>
		
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
							    <label for="nombre">Codigo</label>
							<input type="text" name="codigo" required value="" class="form-control" placeholder="codigo...">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						 <div class="form-group">
							    <label for="nombre">Telefono</label>
							<input type="text" name="telefono"   value="" class="form-control" placeholder="Telefono...">
						</div>
					</div>
	
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						 <div class="form-group">
							    <label for="nombre">Nombre</label>
							<input type="text" name="nombre"  required value="" class="form-control" placeholder="Nombre del Usuario...">
						</div>
					</div>

   
							
				</div>  <!-- del row -->

	
			</div>  <!-- del modal body-->
			<div class="modal-warning">
			<div class="modal-footer">
			 <div class="form-group">
				<button type="button" class="btn btn-default btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btn_ncliente" class="btn btn-primary btn-outline pull-right">Confirmar</button>
				</div>
			</div>
				</div>
		</div>
			
	</div>

				
</form>

</div>


  
	
   
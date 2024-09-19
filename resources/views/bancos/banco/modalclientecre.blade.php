<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-2" id="modalclientecre">
	{!!Form::open(array('url'=>'/bancos/cliente','method'=>'POST','autocomplete'=>'off','id'=>'formularioclientecre'))!!}
            {{Form::token()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h5 class="modal-title">Nuevo Registro </h5>
			</div>
			<div class="modal-body">

 	
				<div class="row">
	
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						 <div class="form-group">
							<label for="nombre">Nombre/Razon</label>
							<input type="text" name="cnombre" id="cnombre" onchange="conMayusculas(this)" required value="" class="form-control" placeholder="Nombre...">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
					<label for="descripcion">Cedula/Rif</label>
					<input type="text" name="ccedula" id="ccedula" class="form-control" placeholder="V000000">
				</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					  <div class="form-group">
					<label for="descripcion">Telefono</label>
					<input type="text" name="ctelefono" class="form-control" placeholder="0000-0000000">
				</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					 <div class="form-group">
				 <label for="direccion">Direccion</label>
				<input type="text" name="cdireccion" class="form-control" placeholder="Direccion...">
			   </div>
				</div>
				 								
				</div> 

	
			</div><div class="modal-footer">
			 <div class="form-group">
				<button type="button" id="c_clientecre"class="btn btn-default">Cerrar</button>
				  <input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
				<button type="button" id="Cenviar_cre" class="btn btn-primary" >Confirmar</button>
				</div>
			</div>
		</div>
			
	</div>
	
		{!!Form::close()!!}		

</div>

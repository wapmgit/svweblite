
<div class="modal fade modal-slide-in-right  " aria-hidden="true"
role="dialog" tabindex="-1" id="modalcta">
  	{!!Form::open(array('url'=>'/bancos/cuentascla','method'=>'POST','autocomplete'=>'off','id'=>'formulariocliente','files'=>'true'))!!}
 {{Form::token()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-success">
			<div class="modal-header ">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h5 class="modal-title">Nueva Cuenta de Clasificacion </h5>
			</div>
		</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						 <div class="form-group">
							    <label for="nombre">Codigo</label>
							<input type="text" name="codigo" id="ccodigo" required value="" class="form-control" placeholder="codigo...">
						</div>
					</div>
						<div class="col-lg-16col-sm-6 col-md-6 col-xs-12">
					  <div class="form-group">
						<label for="saco">Tipo</label>
                             <select name="tipo" id="ptipo" class ="form-control">
                        
                              <option value="1">Ingreso</option> 
                              <option value="2">Egreso</option> 
							  <option value="3">Ambos</option> 
                              </select>
					 
						</div>
				</div>
			
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					  <div class="form-group">
					<label for="descripcion">Descripcion</label>
					<input type="text" name="descripcion" class="form-control" placeholder="Descripcion...">
				</div>
				</div>
		
   
							
				</div>  <!-- del row -->

	
			</div>  <!-- del modal body-->
			<div class="modal-success">
			<div class="modal-footer">
			 <div class="form-group">
				<button type="button" class="btn btn-default btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" id="btn_ncliente" class="btn btn-primary btn-outline pull-right">Confirmar</button>
				</div>
			</div>
				</div>
		</div>
			
	</div>
{!!Form::close()!!}	
			

</div>


  
	
   
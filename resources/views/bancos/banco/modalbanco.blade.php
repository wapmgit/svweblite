
<div class="modal fade modal-slide-in-right  " aria-hidden="true"
role="dialog" tabindex="-1" id="modalbanco">
      <form action="{{route('almacenarbanco')}}"  method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
	<div class="modal-dialog">
		<div class="modal-content bg-primary">
		<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Registrar Banco</h5>
		
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
							    <label for="nombre">Tipo de Cuenta</label>
							 <select name="tipoc" class ="form-control">
                              <option value="Ahorro">Ahorro</option> 
                              <option value="Corriente">Corriente</option> 
                              </select>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						 <div class="form-group">
							    <label for="nombre">Nombre</label>
							<input type="text" name="nombre"  required value="" class="form-control" placeholder="Nombre del banco...">
						</div>
					</div>
					
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						 <div class="form-group">
							    <label for="nombre">Titular de la cuenta</label>
							<input type="text" name="titular"  required value="" class="form-control" placeholder="Representante...">
						</div>
					</div>
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						 <div class="form-group">
							    <label for="nombre">Numero de Cuenta</label>
							<input type="text" name="cuenta" required value="" class="form-control" placeholder="N° cuenta...">
						</div>
					</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						 <div class="form-group">
							    <label for="nombre">Email</label>
							<input type="text" name="mail" value="" class="form-control" placeholder="email...">
						</div>
					</div>	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	
@foreach ($monedas as $s)
	<div class="form-check">
  <input class="form-check-input" type="checkbox" name="pidserial[]" value="{{$s-> idmoneda}}" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
 Moneda-> {{$s -> nombre}}
  </label>
</div>	@endforeach
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


  
	
   
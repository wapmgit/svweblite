
<div class="modal fade" id="modalcliente" >
<form action="{{route('almacenacliente')}}" id="formulariocliente" method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
	<div class="modal-dialog" >	
		<div class="modal-content bg-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Registrar Nuevo Cliente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                 
			    </div>
			<div class="modal-body">	
				<div class="row">	
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						 <div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" name="cnombre" id="cnombre" onchange="conMayusculas(this)" required value="" class="form-control" placeholder="Nombre...">
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
					<label for="descripcion">Cedula</label>
					<input type="text" name="ccedula" onchange="conMayusculas(this)"  id="vidcedula" class="form-control"  maxlength="10" placeholder="V000000">
				</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
					<label for="descripcion">Rif</label>
					<input type="text" name="rif" onchange="conMayusculas(this)"  id="virif" class="form-control"  maxlength="12" placeholder="V00000-0">
				</div>
				</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">			
            <div class="form-group">
            	<label for="descripcion">Codigo</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" required name="codpais" value="{{old('codpais')}}" placeholder="+58" class="form-control">
                  </div>
            </div>
		</div>	
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					  <div class="form-group">
					<label for="descripcion">Telefono</label>
					<div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="ctelefono" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
				</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					 <div class="form-group">
				 <label for="direccion">Direccion</label>
				<input type="text" name="cdireccion" class="form-control" placeholder="Direccion...">
				<input type="hidden" name="idempresa" class="form-control" value="{{$empresa->idempresa}}">
			   </div>
				</div>

			   
					 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
					  <div class="form-group">
				 <label for="tipo_cliente">Tipo Cliente</label>
			  <select name="ctipo_cliente" class="form-control selectpicker">
							   <option value="1" selected>Contado</option>
							   <option value="0">Credito</option>
							  
						   </select>
			   </div>       </div>
					 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
					    <div class="form-group">
            			             <label for="tipo_precio">Vendedor </label><br>
            			<select name="idvendedor" class="form-control selectpicker">
            				@foreach ($vendedores as $cat)
            				<option value="{{$cat->id_vendedor}}">{{$cat->nombre}}</option>
            				@endforeach
            			</select>
            			
            		</div>   
			   </div>
			
				</div> 
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" id="closemodal" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
				  <input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
				<button type="button" id="Cenviar" class="btn btn-outline-light" >Guardar</button>
			</div>
		</div>
			

	</div>
	</form>

</div>


  
	
   
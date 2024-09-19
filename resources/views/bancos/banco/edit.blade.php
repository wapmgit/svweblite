
@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Banco: {{ $banco->nombre}}</h3>

		</div>
	</div>
  <form action="{{route('updatebanco')}}" id="formulario" method="GET" enctype="multipart/form-data" >       
        {{csrf_field()}}
           
 <div class="row">
            	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            		 <div class="form-group">
            			<label for="nombre">Nombre</label>
            			<input type="text" name="nombre" required value="{{$banco->nombre}}" class="form-control">
            			<input type="hidden" name="id" required value="{{$banco->idbanco}}" class="form-control">
            		</div>
            	</div>
        
            	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            		 <div class="form-group">
            			<label for="nombre">Titular</label>
            			<input type="text" name="titular" required value="{{$banco->titular}}" class="form-control">
            		</div>
            	</div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	 <div class="form-group">
            			<label for="codigo">Numero de Cuenta</label>
            			<input type="text" name="cuenta" required value="{{$banco->cuentaban}}" class="form-control">
            		</div>
            </div>
        
                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                 <div class="form-group">
                              <label for="util2">email</label>
                              <input type="text" value="{{$banco->email}}" name="email"   class="form-control">
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
            			<label >Monedas Relacionada:</label>
            		
            				@foreach ($monedas as $cat)
							<?php if($cat->idbanco==$banco->idbanco){?>
            				<label>{{$cat->nombre}}</label>
							<?php } ?>
            				@endforeach
            			</select>
            			
            		</div>
	</div>
	
	             <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">		
		   <div class="form-group">
		   <label>Monedas</label>
	@foreach ($monedas as $s)
	<div class="form-check">
  <input class="form-check-input" 	<?php if($s->idbanco==$banco->idbanco){echo  "checked";  } ?> type="checkbox" name="pidserial[]" value="{{$s-> idmoneda}}" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
 Moneda-> {{$s -> nombre}}
  </label>
</div>	@endforeach
	
	            		</div>
	</div>
 			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" align="center">
            	 <div class="form-group">
            		<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>	
            		</div>
            </div>
           
            	
         </div>
             </form>	
@endsection
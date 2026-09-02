@extends ('layouts.master')
@section ('contenido')
<?php $cntvend=count($clientes); ?>
	<div class="row">
		<h3>Nuevo Registro</h3> <?php if($cntvend==0){ echo "<P class='text-danger'><span class='text-danger'>¡ Debe Registrar Clientes !</span></p>";} ?>
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">			
			<form action="{{route('guardarregistro')}}" id="formulario" method="POST" enctype="multipart/form-data" >         
			{{csrf_field()}}
            <div class="form-group">
            	<label for="nombre">Nombre Cliente</label>
            	<select name="idcliente"  class="form-control selectpicker" data-live-search="true">
            				@foreach ($clientes as $cat)
            				<option value="{{$cat->id_cliente}}">{{$cat->nombre}} {{$cat->cedula}}</option>
            				@endforeach
            			</select>  
            </div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">	
		   	   <div class="form-group">
            			<label for="tipo_precio">Fecha Nacimiento </label><br>
                      <input type="date" name="fnacimiento"   value="{{old('cedula')}}" class="form-control">			
            		</div>
		</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">			
            <div class="form-group">
            	<label for="descripcion">Condicion Medica</label>
            	<input type="text" name="condicion"  value="" class="form-control"  >
			
            </div>
		</div>	
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">			
            <div class="form-group">
            	<label for="descripcion">Medicamentos</label>
            	<input type="text" name="medicamento"  value="" class="form-control"  >
			
            </div>
		</div>	
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">			
            <div class="form-group">
            	<label for="descripcion">Alergias</label>
            	<input type="text" name="alergias"  value="" class="form-control"  >
			
            </div>
		</div>	
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
           <div class="form-group">
             <label for="tipo_cliente" >Sexo</label>
			<select name="sexo" id="sexo" class="form-control">
                           <option value="M" selected>Masculino</option>
                           <option value="F">Femenino</option>                         
            </select>
           </div>
		</div>		
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
		   	   <div class="form-group">
            			<label for="tipo_precio">Fecha Inicio </label><br>
                      <input type="date" name="finicio"   value="{{old('cedula')}}" class="form-control">			
            		</div>
		</div>
		
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
           <div class="form-group">
				<label for="tipo_precio">Monto Mensual ($)</label><br>
				  <input type="number" name="monto"   value="" class="form-control">
				  <input type="hidden" name="empresa"    value="{{$empresa->idempresa}}" >

           </div>
		</div>	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
           <div class="form-group">
             <label for="tipo_cliente" >Fecha Pago</label>
			<select name="tipo_pago" id="tipo_pago" class="form-control">
                           <option value="1" selected>Mensual</option>
                           <option value="0">Quincenal</option>                         
            </select>
           </div>
		</div>
			<div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">				
            <div class="form-group">
            	<label for="descripcion">Telefono Contacto</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="telefono" value="" class="form-control" >
                  
				  </div>
            </div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">			
             <div class="form-group">
             <label for="direccion">Contacto Emergencia</label>
            <input type="text" name="contacto" class="form-control"  placeholder="Nombre y Apellido...">

		   </div>
		</div>


		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">	
            <div class="form-group">
				<button class="btn btn-danger btn-sm" type="reset" id="btncancelar">Cancelar</button>
            	<button class="btn btn-primary btn-sm" <?php if($cntvend==0){ echo "style='display: none'"; }?> type="button" id="btnguardar">Guardar</button>
			    <div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
            </div>	
</div>			
		</form>       
	</div>
@endsection
@push('scripts')
	<script>

		$(document).ready(function(){ 
	  $('#btnguardar').click(function(){   
		document.getElementById('loading').style.display=""; 
		document.getElementById('btnguardar').style.display="none"; 
		document.getElementById('btncancelar').style.display="none"; 
		document.getElementById('formulario').submit(); 
    })


		  $('#prif').click(function(){ 
		  $("#rif").val($("#vidcedula").val());
		});		  
	
			 });
			 function conMayusculas(field) {
            field.value = field.value.toUpperCase()
}
				</script>
			@endpush
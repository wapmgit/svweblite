@extends ('layouts.master')
@section ('contenido')
	<div class="row">	
	<h3>Editar datos de: {{ $cliente->nombre}}</h3>
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">	
        <form action="{{route('updatemiembro')}}" id="formulario" method="GET" enctype="multipart/form-data" >       
        {{csrf_field()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
				<input type="hidden" name="id" class="form-control" value="{{$cliente->idmiembro}}">
            	<input type="text" name="nombre" readonly class="form-control" onchange="conMayusculas(this)" value="{{$cliente->nombre}}" placeholder="Nombre...">
				@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
			</div>
	</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">	
		   	   <div class="form-group">
            			<label for="tipo_precio">Fecha Nacimiento </label><br>
                      <input type="date" name="fnacimiento"   value="{{$cliente->fnacimiento}}" class="form-control">			
            		</div>
		</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">			
            <div class="form-group">
            	<label for="descripcion">Condicion Medica</label>
            	<input type="text" name="condicion"  value="{{$cliente->condicion}}" class="form-control"  >
			
            </div>
		</div>	
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">			
            <div class="form-group">
            	<label for="descripcion">Medicamentos</label>
            	<input type="text" name="medicamento"  value="{{$cliente->medicamento}}" class="form-control"  >
			
            </div>
		</div>	
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">			
            <div class="form-group">
            	<label for="descripcion">Alergias</label>
            	<input type="text" name="alergias"  value="{{$cliente->alergias}}" class="form-control"  >
			
            </div>
		</div>	
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
           <div class="form-group">
             <label for="tipo_cliente" >Sexo</label>
			<select name="sexo" id="sexo" class="form-control">
                           <option value="M" @if ($cliente->sexo=="M") selected @endif> Masculino</option>
                           <option value="F" @if ($cliente->sexo=="F") selected @endif>Femenino</option>                         
            </select>
           </div>
		</div>	
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
		   	   <div class="form-group">
            			<label for="tipo_precio">Fecha Inicio </label><br>
                      <input type="date" name="finicio"   value="{{$cliente->fecha_inicio}}" class="form-control">			
            		</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
           <div class="form-group">
				<label for="tipo_precio">Monto Mensual ($)</label><br>
				  <input type="number" name="monto"   value="{{$cliente->montomes}}" class="form-control">
				  <input type="hidden" name="empresa"    value="{{$empresa->idempresa}}" >

           </div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
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
                    <input type="text" name="telefono" value="{{$cliente->tel_emergencia}}" class="form-control" >
                  
				  </div>
            </div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">			
             <div class="form-group">
             <label for="direccion">Contacto Emergencia</label>
            <input type="text" name="contacto" class="form-control"  value="{{$cliente->contacto}}" placeholder="Nombre y Apellido...">

		   </div>
		</div>
		


		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">	
            <div class="form-group">
						<button class="btn btn-danger btn-sm" type="reset" id="btncancelar">Cancelar</button>
						<button class="btn btn-primary btn-sm" type="button" id="btnguardar">Actualizar</button>
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
		});

	$('#btncancelar').click(function(){  
	   window.location="{{route('membresia')}}";
	 })
	});

	 function conMayusculas(field) {
            field.value = field.value.toUpperCase()
}
	</script>
@endpush
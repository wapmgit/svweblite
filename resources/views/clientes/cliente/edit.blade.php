@extends ('layouts.master')
@section ('contenido')
	<div class="row">	
	<h3>Editar datos de: {{ $cliente->nombre}}</h3>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
        <form action="{{route('updatecliente')}}" id="formulario" method="POST" enctype="multipart/form-data" >       
        {{csrf_field()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
				<input type="hidden" name="id" class="form-control" value="{{$cliente->id_cliente}}">
            	<input type="text" name="nombre" class="form-control" onchange="conMayusculas(this)" value="{{$cliente->nombre}}" placeholder="Nombre...">
				@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
			</div>
	</div>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">	
            <div class="form-group">
            	<label for="cedula">Cedula</label>
            	<input type="text" name="cedula" class="form-control"  onchange="conMayusculas(this)" value="{{$cliente->cedula}}" placeholder="cedula...">
					@if($errors->first('cedula'))<P class='text-danger'>{{$errors->first('cedula')}}</p>@endif
			</div>
	</div>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">	
            <div class="form-group">
            	<label for="cedula">Rif</label>
            	<input type="text" name="rif" class="form-control" onchange="conMayusculas(this)" value="{{$cliente->rif}}" placeholder="rif...">
				@if($errors->first('rif'))<P class='text-danger'>{{$errors->first('rif')}}</p>@endif
            </div>
	</div>
			<div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">			
            <div class="form-group">
            	<label for="descripcion">Codigo</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" required name="codpais" value="{{$cliente->codpais}}" placeholder="+58" class="form-control">
				  </div>
            </div>
		</div>	
		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">			
             <div class="form-group">
            	<label for="telefono">Telefono</label>
            	<input type="text" name="telefono" class="form-control" value="{{$cliente->telefono}}" placeholder="telefono...">
            </div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">			
              <div class="form-group">
            <label for="telefono">Direccion</label>
                <input type="text" name="direccion" class="form-control" value="{{$cliente->direccion}}" placeholder="direccion...">
           </div>
	</div>

					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">		
              <div class="form-group">
			  <input type="hidden" name="tclient" id="tclient" value="{{$cliente->tipo_cliente}}">
             <label for="tipo_cliente">Tipo cliente: <?php if($cliente->tipo_cliente==1){ echo "Contado";} else{ echo "Credito";}?></label>
          <select name="tipo_cliente"  id="tipo_cliente" class="form-control">
                            
                           <option value="1"<?php if($cliente->tipo_cliente==1){ echo "selected";}?>> Contado</option>
                           <option value="0" <?php if($cliente->tipo_cliente==0){ echo "selected";}?> >Credito</option>
                          
                       </select>
           </div>
	</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
           <div class="form-group">
				<label for="tipo_precio">Dias Credito </label><br>
				  <input type="number" name="diascre"  id="diascre"  value="{{$cliente->diascredito}}" class="form-control">

           </div>
		</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">			
           <div class="form-group">
             <label for="tipo_precio">Tipo de Precio </label><br>
        <label for="precio1"> Precio 1 </label> <input name="precio" type="radio" value="1" <?php if($cliente->tipo_precio==1){ echo "checked='checked'"; } ?>>
				
           </div>
	</div>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">			
		   <div class="form-group">
            			<label >Vendedor: {{$datos->vendedor}}</label>
            			<select name="idvendedor" class="form-control">
            				@foreach ($vendedores as $cat)
            				<option value="{{$cat->id_vendedor}}">{{$cat->nombre}}</option>
            				@endforeach
            			</select>
            			
            		</div>
	</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">	
            <div class="form-group">
						<button class="btn btn-danger btn-sm" type="reset" id="btncancelar">Cancelar</button>
						<button class="btn btn-primary btn-sm" type="button" id="btnguardar">Guardar</button>
					   <div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
            </div>	
			</div>
            </form>
</div>

@endsection
 @push('scripts')
 <script>
	$(document).ready(function(){	  
	
	var tc= $("#tclient").val();
			
			  	  if(tc==0){ $("#diascre").attr("readonly",false); }
			  else { $("#diascre").attr("readonly",true);
			  }
		 $('#btnguardar').click(function(){   		 
		document.getElementById('loading').style.display=""; 
		document.getElementById('btnguardar').style.display="none"; 
		document.getElementById('btncancelar').style.display="none"; 
		document.getElementById('formulario').submit(); 
		});
			    $("#tipo_cliente").on("change",function(){			
			  var valor= $("#tipo_cliente").val();
			  if(valor==0){$("#diascre").attr("readonly",false); 
			  $("#diascre").val(5);}
			  else { $("#diascre").attr("readonly",true);
				$("#diascre").val(0);
			  }
				 });
	});
	 $('#btncancelar').click(function(){  
	   window.location="{{route('clientes')}}";
	 })
	 	$("#arsi").on("click",function(){	
		$("#retencion").attr("disabled",false); 
	});
		$("#arno").on("click",function(){	
		$("#retencion").val(""); 
		$("#retencion").attr("disabled",true); 
	});
			 function conMayusculas(field) {
            field.value = field.value.toUpperCase()
}
				</script>
			@endpush
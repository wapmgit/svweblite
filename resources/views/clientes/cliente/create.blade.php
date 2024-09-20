@extends ('layouts.master')
@section ('contenido')
<?php $cntvend=count($vendedores); ?>
	<div class="row">
		<h3>Nuevo Cliente</h3> <?php if($cntvend==0){ echo "<P class='text-danger'><span class='text-danger'>¡ Debe Registrar Vendedor !</span></p>";} ?>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">			
			<form action="{{route('guardarcliente')}}" id="formulario" method="POST" enctype="multipart/form-data" >         
			{{csrf_field()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" class="form-control" value="{{old('nombre')}}" onchange="conMayusculas(this)" placeholder="Nombre...">
				@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
            </div>
		</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">			
            <div class="form-group">
            	<label for="descripcion">Cedula</label>
            	<input type="text" name="cedula" id="vidcedula" onchange="conMayusculas(this)"  value="{{old('cedula')}}" class="form-control" maxlength="10" placeholder="V000000">
					@if($errors->first('cedula'))<P class='text-danger'>{{$errors->first('cedula')}}</p>@endif
            </div>
		</div>	
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">					
            <div class="form-group">
            	<label for="rif" id="prif" title="Pasar Cedula">Rif</label>
            	<input type="text" name="rif" id="rif" value="{{old('rif')}}" onchange="conMayusculas(this)"  class="form-control" maxlength="12" placeholder="V000000-0">
					@if($errors->first('rif'))<P class='text-danger'>{{$errors->first('rif')}}</p>@endif
            </div>
		</div>	
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">				
            <div class="form-group">
            	<label for="descripcion">Telefono</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">			
             <div class="form-group">
             <label for="direccion">Direccion</label>
            <input type="text" name="direccion" class="form-control" value="{{old('direccion')}}" placeholder="Direccion...">
           </div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
           <div class="form-group">
             <label for="tipo_cliente" >Tipo cliente</label>
			<select name="tipo_cliente" id="tipo_cliente" class="form-control">
                           <option value="1" selected>Contado</option>
                           <option value="0">Credito</option>                         
            </select>
           </div>
		</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
           <div class="form-group">
				<label for="tipo_precio">Dias Credito </label><br>
				  <input type="number" name="diascre"  id="diascre"  value="" class="form-control">
				  <input type="hidden" name="empresa"    value="{{$empresa->idempresa}}" >

           </div>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">	
           <div class="form-group">
				<label for="tipo_precio">Tipo de Precio </label><br>
				<label for="precio1"> Precio 1 </label> <input name="precio" type="radio" value="1" checked="checked">
				<!--<label for="precio2"> Precio 2 </label> <input name="precio" type="radio" value="2"> -->
           </div>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">	
		   	   <div class="form-group">
            			<label for="tipo_precio">Vendedor </label><br>
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
            	<button class="btn btn-primary btn-sm" <?php if($cntvend==0){ echo "style='display: none'"; }?> type="button" id="btnguardar">Guardar</button>
			    <div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
            </div>	
</div>			
		</form>       
	</div>
@endsection
@push('scripts')
	<script>
	    $('[data-mask]').inputmask()
		$(document).ready(function(){
			$("#diascre").attr("readonly",true); 
		$("#vidcedula").on("change",function(){
         var form2= $('#formulario');
        var url2 = '{{route("validarcliente")}}';
        var data2 = form2.serialize();
			$.post(url2,data2,function(result2){  
		var resultado2=result2;
         console.log(resultado2); 
         rows=resultado2.length; 
			if (rows > 0){
            var nombre=resultado2[0].nombre;
			var cedula=resultado2[0].cedula; 
			var rif=resultado2[0].telefono;  
			alert ('Numero de identificacion ya existe, Nombre: '+nombre+' Cedula: '+cedula+' telefono: '+rif);   
           $("#vidcedula").val("");
           $("#vidcedula").focus();
			}    
          });
     });
	 		$("#tipo_cliente").on("change",function(){			
			  var valor= $("#tipo_cliente").val();
			  if(valor==0){$("#diascre").attr("readonly",false); 
			  $("#diascre").val(5);}
			  else { $("#diascre").attr("readonly",true);
				$("#diascre").val(0);
			  }
				 });
	  $('#btnguardar').click(function(){   
		document.getElementById('loading').style.display=""; 
		document.getElementById('btnguardar').style.display="none"; 
		document.getElementById('btncancelar').style.display="none"; 
		document.getElementById('formulario').submit(); 
    })
		$("#arsi").on("click",function(){	
		$("#retencion").val("75");
		$("#retencion").attr("disabled",false); 
	});
	$("#arno").on("click",function(){	
		$("#retencion").val(""); 
		$("#retencion").attr("disabled",true); 
	});

		  $('#prif').click(function(){ 
		  $("#rif").val($("#vidcedula").val());
		});		  
	
			 });
			 function conMayusculas(field) {
            field.value = field.value.toUpperCase()
}
				</script>
			@endpush
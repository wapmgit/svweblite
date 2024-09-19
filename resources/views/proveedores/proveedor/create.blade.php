@extends ('layouts.master')
@section ('contenido')
		<div class="row">			
		<h3>Nuevo Proveedor</h3>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form action="{{route('guardarproveedor')}}" id="formulario" method="POST" enctype="multipart/form-data" >         
			{{csrf_field()}}
            <div class="form-group">
            	<label for="nombre">Nombre o Razon Social</label>
            	<input type="text" name="nombre" onchange="conMayusculas(this)" value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
				@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">			
            <div class="form-group">
            	<label for="descripcion">Rif</label>
            	<input type="text" name="rif" class="form-control" value="{{old('rif')}}" onchange="conMayusculas(this)" maxlength="12" id="rif" placeholder="V00000000-0">
				@if($errors->first('rif'))<P class='text-danger'>{{$errors->first('rif')}}</p>@endif
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">			
            <div class="form-group">
            	<label for="descripcion">Telefono</label>
				<div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" value="{{old('telefono')}}" name="telefono" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
            </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">			
             <div class="form-group">
             <label for="imagen">Direccion</label>
            <input type="text" name="direccion" value="{{old('direccion')}}" class="form-control" placeholder="Direccion...">
           </div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">			
		    <div class="form-group">
             <label for="imagen">Contacto</label>
            <input type="text" name="contacto" class="form-control" value="{{old('contacto')}}" placeholder="Contacto...">
           </div>
		</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">	
            <div class="form-group">
            	       <button class="btn btn-danger btn-sm" type="reset" id="btncancelar">Cancelar</button>
						<button class="btn btn-primary btn-sm" type="button" id="btnguardar">Guardar</button>
					   <div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
            </div>
	</form>        
</div>	
		</div>
	</div>

@endsection
 @push('scripts')
 <script>
	$(document).ready(function(){
	$('[data-mask]').inputmask();
		      $("#rif").on("change",function(){
         var form2= $('#formulario');
        var url2 = '{{route("validarif")}}';
        var data2 = form2.serialize();
    $.post(url2,data2,function(result2){  
      var resultado2=result2;
         console.log(resultado2); 
         rows=resultado2.length; 
      if (rows > 0){
            var nombre=resultado2[0].nombre;
          var rif=resultado2[0].rif; 
          var telefono=resultado2[0].telefono;   
          alert ('Rif ya existe!!, Nombre: '+nombre+' Rif: '+rif+' Telefono: '+telefono);   
           $("#rif").val("");
           $("#rif").focus();
}    
          });
     });
		 $('#btnguardar').click(function(){   
		document.getElementById('loading').style.display=""; 
		document.getElementById('btnguardar').style.display="none"; 
		document.getElementById('btncancelar').style.display="none"; 
		document.getElementById('formulario').submit(); 
		})
	});
			 function conMayusculas(field) {
            field.value = field.value.toUpperCase()
}
				</script>
			@endpush
    
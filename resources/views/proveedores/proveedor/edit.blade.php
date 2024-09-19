@extends ('layouts.master')
@section ('contenido')
	<div class="row">			
	<h3>Editar datos de: {{ $proveedor->nombre}}</h3>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form action="{{route('updateproveedor')}}" id="formulario" method="POST" enctype="multipart/form-data" >       
			{{csrf_field()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
				<input type="hidden" name="id" class="form-control" value="{{$proveedor->idproveedor}}">
            	<input type="text" name="nombre" class="form-control" onchange="conMayusculas(this)" value="{{$proveedor->nombre}}" placeholder="Nombre...">
				@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
			</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
            <div class="form-group">
            	<label for="rif">Rif</label>
            	<input type="text" name="rif" class="form-control" value="{{$proveedor->rif}}" placeholder="rif...">
				@if($errors->first('rif'))<P class='text-danger'>{{$errors->first('rif')}}</p>@endif           
		   </div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
             <div class="form-group">
            	<label for="telefono">Telefono</label>
            	<input type="text" name="telefono" class="form-control" value="{{$proveedor->telefono}}" placeholder="telefono...">
            </div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
              <div class="form-group">
            <label for="direccion">Direccion</label>
                <input type="text" name="direccion" class="form-control" value="{{$proveedor->direccion}}" placeholder="direccion...">
			@if($errors->first('direccion'))<P class='text-danger'>{{$errors->first('direccion')}}</p>@endif 
		   </div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
		         <div class="form-group">
            <label for="direccion">Contacto</label>
                <input type="text" name="contacto" class="form-control" value="{{$proveedor->contacto}}" placeholder="Contacto...">
           </div>
	</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">	
            <div class="form-group">
						<button class="btn btn-danger btn-sm"  type="reset" id="btncancelar">Cancelar</button>
						<button  class="btn btn-primary btn-sm" type="button" id="btnguardar">Guardar</button>
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
		 $('#btnguardar').click(function(){   
		document.getElementById('loading').style.display=""; 
		document.getElementById('btnguardar').style.display="none"; 
		document.getElementById('btncancelar').style.display="none"; 
		document.getElementById('formulario').submit(); 
		})
	});
		 $('#btncancelar').click(function(){  
	   window.location="{{route('proveedores')}}";
	 })
			 function conMayusculas(field) {
            field.value = field.value.toUpperCase()
}
				</script>
			@endpush
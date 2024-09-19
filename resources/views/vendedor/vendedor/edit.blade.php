@extends ('layouts.master')
@section ('contenido')
	<div class="row"><h3>Editar Vendedor: {{ $vendedores->nombre}}</h3>			
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form action="{{route('updatevendedor')}}" id="formulariov" method="get" enctype="multipart/form-data" >       
			{{csrf_field()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="hidden" name="id"  value="{{$vendedores->id_vendedor}}" class="form-control">
				<input type="text" name="nombre" class="form-control" onchange="conMayusculas(this)"  value="{{$vendedores->nombre}}" placeholder="Nombre...">
				@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
            	<label for="descripcion">Cedula</label>
            	<input type="text" name="cedula" class="form-control" value="{{$vendedores->cedula}}" placeholder="Descripción...">
            @if($errors->first('cedula'))<P class='text-danger'>{{$errors->first('cedula')}}</p>@endif
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">		
            <div class="form-group">
            	<label for="descripcion">Telefono</label>
            	<input type="text" name="telefono" class="form-control" value="{{$vendedores->telefono}}" placeholder="Descripción...">
            </div>
		</div>	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">			
            <div class="form-group">
            	<label for="descripcion">Direccion</label>
            	<input type="text" name="direccion" class="form-control" value="{{$vendedores->direccion}}" placeholder="Descripción...">
            </div>
		</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">	
            <div class="form-group">
					<button class="btn btn-primary btn-sm" type="button" id="btnguardar">Guardar</button>
            	       <button class="btn btn-danger btn-sm" type="reset" id="btncancelar">Cancelar</button>
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
		document.getElementById('formulariov').submit(); 
		})
	});
	 $('#btncancelar').click(function(){  
	   window.location="{{route('vendedores')}}";
	 })
	function conMayusculas(field) {
            field.value = field.value.toUpperCase()
	}
				</script>
			@endpush
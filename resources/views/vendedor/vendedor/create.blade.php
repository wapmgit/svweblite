@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<h3>Nuevo Vendedor</h3>	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		

			<form action="{{route('guardarvendedor')}}" id="formulario" method="POST" enctype="multipart/form-data" >         
			{{csrf_field()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" onchange="conMayusculas(this)" value="{{old('nombre')}}"  class="form-control" placeholder="Nombre...">
            	@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
			</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="nombre">Cedula</label>
            	<input type="text" name="cedula" class="form-control" value="{{old('cedula')}}"  placeholder="V00000000">
             @if($errors->first('cedula'))<P class='text-danger'>{{$errors->first('cedula')}}</p>@endif
			</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">			
			<div class="form-group">
            	<label for="nombre">Telefono</label>
            	<input type="text" name="telefono" class="form-control" value="{{old('telefono')}}"  data-inputmask='"mask": "(999) 999-9999"' data-mask>
            </div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
            	<label for="descripcion">Direccion</label>
            	<input type="text" name="direccion" class="form-control" value="{{old('direccion')}}" placeholder="Direccion...">
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
	</div>
@endsection
@push('scripts')
 <script>
	$(document).ready(function(){
		$('[data-mask]').inputmask();
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
@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cuenta de Clasificacion</h3>

        <form action="{{route('addcta')}}" id="formcategoria" method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
            <div class="form-group">

            	<label for="nombre">Codigo</label>				
            	<input type="text" name="codigo" id="nombre" onchange="conMayusculas(this)"  class="form-control" placeholder="Codigo...">
				@if($errors->first('codigo'))<P class='text-danger'>{{$errors->first('codigo')}}</p>@endif
			</div>
            <div class="form-group">
            	<label for="descripcion">Nombre</label>
            	<input type="text" name="nombre" onchange="conMayusculas(this)" class="form-control" placeholder="Descripción...">
				@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
            </div>
           	 <div class="form-group">
            			<label >Tipo</label>
            			<select name="tipo" id="idcategoria" class="form-control">           	
            				<option value="1">Ingreso</option>
            				<option value="2">Egreso</option>
            				<option value="3">Ambos</option>
            			
            			</select>
            	       				
            		</div>         
		</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">	
            <div class="form-group">
				<button class="btn btn-danger btn-sm" id="btncancelar" type="reset">Cancelar</button>
            	<button class="btn btn-primary btn-sm" id="btnguardar" type="submit"  accesskey="l"><u>G</u>uardar</button>
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
		document.getElementById('formcategoria').submit(); 
		})
       });
	    function conMayusculas(field) {
            field.value = field.value.toUpperCase()
}
</script>
@endpush
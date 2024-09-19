@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Empresa</h3>
</div>
</div>
        <form action="{{route('saveempresa')}}" id="formcategoria" method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
		  <div class="row">
		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
            	<label for="nombre">Nombre</label>				
            	<input type="text" name="nombre" id="nombre" onchange="conMayusculas(this)"  class="form-control" placeholder="Nombre...">
				@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
			</div>
			</div>  
				 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
            	<label for="descripcion">Rif</label>
            	<input type="text" name="rif" class="form-control" placeholder="Rif...">
				@if($errors->first('rif'))<P class='text-danger'>{{$errors->first('rif')}}</p>@endif
            </div>	
            </div>	
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
            	<label for="nombre">UUID</label>				
            	<input type="text" name="uuid"  onchange="conMayusculas(this)"  class="form-control" placeholder="UUID...">
				@if($errors->first('uuid'))<P class='text-danger'>{{$errors->first('uuid')}}</p>@endif
			</div>
			</div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
           <div class="form-group">
            	<label for="descripcion">Telefono</label>
            	<input type="text" name="telefono" class="form-control" placeholder="Telefono...">
            </div>	
            </div>	
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
           <div class="form-group">
            	<label for="descripcion">Fecha Inicio</label>
            	<input type="date" name="fechainicio" class="form-control">
            </div>	
            </div>	
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
            	<label for="descripcion">Direccion</label>
            	<input type="text" name="direccion" class="form-control" placeholder="Direccion...">
            </div>		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombre Usuario</th>
					<th>Mail</th>
					<th>Contraseña</th>
				</thead>
				<tr>
					<td><input type="text" name="nusuario[]" class="form-control"></td>
					<td><input type="mail" name="mail[]" class="form-control"></td>
					<td><input type="text" name="pass[]" class="form-control"></td>
				</tr>
				<tr>
					<td><input type="text" name="nusuario[]" class="form-control"></td>
					<td><input type="mail" name="mail[]" class="form-control"></td>
					<td><input type="text" name="pass[]" class="form-control"></td>
				</tr>
				<tr>
					<td><input type="text" name="nusuario[]" class="form-control"></td>
					<td><input type="mail" name="mail[]" class="form-control"></td>
					<td><input type="text" name="pass[]" class="form-control"></td>
				</tr>
			</table>
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
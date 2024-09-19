@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cuenta: {{ $cta->descrip}}</h3>
        <form action="{{route('updatecta')}}" id="formcategoria" method="POST" enctype="multipart/form-data" >       
        {{csrf_field()}}

            <div class="form-group">
            	<label for="nombre">Nombre</label>
				   <input type="hidden" name="id" class="form-control" value="{{$cta->idcod}}">
            	<input type="text" name="nombre" class="form-control"  onchange="conMayusculas(this)"  value="{{$cta->descrip}}" placeholder="Nombre...">
				@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
		   </div>
            <div class="form-group">
            	<label for="descripcion">Codigo</label>
            	<input type="text" name="codigo" class="form-control" value="{{$cta->codigo}}" placeholder="Codigo...">
		@if($errors->first('codigo'))<P class='text-danger'>{{$errors->first('codigo')}}</p>@endif          
		  </div>
			           	 <div class="form-group">
            			<label >Tipo</label>
            			<select name="tipo" id="tipo" class="form-control">           	
            				<option  <?Php if($cta->tipo==1) echo "selected"; ?>  value="1">Ingreso</option>
            				<option   <?Php if($cta->tipo==2) echo "selected"; ?>  value="2">Egreso</option>
            				<option  <?Php if($cta->tipo==3) echo "selected"; ?>  value="3">Ambos</option>
            			
            			</select>
            	       				
            		</div>  
			                  <div class="form-group"></br>
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
					  <input type="checkbox" name="estatus"  <?Php if($cta->inactiva==0) echo "checked"; ?> class="custom-control-input" id="customSwitch3">
       
                      <label class="custom-control-label" for="customSwitch3">Estatus</label>
                    </div>
                  </div>
	          
		</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">	
            <div class="form-group">
				<button class="btn btn-danger btn-sm" id="btncancelar" type="reset">Cancelar</button>
            	<button class="btn btn-primary btn-sm" id="btnguardar" type="submit">Guardar</button>
				<div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
            </div>	
			</div> 	</form>  
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
@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Moneda: {{ $mone->nombre}}</h3>
        <form action="{{route('updatemoneda')}}" id="formcategoria" method="POST" enctype="multipart/form-data" >       
        {{csrf_field()}}

            <div class="form-group">
            	<label for="nombre">Nombre</label>
				   <input type="hidden" name="id" class="form-control" value="{{$mone->idmoneda}}">
            	<input type="text" name="nombre" class="form-control"   value="{{$mone->nombre}}" placeholder="Nombre...">
				@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
		   </div>
            <div class="form-group">
				<label for="descripcion">Simbolo</label>
            	<input type="text" name="simbolo" class="form-control" required value="{{$mone->simbolo}}">
				@if($errors->first('simbolo'))<P class='text-danger'>{{$errors->first('simbolo')}}</p>@endif
            </div>
		<div class="form-group"></br>	<label for="descripcion">tipo</label>
			<select name="tipo"  class="form-control">           				
            				<option value="0" <?php if ($mone->tipo==0){ echo "selected"; }?>>=</option>
            				<option value="1" <?php if ($mone->tipo==1){ echo "selected"; }?>>Multiplica</option>
            				<option value="2" <?php if ($mone->tipo==2){ echo "selected"; }?>>Divide</option>
							</select>
                  </div>	<div class="form-group">
				  	<label for="stock">Valor</label>
            			<input type="text" name="valor" required  value="{{$mone->valor}}" class="form-control" placeholder="valor...">
						@if($errors->first('valor'))<P class='text-danger'>{{$errors->first('valor')}}</p>@endif
	          
		</div>
		     <div class="form-group">
			<label for="descripcion">Referencia de Moneda</label>
					<select name="referencia"  class="form-control">           				
            				<option value="0" <?php if ($mone->referencia==0){ echo "selected"; }?>>Ninguna</option>
            				<option value="1" <?php if ($mone->referencia==1){ echo "selected"; }?>>Bs</option>
            				<option value="2" <?php if ($mone->referencia==2){ echo "selected"; }?>>Pesos</option>
							</select>
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
@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Moneda</h3>

        <form action="{{route('savemoneda')}}" id="formcategoria" method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
            <div class="form-group">

            	<label for="nombre">Nombre</label>				
            	<input type="text" name="nombre" id="nombre"  class="form-control" placeholder="Nombre...">
				@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
			</div>
            <div class="form-group">
            	<label for="descripcion">Simbolo</label>
            	<input type="text" name="simbolo" class="form-control" required placeholder="simbolo...">
				@if($errors->first('simbolo'))<P class='text-danger'>{{$errors->first('simbolo')}}</p>@endif
            </div>   
            <div class="form-group">
					<select name="tipo"  class="form-control">           				
            				<option value="0">=</option>
            				<option value="1">Multiplica</option>
            				<option value="2">Divide</option>
							</select>
            </div>  
			
			<div class="form-group">
            			<label for="stock">Valor</label>
            			<input type="number" name="valor" required  value="0" class="form-control" placeholder="valor...">
						@if($errors->first('valor'))<P class='text-danger'>{{$errors->first('valor')}}</p>@endif
            		</div>  
            <div class="form-group">
			<label for="descripcion">Referencia de Moneda</label>
					<select name="referencia"  class="form-control">           				
            				<option value="0">Ninguna</option>
            				<option value="1">Bs</option>
            				<option value="2">Pesos</option>
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
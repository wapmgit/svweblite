@extends ('layouts.master')
@section ('contenido')
<div class="row">
			@foreach($detalles as $det)
				<div class="col-lg-2  col-md-2 col-sm-2 col-xs-2" >
                    <div  align="center">
						<label for="proveedor" align="center">{{$det->codigo}}</label> </br>
					    <label for="proveedor"> {{$det->articulo}} </label></br>
						<label for="proveedor"> {{$det->precio1}} $</label>
                    </div>
                </div>  
            @endforeach	
</div>
         	<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
					<button type="button" id="regresar" class="btn btn-danger btn-xs" data-dismiss="modal">Regresar</button>
					<button type="button" id="imprimir" class="btn btn-primary btn-xs" data-dismiss="modal">Imprimir</button>
					 
                    </div>
                </div>  
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  document.getElementById('regresar').style.display="none";
  window.print(); 
  window.location="{{route('ajustes')}}";
    });
$('#regresar').on("click",function(){
  window.location="{{route('ajustes')}}";
  
});
});
</script>
@endpush
@endsection
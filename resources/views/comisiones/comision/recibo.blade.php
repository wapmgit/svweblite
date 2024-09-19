@extends ('layouts.master')
@section ('contenido')
<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
            	 <div class="form-group">
            			<label ><font size="4">{{$empresa->nombre}}</font></label></br>
						<label ><font size="3">{{$empresa->rif}}</font></label></br>	
						<label >{{$empresa->direccion}}. Tel: {{$empresa->telefono}}</label>
            	 </div>  
	    </div>
		</div>
		<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3 align="center">RECIBO DE PAGO</h3>            
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div align="center">
		<table widht="100%" border="0">
		<tr><td>
        </td>
		<td align="right"><label for="cliente">Fecha</label>
        <p><?Php echo date("d/m/Y",strtotime($datos->fecha)); ?></p></td>
		</tr>
		<tr><td colspan="2"> <b>Recibi de: </b> {{$empresa->rif}}, {{$empresa->nombre}}<tr>
		<tr><td colspan="2"> <b>La Cantidad de</b>: {{$datos->monto}} $<tr>
		<tr><td colspan="2"> <b>Por Concepto de:</b> comision N° {{$datos->id_comision}}, de fecha <?Php echo date("d/m/Y",strtotime($datos->fechacomision)); ?>, por un monto de {{$datos->montocomision}} $<tr>
		<tr><td colspan="2"><b>Emitido por:</b> {{$datos->user}} </td><tr>
		<tr><td colspan="2"><b>Observacion:</b> {{$datos->observacion}} </td><tr>
		<tr><td colspan="2"></br> </td><tr>
		<tr><td colspan="2"> </td><tr>
		<tr><td colspan="2" align="center">{{$datos->cedula}}-{{$datos->nombre}}</br>Recibi de Conformidad <tr>
		<tr><td colspan="2"></br> </td><tr>
		<tr><td colspan="2" align="center"> ________________________<tr>
		</table></div>
		<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>
					 <a href="{{route('comisionxp')}}"><button  class="btn btn-danger btn-sm" type="button">Regresar</button></a>
                    </div>
                </div>
        </div>

	</div>
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('comisionxp')}}";
    });

});

</script>

@endpush
@endsection
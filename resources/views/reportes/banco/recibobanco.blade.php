@extends ('layouts.master')
<?php $mostrar=0; ?>
<?php $acum=0;$efe=0;$deb=0;$che=0;$tra=0;
$cefe=0;?>
@section('contenido')
<?php if($movimiento->tipo_mov == "TRA"){ ?> 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="row">

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	 <div class="form-group">
            			<label >{{$empresa->nombre}}</label></br>
						<label >{{$empresa->direccion}}</label></br>
            			<label >{{$empresa->rif}}</label>	
            	 </div>  
	    </div>
</div>
    <h3 align="center">RECIBO </h3>
<label ></label>
      <table width="80%" align="center" border="0">         
        <tr><td>Numero: <strong>{{$movimiento->numero }}</strong></td><td colspan="2" align="right">Fecha: <?php  echo "<strong>".$fecha=date_format(date_create($movimiento->fecha_mov),'d-m-Y h:i:s')."</strong>";?></td></tr>
        <tr><td>Egreso de</td><td colspan="2"> {{$empresa->nombre}}</td></tr>
        <tr><td>la cantidad de</td><td colspan="2"><strong><?php   echo number_format($movimiento->monto, 2,',','.'); ?></strong></td></tr>
         <tr><td>por concepto de</td><td colspan="2">{{ $movimiento->concepto }}</td></tr>
          <tr><td>Beneficiario</td><td colspan="2"><strong> {{ $movimiento->identificacion }}</strong></td></tr>

       </table>
         <table width="80%" align="center">
          <tr height="80px"><td align="center"></td><td align="center"></td></tr>
<tr height="80px"><td align="center"><strong>{{ $movimiento->user }}</strong></td><td align="center">recibi conforme</td></tr>
 </table> </div>

<?php } ?>
<?php if($movimiento->tipo_mov == "DEP"){ ?> 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="row">

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	 <div class="form-group">
            			<label >{{$empresa->nombre}}</label></br>
						<label >{{$empresa->direccion}}</label></br>
            			<label >{{$empresa->rif}}</label>	
            	 </div>  
	    </div>
</div>
    <h3 align="center">COMPROBANTE DE INGRESO BANCARIO </h3>
<label ></label>
      <table width="80%" align="center" border="0">         
        <tr><td>Numero: <strong>{{$movimiento->numero }}</strong></td><td colspan="2" align="right">Fecha: <?php  echo "<strong>".$fecha=date_format(date_create($movimiento->fecha_mov),'d-m-Y h:i:s')."</strong>";?></td></tr>
        <tr><td>He Recibido de</td><td colspan="2"> {{ $movimiento->persona }}</td></tr>
        <tr><td>la cantidad de</td><td colspan="2"><strong><?php   echo number_format($movimiento->monto, 2,',','.'); ?></strong></td></tr>
         <tr><td>por concepto de</td><td colspan="2">{{ $movimiento->concepto }}</td></tr>
          <tr><td>Beneficiario</td><td colspan="2"><strong>{{$empresa->nombre}}</strong></td></tr>

       </table>
         <table width="80%" align="center">
          <tr height="80px"><td align="center"></td><td align="center"></td></tr>
<tr height="80px"><td align="center"><strong>{{ $movimiento->user }}</strong></td><td align="center">recibi conforme</td></tr>
 </table> </div>

<?php } ?>
<?php if($movimiento->tipo_mov == "PAG"){ ?> 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="row">

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	 <div class="form-group">
            			<label >{{$empresa->nombre}}</label></br>
						<label >{{$empresa->direccion}}</label></br>
            			<label >{{$empresa->rif}}</label>	
            	 </div>  
	    </div>
</div>
    <h3 align="center">COMPROBANTE DE EGRESO </h3>
<label ></label>
      <table width="80%" align="center" border="0">         
        <tr><td>Numero: <strong>{{$movimiento->numero }}</strong></td><td colspan="2" align="right">Fecha: <?php  echo "<strong>".$fecha=date_format(date_create($movimiento->fecha_mov),'d-m-Y h:i:s')."</strong>";?></td></tr>
        <tr><td>He Recibido de</td><td colspan="2"> {{ $empresa->nombre }}</td></tr>
        <tr><td>la cantidad de</td><td colspan="2"><strong><?php   echo number_format($movimiento->monto, 2,',','.'); ?></strong></td></tr>
         <tr><td>por concepto de</td><td colspan="2">{{ $movimiento->concepto }}</td></tr>
          <tr><td>Beneficiario</td><td colspan="2"><strong> {{$movimiento->persona}}</strong></td></tr>

       </table>
         <table width="80%" align="center">
          <tr height="80px"><td align="center"></td><td align="center"></td></tr>
<tr height="80px"><td align="center"><strong>{{ $movimiento->user }}</strong></td><td align="center">recibi conforme</td></tr>
 </table> </div>

<?php } ?>
<?php if($movimiento->tipo_mov == "N/D"){ ?> 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

 <div class="row">

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	 <div class="form-group">
            			<label >{{$empresa->nombre}}</label></br>
						<label >{{$empresa->direccion}}</label></br>
            			<label >{{$empresa->rif}}</label>	
            	 </div>  
	    </div>
</div>
    <h3 align="center">COMPROBANTE DE EGRESO </h3>
<label ></label>
      <table width="80%" align="center" border="0">         
        <tr><td>Numero: <strong>{{$movimiento->numero }}</strong></td><td colspan="2" align="right">Fecha: <?php  echo "<strong>".$fecha=date_format(date_create($movimiento->fecha_mov),'d-m-Y h:i:s')."</strong>";?></td></tr>
        <tr><td>He Recibido de</td><td colspan="2">{{ $empresa->nombre }} </td></tr>
        <tr><td>la cantidad de</td><td colspan="2"><strong><?php   echo number_format($movimiento->monto, 2,',','.'); ?></strong></td></tr>
         <tr><td>por concepto de</td><td colspan="2">{{ $movimiento->concepto }}</td></tr>
          <tr><td>Beneficiario</td><td colspan="2"><strong>{{$movimiento->identificacion}}</strong></td></tr>

       </table>
         <table width="80%" align="center">
          <tr height="80px"><td align="center"></td><td align="center"></td></tr>
<tr height="80px"><td align="center"><strong>{{ $movimiento->user }}</strong></td><td align="center">recibi conforme</td></tr>
 </table> </div>

<?php } ?>
<?php if($movimiento->tipo_mov == "N/C"){ ?> 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="row">

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	 <div class="form-group">
            			<label >{{$empresa->nombre}}</label></br>
						<label >{{$empresa->direccion}}</label></br>
            			<label >{{$empresa->rif}}</label>	
            	 </div>  
	    </div>
</div>
    <h3 align="center">COMPROBANTE DE INGRESO</h3>
<label ></label>
      <table width="80%" align="center" border="0">         
        <tr><td>Numero: <strong>{{$movimiento->numero }}</strong></td><td colspan="2" align="right">Fecha: <?php  echo "<strong>".$fecha=date_format(date_create($movimiento->fecha_mov),'d-m-Y h:i:s')."</strong>";?></td></tr>
        <tr><td>He Recibido de</td><td colspan="2">{{$movimiento->identificacion}}</td></tr>
        <tr><td>la cantidad de</td><td colspan="2"><strong><?php   echo number_format($movimiento->monto, 2,',','.'); ?></strong></td></tr>
         <tr><td>por concepto de</td><td colspan="2">{{ $movimiento->concepto }}</td></tr>
          <tr><td>Beneficiario</td><td colspan="2"><strong>{{ $empresa->nombre }} </strong></td></tr>

       </table>
         <table width="80%" align="center">
          <tr height="80px"><td align="center"></td><td align="center"></td></tr>
<tr height="80px"><td align="center"><strong>{{ $movimiento->user }}</strong></td><td align="center">recibi conforme</td></tr>
 </table> </div>

<?php } ?>
     <?php if($movimiento->tipo_mov == "PPR"){ ?> 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="row">

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	 <div class="form-group">
            			<label >{{$empresa->nombre}}</label></br>
						<label >{{$empresa->direccion}}</label></br>
            			<label >{{$empresa->rif}}</label>	
            	 </div>  
	    </div>
</div>
    <h3 align="center">PREPAGO DE RUBRO</h3>
<label ></label>
      <table width="80%" align="center" border="0">         
        <tr><td>Numero: <strong>{{$movimiento->numero }}</strong></td><td colspan="2" align="right">Fecha: <?php  echo "<strong>".$fecha=date_format(date_create($movimiento->fecha_mov),'d-m-Y h:i:s')."</strong>";?></td></tr>
        <tr><td>He Recibido de</td><td colspan="2">{{ $empresa->nombre }} </td></tr>
        <tr><td>la cantidad de</td><td colspan="2"><strong><?php   echo number_format($movimiento->monto, 2,',','.'); ?></strong></td></tr>
         <tr><td>por concepto de</td><td colspan="2">{{ $movimiento->concepto }}</td></tr>
          <tr><td>Beneficiario</td><td colspan="2"><strong>CI:{{ $movimiento->cedula }}, {{$movimiento->nombre}}</strong></td></tr>
          <tr><td>kg</td><td></td><td><strong>{{$movimiento->kg}} Kg.</strong></td></tr>
       </table>
         <table width="80%" align="center">
          <tr height="80px"><td align="center"></td><td align="center"></td></tr>
<tr height="80px"><td align="center"><strong>{{ $movimiento->user }}</strong></td><td align="center">recibi conforme</td></tr>
 </table> </div>

<?php } ?>

             
                     <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>
					        <a id="enlace" href="{{route('showbanco',['id'=>$movimiento->idbanco])}}" id="regresar"><button class="btn btn-danger btn-sm  pull-left" >Regresar</button></a> 
                    </div>
                </div>
      
             

@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  document.getElementById('enlace').style.display="none";
  window.print(); 
  window.location="{{route('showbanco',['id'=>$movimiento->idbanco])}}";
    });

});

</script>

@endpush
@endsection
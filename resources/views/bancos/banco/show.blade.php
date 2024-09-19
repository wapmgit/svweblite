@extends ('layouts.master')
@section ('contenido')
<?php $mingreso=$megreso=0; $bc=0;?>
<?php
$ceros=5;
function add_ceros($numero,$ceros,$bco) {
  $numero=$numero+1;
$digitos=strlen($numero);
  $recibo=" ";
  for ($i=0;$i<8-$digitos;$i++){
    $recibo=$recibo."0";
  }
return $insertar_ceros = $bco.$recibo.$numero;
};
$idv=0;

?> 
 @foreach ($contador as $p)
              <?php  $idv=$p -> id_mov; ?> 
			  @endforeach
<div class="row">             
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" style="background-color: #E6E6E6">
<h3>MODULO DE BANCO</h3>
<table class="table table-striped table-bordered table-condensed table-hover">
  <tr style="background-color: #E6E6E6">
     <td><label>Codigo:</label> {{$banco->codigo}} <?php $bco=$banco->codigo; ?>  </td> 
    <td><label>Banco:</label> {{$banco->nombre}} </td>
    <td>  <label> N° Cuenta:</label> {{$banco->cuentaban}} </td>
    <td><label>Titular:</label> {{$banco->titular}}</td>
  </tr>

</table>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
<table class="table table-striped table-bordered table-condensed table-hover">
  <tr>
                               @foreach ($movimiento as $mov)
                               <?php 
                                 if ($mov->tipo_mov == "DEP") $mingreso=$mingreso+$mov->monto;   
                                  if ($mov->tipo_mov == "N/C") $mingreso=$mingreso+$mov->monto;   
                                 if ($mov->tipo_mov == "PAG") $megreso=$megreso+$mov->monto; 
                                  if ($mov->tipo_mov == "TRA") $megreso=$megreso+$mov->monto;
                                  if ($mov->tipo_mov == "N/D") $megreso=$megreso+$mov->monto; 
                                    if ($mov->tipo_mov == "PPR") $megreso=$megreso+$mov->monto;?>
                              @endforeach 
     <td align="center"><label>Ingresos:</label> <h4><?php echo number_format( $mingreso, 2,',','.'); ?></h4></td>
    <td align="center"><label>Egresos:</label> <h4><?php echo number_format( $megreso, 2,',','.'); ?></h4> </td>
    <td align="center">
	<form action="{{route('movimientos')}}" method="POST" enctype="multipart/form-data" >         
{{csrf_field()}}
<div class="form-group">
<input type="hidden" class="form-control" name="searchText"  value="">
  </div>
  <div class="form-group">
   <input type="hidden" class="form-control" name="searchText2" value="">
  </div>    <div class="form-group">
  <input type="hidden" name="id" value="{{$banco->idbanco}} " >
</div>
  <div class="input-group">
  
    <label><button type="submit" class="btn btn-primary"><h4><?php echo number_format( ($mingreso-$megreso), 2,',','.'); ?> </h4></button></label>
  
    </div>
</form>
	

 </td>
 
  </tr>
</table>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" >
   @include('bancos.banco.debito')
   <div class="title-card-categoria-app"><h4 align="center">NOTA DEBITO</h4></div>
      <div class="card-categoria-app" align="center">     
    @if($rol->newndbanco==1)  <a href="" data-target="#modaldebito" data-toggle="modal">
        <img  src="/img/banco/compras.png" width="80" height="80">
        <div class="footer-card-categoria-app"></div>   </a> @else		
        <img  src="/img/banco/compras.png" width="80" height="80" id="noaccesnd">
        <div class="footer-card-categoria-app"></div>@endif
        <a href="{{route('consultaban',['id'=>'DEB'.$banco->idbanco])}}"><img  src="/img/banco/lupa.png"  width="25" height="25"></a>
    </div> <!-- final de la card -->
</div>
<div class="col-lg-3 col-md-3 col-sm-6  col-xs-12" >
  @include('bancos.banco.modalcredito')
    <div class="title-card-categoria-app"><h4 align="center">NOTA CREDITO</h4></div>
      <div class="card-categoria-app" align="center">     
        @if($rol->newncbanco==1) <a href="" data-target="#modalcredito" data-toggle="modal">
        <img  src="/img/banco/compras.png" width="80" height="80">
        <div class="footer-card-categoria-app"></div>   </a>@else
			<img  src="/img/banco/compras.png" width="80" height="80" id="noaccesnc">
        <div class="footer-card-categoria-app"></div> @endif
        <a href="{{route('consultaban',['id'=>'CRE'.$banco->idbanco])}}"><img  src="/img/banco/lupa.png"  width="25" height="25"></a>
    </div> <!-- final de la card -->
</div>
<div class="col-lg-3 col-md-3 col-sm-6  col-xs-12" >
  @include('bancos.banco.modaldeposito')
    <div class="title-card-categoria-app"><h4 align="center">TRANSFERENCIA </h4></div>
      <div class="card-categoria-app" align="center">     
      @if($rol->transferenciabanco==1) <a href="" data-target="#modaldeposito" data-toggle="modal">
        <img  src="/img/banco/barra.png" width="80" height="80">
        <div class="footer-card-categoria-app"></div>   </a>@else
			<img  src="/img/banco/barra.png" width="80" height="80" id="noaccestrans">
        <div class="footer-card-categoria-app"></div>@endif
    <a href="{{route('consultaban',['id'=>'TRA'.$banco->idbanco])}}"><img  src="/img/banco/lupa.png"  width="25" height="25"></a>
    </div>  
</div>
<div class="col-lg-3 col-md-3 col-sm-6  col-xs-12" >
    <div class="title-card-categoria-app"><h4 align="center">DETALLE SALDO</h4></div>
      <div class="card-categoria-app" align="center">     
      <a href="{{route('detallebanco',['id'=>$banco->idbanco])}}">
        <img  src="/img/banco/compras.png" width="80" height="80">
        <div class="footer-card-categoria-app"></div>   </a>

    </div> <!-- final de la card -->
</div>
</div>
 <p></p><p></p>
<div class="row" style="background-color: #E6E6E6">

      @include('bancos.banco.search')

</div>
 @push ('scripts')
<script>
$(document).ready(function(){
   
    $('#c_cliente').click(function(){
$('#modalcliente').modal('hide')
    });
	$('#c_clientecre').click(function(){
$('#modalclientecre').modal('hide')
    });
	$('#btn_nd').click(function(){
		document.getElementById('btn_nd').style.display="none"; 
    });
	$('#btn_nc').click(function(){
		document.getElementById('btn_nc').style.display="none"; 
    });
	$('#cerrarnc').click(function(){
		   $("#formcredito")[0].reset();
		document.getElementById('btn_nc').style.display=""; 
    });
	$('#cerrarnd').click(function(){
		   $("#formdebito")[0].reset();
		document.getElementById('btn_nd').style.display=""; 
    });		
	$('#noaccesnd').click(function(){
	alert('Este Usuario no tiene Acceso a Notas de Debito.');
    });	
	$('#noaccesnc').click(function(){
	alert('Este Usuario no tiene Acceso a Notas de Credito.');
    });	
	$('#noaccestrans').click(function(){
	alert('Este Usuario no tiene Acceso a Transferencias.');
    });	
	$('#clientecre').on("change",function(){
		dato=document.getElementById('clientecre').value.split('_');
		var tipo= dato[3];
			if(tipo=="C"){
				document.getElementById('divncadm').style.display="";
				document.getElementById('divndp').style.display="none"; 				
			}
			if(tipo=="P"){
				document.getElementById('divncadm').style.display="none"; 
				document.getElementById('divndp').style.display=""; 
			}
				if(tipo=="V"){
				document.getElementById('divncadm').style.display="none"; 
				document.getElementById('divndp').style.display="none"; 
			}
    });	
	$('#ncliente').on("change",function(){
		dato=document.getElementById('ncliente').value.split('_');
		var tipo= dato[3];
			if(tipo=="C"){
				document.getElementById('divndadm').style.display=""; 
				document.getElementById('divncp').style.display="none"; 
			}
			if(tipo=="P"){
				document.getElementById('divndadm').style.display="none"; 
				document.getElementById('divncp').style.display=""; 
			}
			if(tipo=="V"){
				document.getElementById('divndadm').style.display="none"; 
				document.getElementById('divncp').style.display="none"; 
			}

    });
    $("#Cenviar_cli").on("click",function(){    
         var form1= $('#formulariocliente');
         var url1 = form1.attr('action');
         var data1 = form1.serialize();
	
    $.post(url1,data1,function(result){  
	    var resultado=result;
          console.log(resultado);	
        var id=resultado[0].id_persona;  
        var nombre=resultado[0].nombre;  		  
        var tp=resultado[0].rif; 	
	$("#ncliente")
	.append( '<option value="'+id+'_'+nombre+'_'+tp+'">'+tp+'-'+nombre+'</option>')
	.selectpicker('refresh');
     alert('Contacto Registrado con exito');
     $("#formulariocliente")[0].reset();
        });
  
          });  
		     $("#Cenviar_cre").on("click",function(){    
         var form1= $('#formularioclientecre');
         var url1 = form1.attr('action');
         var data1 = form1.serialize();
	
    $.post(url1,data1,function(result){  
	    var resultado=result;
          console.log(resultado);	
        var id=resultado[0].id_persona;  
        var nombre=resultado[0].nombre;  		  
        var tp=resultado[0].rif; 	
	$("#clientecre")
	.append( '<option value="'+id+'_'+nombre+'_'+tp+'">'+tp+'-'+nombre+'</option>')
	.selectpicker('refresh');
     alert('Contacto Registrado con exito');
     $("#formularioclientecre")[0].reset();
        });
  
          });  
})
	function conMayusculas(field) {
            field.value = field.value.toUpperCase()
}
</script>

@endpush
@endsection
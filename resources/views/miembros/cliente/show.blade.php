@extends ('layouts.master')
@section ('contenido')
<?php 
$ceros=5; 
function add_ceros($numero,$ceros) {
  $numero=$numero;
	$digitos=strlen($numero);
  $recibo=" ";
  for ($i=0;$i<8-$digitos;$i++){
    $recibo=$recibo."0";
  }
return $insertar_ceros = $recibo.$numero;
};
// fecha 1
$fecha_dada= "1985/08/28";
// fecha actual
$fecha_actual= date("Y/m/d");

function dias_pasados($fecha_inicial,$fecha_final)
{
$dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
$dias = abs($dias); $dias = floor($dias);
return $dias;
}
$fserver=date('Y-m-d');
 $count=0;
?>
<style type="text/css">
#capa{
	height: 500px;
	width: 100%;
	border: 1px solid #ddd;
	background: #f1f1f1;
	overflow-y: scroll;
}
</style>
  	<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                  <img src="{{asset('dist/img/iconosistema.png')}}" title="NKS">SysVent@s</img>
                    <small class="float-right"></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3 ">
			{{$empresa->nombre}}
			<address>
			<strong>{{$empresa->rif}}</strong><br>
					{{$empresa->direccion}}<br>
					Tel: {{$empresa->telefono}}<br>
			</address>
	</div>
				 	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
		<h3 align="center"><u>  Estado de Cuenta </u></h3>		
	</div>	
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 " align="center">
<img src="{{ asset('dist/img/'.$empresa->logo)}}" width="60%" height="90%" title="NKS">
	</div>
              </div>
<div class="row"><?php $acummonto=0; ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table width="100%"border="1"><tr><td width="30%"><strong>Rif -> Cliente</strong></td><td width="20%"><strong>Telefono</strong></td><td width="30%"><strong>Direccion</strong></td><td width="20%"><strong>Vendedor</strong></td>
			</tr>
			<tr><td>{{$cliente->cedula}} -> {{$cliente->nombre}}</td><td>{{$cliente->telefono}}</td><td>{{$cliente->direccion}}</td><td> </td>
			</tr>
			</table></br>
		</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="divbotones" align="right">
                 <div class="form-group">
                    <a href="" data-target="#modalrecibos-{{$cliente->id_cliente}}" data-toggle="modal"><button class="btn btn-success btn-xs">Registrar Pago</button></a>
					</div>
			</div>

	<!-- @include('clientes.cliente.modalcredito') -->

@include('miembros.cliente.modalrecibos')
</div>



		<div class="row">	
	<div id="capac">
			   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive" >
			<table width="100%">
				<thead>
				<th class="filap1"></th>
					<th>Recibo</th>
					<th>Moneda</th>
					<th>Recibido</th>
					<th>Fecha</th>
					<th>Monto</th>
					<th>Referencia</th>					
				</thead>
				<?php $vendido=0; $acum=0; $link=2; $saldo=$saldond=$saldonc=0; $cont=$contnd=$contnc=0; ?>
               @foreach ($pagos as $cat) 
			   <?php    $saldo=$saldo+$cat->monto; 
			   $cont++; 
			   ?>
				<tr>
				<td class="filap1"> </td>
					<td>             
					<?php $idv=$cat->idrecibo; echo add_ceros($idv,$ceros); ?>
					</td>
					<td>{{ $cat->idbanco}}</td>
					<td>{{ $cat->recibido}}</td>
					
					<td><small><?php echo date("d-m-Y",strtotime($cat->fecha)); ?></small></td>		
					<td>{{ $cat->monto}}</td>					
					<td>{{ $cat->referencia}}</td>			
				</tr>
				@endforeach
				<tr><td  class="filap1"></td>
				<td colspan="4"></td>
				<td><strong>Facturado: <?php echo $saldo; ?> $.</strong></td><td></td>
				<td><strong></td></tr>
			</table>
			
		</div>
		</div>
	     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></br>
                    <div class="form-group" align="center">
					<button type="button" id="regresar" class="btn btn-danger btn-sm" data-dismiss="modal">Regresar</button>
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>

                    </div>
                </div> 
	</div>
 

			<form action="{{route('clientes')}}" method="POST" id="formulariodetalle" enctype="multipart/form-data" >  
			 {{csrf_field()}}
    <input type="hidden" name="comprobante" id="pidcomprobante" value="0">
	 <input type="hidden" name="tipo" id="pidtipo" value="0">
	 </form>
     

	<div id="capaprint" style="display:none">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<table width="100%">
				<thead>
				<th class="filap1"></th>
					<th>Recibo</th>
					<th>Moneda</th>
					<th>Recibido</th>
					<th>Fecha</th>
					<th>Monto</th>
					<th>Fecha</th>
					<th>Referencia</th>					
				</thead>
				<?php $vendido=0; $acum=0; $link=2; $saldo=$saldond=$saldonc=0; $cont=$contnd=$contnc=0; ?>
               @foreach ($pagos as $cat) 
			   <?php    $saldo=$saldo+$cat->monto; 
			   $cont++; 
			   ?>
				<tr>
				<td class="filap1"> </td>
					<td>             
					<?php $idv=$cat->idrecibo; echo add_ceros($idv,$ceros); ?>
					</td>
					<td>{{ $cat->idbanco}}</td>
					<td>{{ $cat->recibido}}</td>
					<td>{{ $cat->monto}}</td>
					<td><small><?php echo date("d-m-Y",strtotime($cat->fecha)); ?></small></td>								
					<td>{{ $cat->referencia}}</td>			
				</tr>
				@endforeach
				<tr><td class="filap1"></td><td colspan="5"><strong>Facturas:</strong></td><td><strong>Facturado: <?php echo$vendido; ?> $.</strong></td><td colspan="2"></td><td><strong><?php echo (($saldo+$saldond)-$saldonc); ?> $.</strong></td></tr>
			</table>
			
		</div>

	</div>
</div>
</div>
@push ('scripts')
<script>
$(document).ready(function(){

    $('#ing').DataTable();	

    $('#imprimir').click(function(){
		$(".filap1").remove();
  //  alert ('si');
  document.getElementById('divbotones').style.display="none";
  document.getElementById('capac').style.display="none";
  document.getElementById('capaprint').style.display="";
  document.getElementById('imprimir').style.display="none";
  document.getElementById('regresar').style.display="none";
  window.print(); 
  window.location.href="/edomienbro/{{$cliente->id_cliente}}";
    });
$('#regresar').on("click",function(){
  window.location="{{route('membresia')}}";
  
});
$('#btndedito').on("click",function(){
  document.getElementById('btndedito').style.display="none"; 
});
$('#btncredito').on("click",function(){
  document.getElementById('btncredito').style.display="none"; 
});
$('#btn-cerrar').on("click",function(){
$(".otrafila").remove();
});
$('#btn-cerrarnc').on("click",function(){
$(".filadelete").remove();
});
$('#btn-close').on("click",function(){
$(".otrafila").remove();
});
		document.getElementById('bt_pago').style.display="none";
		document.getElementById('procesa').style.display="none";
	$('#pasapago').click(function(){
			datosbanco=$("#pidpago").val();
			if(datosbanco==100){
			alert('¡Debe seleccionar un tipo de Pago!');}
			else{ $("#pmonto").val($("#resta").val());
			document.getElementById('bt_pago').style.display=""; 
			$("#preferencia").focus();}
		})
	$('#bt_pago').click(function(){
			agregarpago();
			});  
	$("#pidpago").change(mediopago);
			$('#regresarp').click(function(){	
			document.getElementById('procesa').style.display="none";
			pagototal=0;	 $("#resta").val($("#total_venta").val());
			$("#total_abono").text("0.0");
			$("#tdeuda").val($("#total_venta").val());
			$("#total").val(0);
			$("#totala").val(0);
			
			
				for(var i=0;i<10;i++){
				$("#filapago" + i).remove(); acumpago[i]=0; }
		})
			$('#procesa').click(function(){   
			document.getElementById('loading').style.display=""; 
			document.getElementById('procesa').style.display="none"; 
			document.getElementById('regresarp').style.display="none"; 
			document.getElementById('formulario').submit(); 
		})
});
// calculo pago
	function mediopago(){
	    document.getElementById('bt_pago').style.display="";		
	   var pesoresta =$("#resta").val();  
       var pesototal =$("#divtotal").val();
	   var tabono=$("#totala").val();
	   var debe=(pesototal-tabono);
	     moneda= $("#pidpago").val();
		 tm=moneda.split('_');
		  tipom=tm[1];
		  valort=tm[2];
		   //alert(tipom);
		   	if (tipom==0){   
				$("#resta").val((pesototal-tabono).toFixed(2));  
				}  
			if (tipom==1){ 
				$("#resta").val((debe*valort).toFixed(2)); 
				$("#preferencia").val('Tc: '+valort);  				
			}
			if (tipom==2){   
				$("#resta").val((debe/valort).toFixed(2));  
				$("#preferencia").val('Tc: '+valort);  
				}  				
		t_pago=$("#pidpago").val();
    }
	acumpago=[];var contp=0; var tresta=0; var pagototal=0;
	function agregarpago(){ 	
        vresta=$("#resta").val();    
		idpago=$("#pidpago").val();
        tpago= $("#pidpago option:selected").text();
        pmonto= $("#pmonto").val();
        pref= $("#preferencia").val();
		    fecha= $("#fecha_emi").val();
		
			moneda= $("#pidpago").val();
		 tm=moneda.split('_');
		  tipom=tm[1];
		  valort=tm[2];
		  	idpago=tm[0];
 
		if(parseFloat(pmonto)<=parseFloat(vresta)){
			
		var denomina=pmonto;
			acumpago[contp]=(pmonto);
			if (tipom==1){ 
			    var pesoresta =$("#resta").val();   
					$("#total_abono").text(pagototal/valort);
				    denomina=parseFloat(pmonto).toFixed(2);
					pmonto=(parseFloat(pmonto)/parseFloat(valort));		
					acumpago[contp]=(pmonto.toFixed(2)); 
			}  
				if (tipom==2){ 
			    var pesoresta =$("#resta").val();   
				$("#resta").val(pesoresta*valort);  
				$("#total_abono").text(pagototal*valort);
				    denomina=parseFloat(pmonto).toFixed(2);
					pmonto=(parseFloat(pmonto)*parseFloat(valort));		
					acumpago[contp]=(pmonto.toFixed(2)); 
			} 
        pagototal=parseFloat(pagototal)+parseFloat(acumpago[contp]); 
		//salert(pagototal);
        tventa=$("#divtotal").val();
        tresta=(parseFloat(tventa)-parseFloat(pagototal));
            $("#resta").val(tresta.toFixed(2));
            $("#tdeuda").val(tresta.toFixed(2));	
            var fila='<tr  id="filapago'+contp+'"><td align="center"><span onclick="eliminarpago('+contp+');"><i class="fa fa-fw fa-eraser"></i></span></td><td><input type="hidden" name="tidpago[]" value="'+idpago+'"><input type="hidden" name="tidbanco[]" value="'+tpago+'">'+tpago+'</td><td><input type="hidden" name="denominacion[]" value="'+denomina+'">'+denomina+'</td><td><input type="hidden" name="tmonto[]" value="'+pmonto+'">'+pmonto.toLocaleString('de-DE', { style: 'decimal',  decimal: '2' })+'</td><td><input type="hidden" name="tref[]" value="'+pref+'">'+pref+'</td><td><input type="hidden" name="fecha[]" value="'+fecha+'">'+fecha+'</td></tr>';
            contp++;
            document.getElementById('bt_pago').style.display="none";
			document.getElementById('procesa').style.display="";
			$("#pidpago").val('100');
			$("#total_abono").text(pagototal.toFixed(2));
			$("#totala").val(pagototal.toFixed(2));
			limpiarpago();		 
             $('#det_pago').append(fila);
			
		}else{ alert('¡El monto indicado no debe se mayor al saldo pendiente!');
		limpiarpago();		}
	}
	function limpiarpago(){
        $("#pmonto").val("");
        $("#preferencia").val("");
    }
	function eliminarpago(index){
		$("#pidpago").val('100');
        total=acumpago[index];
		tventa=$("#divtotal").val();
        var1=$("#total_abono").text();
		resta=parseFloat(tventa)-parseFloat(var1);
		//alert(var1);
        nv=(parseFloat(resta)+parseFloat(total));
        nc=(parseFloat(var1)-parseFloat(total));
        $("#resta").val(nv.toFixed(2));   
        $("#tdeuda").val(nv.toFixed(2));  
        $("#totala").val(nc.toFixed(2));
		pagototal=(parseFloat(pagototal)-parseFloat(total));
        $("#filapago" + index).remove();
        $("#total_abono").text(nc.toFixed(2));
			limpiarpago();
			
			if(nc==0){
			document.getElementById('procesa').style.display="none";	
			}
    }
</script>
@endpush
@endsection
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
$acum=0; $acum2=0; $acumn=0; $count=0; $contdoc=0; $link=1; $p=1;?>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Detalles de Cuentas por Pagar</h3>
	</div>
</div>
	
<div class="row">
	 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Nombre</label>
                   <p>{{$proveedor->nombre}}</p>
                    </div>
            </div>
            	 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Cedula</label>
                   <p>{{$proveedor->rif}}</p>
                    </div>
            </div>
            	 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Telefono</label>
                   <p>{{$proveedor->telefono}}</p>
                    </div>
            </div>
				@include('proveedores.pagar.modalmonedas')
			 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                 <div class="form-group" align="center">
				<a href="#" data-target="#modalm" data-toggle="modal"><button  class="btn btn-warning btn-sm">Act. Tasas </button></a></td>

                    </div>
            </div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color: #A9D0F5">
					<th>Tipo Documento</th>
					<th>N° Comprobante</th>
					<th>Fecha</th>
					<th>Monto</th>
					<th>Por Pagar</th>
					<th>Abonar</th>
					
				
				</thead>
               @foreach ($datos as $cat)
               <?php 
               $acum=$cat->saldo+$acum; 
               $acum2=$cat->total+$acum2; 
			   $acumn=$acumn+$cat->saldo;
               ?>
				<tr>
					<td>{{$cat->tipo_comprobante}}->{{$cat->num_comprobante}}</td>
					<td>{{ $cat->serie_comprobante}}</td>
					<td><?php echo date("d-m-Y",strtotime($cat->fecha_hora)); ?></td>
					<td><?php echo number_format($cat->total, 2,',','.')." $"; ?></td>
					<td><?php echo number_format($cat->saldo, 2,',','.')." $"; ?></td>			
					<td><a href="javascript:abrirespecial({{$cat->idingreso}},{{$cat->saldo}});"><button  id="abono" class="btn btn-info btn-xs">Abono</button></a>   
					<a href="{{route('showdetallecompra',['id'=>$cat->idingreso])}}"><button class="btn btn-success btn-xs">Detalle</button></a></td>
				</tr>
									
				@endforeach
				
				@include('proveedores.pagar.modal')
				<tr>
				<td><strong>TOTAL:</strong></td>
					<td></td>
					<td></td>
					<td style="background-color: #A9D0F5">
				<?php echo number_format( $acum2, 2,',','.')." $"; ?></td>
			
				<td style="background-color: #A9D0F5">
				<?php echo number_format( $acum, 2,',','.')." $"; ?></td><td>	
				FAC:<a href="#" data-target="#modal" data-toggle="modal"title="Pago total de Facturas">
				<?php echo number_format(($acumn), 2,',','.'); ?> </a></td>
				</tr>
			</table>
		</div>
		{{$datos->render()}}
	</div>
	         <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
					 <button type="button" id="regresarpg" class="btn btn-danger btn-sm" data-dismiss="modal">Regresar</button>
					 	<a  href="{{route('historico',['id'=>$proveedor->idproveedor])}}"><button class="btn btn-success btn-sm">Edo. Cta.</button></a>
                    </div>
                </div> 
</div>
<form action="{{route('abonarcxp')}}" id="formulariocxp" method="POST" enctype="multipart/form-data" >  
     <div class ="row" id="divdesglose" style="display: none">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<input type="hidden" value="{{$empresa->tc}}" id="valortasa" name="tc" class="form-control">
			<input type="hidden" value="{{$empresa->peso}}" id="valortasap" name="peso" class="form-control">
			<input type="hidden" value="" id="total_venta" name="total_venta" class="form-control">
			<input type="hidden" value="" id="venta" name="venta" class="form-control">
			<input type="hidden" value="" id="tipop" name="tipop" class="form-control">
			<input type="hidden" value="" id="tipodoc" name="tipodoc" class="form-control">
			<input type="hidden" name="idp" value="{{$proveedor->idproveedor}}" class="form-control">				
			   <h3  align="center">TOTAL <input type="number" id="divtotal" value="" disabled ><span id="pasapago" title="haz click para hacer cobro total">RESTA</span> <input type="number" id="resta" disabled value="">
						<input type="hidden" name="tdeuda" id="tdeuda" value="0" class="form-control"> 
						</h3>
		</div>					 
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
						<select name="pidpago" id="pidpago" class="form-control">
							<option value="100" selected="selected">Selecione...</option>
						@foreach ($monedas as $m)<?php $count++;?>
							<option id=vm<?php echo $count; ?> value="{{$m-> idmoneda}}_{{$m->tipo}}_{{$m->valor}}">{{$m -> nombre}}</option>
						@endforeach
						</select>
						</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
						<input type="number" class="form-control" name="pmonto" id="pmonto" placeholder=""  min="1" step="0.01">
						</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
						<input type="text" name="preferencia" class="form-control" id="preferencia" onchange="conMayusculas(this);" placeholder="Referencia...">
						</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
						<button type="button" id="bt_pago" class="form-control" > <i class="fa fa-fw fa-plus-square"></i> </button>
						</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<table id="det_pago" class="table table-striped table-bordered table-condensed table-hover">
                      <thead style="background-color: #54b279">
                          <th>Supr</th>
                          <th width="15%">Tipo</th>
						   <th width="15%">Monto</th>
                          <th>Monto $</th>
                          <th>Referencia</th>

                      </thead>
                      <tfoot> 
                      <th></th>
                          <th></th>
						   <th></th>
                          <th><h3>Total $</h3></th>
                          <th><h3 id="total_abono">$.  0.00</h3></th><input type="hidden" name="totala" id="totala" value="0.00">
                          </tfoot>
                      <tbody></tbody>
                    </table>
	
		</div>
						
		<div class="modal-footer">
						<div class="col-lg-12 ol-md-12 col-sm-12 col-xs-12"  align="right">
						<button type="button" class="btn btn-danger" id="regresar" data-dismiss="modal">Cancelar</button>
						<input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
						<button type="button" id="procesa" class="btn btn-primary">Procesar</button>
						   <div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
					  
						</div>
		</div>
	</div>
	</form>
		<form action="{{route('abonarncp')}}"  method="POST" id="formulario2" enctype="multipart/form-data" > 
	<div class ="row" id="divnc" style="display: none">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h6 id="divtotal" style="display: none" class="modal-title" align="center">BsF.</h6>
                    <h3 align="center">APLICAR NOTA DE CREDITO</h3>				
		</div>

						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group"><label>Monto Nota de Credito</label>
						<input type="number" id="total_nc" class="form-control" id="total_nc" value="" disabled >
						</div>
						</div>							
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group"><label>Monto Documento</label>
						<input type="number" id="total_doc" class="form-control" value="" disabled >
						</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group"><label>Abonar </label>
						<input type="number" id="total_abn" name="total_abn" class="form-control" min="0.01" step="0.01" value="">
						</div>
						</div>		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group"><label>Referencia</label>
						<input type="text" id="ref" name="ref" class="form-control" value="" >
						<input type="hidden" id="iddoc" name="iddoc" class="form-control" value="" >
						<input type="hidden" id="tipo" name="tipo" class="form-control" value="" >
						<input type="hidden"  name="idcliente" class="form-control" value="{{$proveedor->idproveedor}}" >
						</div>
						</div>
	
       <div class="modal-footer">
        <div class="col-lg-12 ol-md-12 col-sm-12 col-xs-12" align="right">
        <button type="button" class="btn btn-danger btn-sm" id="cerrardivnc" data-dismiss="modal">Cancelar</button>
        <input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
        <button type="submit" id="procesac" class="btn btn-primary btn-sm" style="display: none">Procesar</button>
		<div style="display: none" id="loading2">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
      
        </div>
      </div>
	</div>
	</form>
@endsection

@push ('scripts')

<script>
$(document).ready(function(){
	
	 document.getElementById('bt_pago').style.display="none";
		$('#pasapago').click(function(){
			datosbanco=$("#pidpago").val();
			if(datosbanco==100){
			alert('¡Debe seleccionar un tipo de Pago!');}
			else{ $("#pmonto").val($("#resta").val());
			document.getElementById('bt_pago').style.display=""; 
			$("#preferencia").focus();}
		})
		$("#pidpago").change(mediopago);
		$('#bt_pago').click(function(){
	    agregarpago();
		});   
		$('#regresar').click(function(){	
			pagototal=0;	 $("#resta").val($("#total_venta").val());
			$("#total_abono").text("0.0");
			$("#tdeuda").val($("#total_venta").val());
			$("#total").val(0);
			$("#totala").val(0);
			$('#divdesglose').fadeOut("fast");
			$('#divarticulos').fadeIn("fast");
			for(var i=0;i<10;i++){
			$("#filapago" + i).remove(); acumpago[i]=0; }
		})
		$('#cerrardivnc').on("click",function(){
			document.getElementById('divnc').style.display="none"; 
			$("#total_abn").val(0);
			$("#ref").val("");
			$("#pidpago").val('10');
		})
		$('#regresarpg').on("click",function(){
			window.location="{{route('cxp')}}";
		});
			$('#sendretf').on("click",function(){
				document.getElementById('sendretf').style.display="none"; 
		});
					$('#sendretg').on("click",function(){
				document.getElementById('sendretg').style.display="none"; 
		});
		
		$('#procesa').click(function(){   
			document.getElementById('loading').style.display=""; 
			document.getElementById('procesa').style.display="none"; 
			document.getElementById('regresar').style.display="none"; 
			document.getElementById('formulariocxp').submit(); 
		})
			$('#ntbs').on("change",function(){
			var nva=$("#ntbs").val();
			$("#valortasa").val(nva);
			})
			$('#ntps').on("change",function(){
			var nvap=$("#ntps").val();
			$("#valortasap").val(nvap);
			});
			$('#idretenc').on("change",function(){		
		var iva=$("#miva").val();
		var base= $("#mbase").val();
		retencion= $("#idretenc").val();
		tm=retencion.split('_');
		  prete=tm[1];
		  apiva=tm[2];
		  if(apiva==1){ tret=(iva*(prete/100));
		 $("#mret").val(tret);
		 $("#mretd").val(tret/$("#tasafac").val());
		 }else{ 
			tret=(base*(prete/100));
			$("#mret").val(tret);
			$("#mretd").val(tret/$("#tasafac").val());
		 }
		 			document.getElementById('sendretf').style.display=""; 
			});
			$('#idretencg').on("change",function(){		
		var iva=$("#mivag").val();
		var base= $("#mbaseg").val();
		retencion= $("#idretencg").val();
		tm=retencion.split('_');
		  prete=tm[1];
		  apiva=tm[2];
		  if(apiva==1){ tret=(iva*(prete/100));
		 $("#mretg").val(tret);
		 $("#mretdg").val(tret/$("#tasafacg").val());
		 }else{ 
			tret=(base*(prete/100));
			$("#mretg").val(tret);
			$("#mretdg").val(tret/$("#tasafacg").val());
		 }
		 	document.getElementById('sendretg').style.display=""; 
			});
});
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
				//$("#resta").val(pesototal-tabono);  
				}  
			if (tipom==1){ 
				$("#resta").val((debe*valort).toFixed(2)); 
				//$("#resta").val(debe*valort); 
				$("#preferencia").val('Tc: '+valort);  				
			}
			if (tipom==2){   
				$("#resta").val((debe/valort).toFixed(2)); 
				//$("#resta").val(debe/valort);  
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
				    denomina=pmonto;
					pmonto=pmonto/valort;		
					acumpago[contp]=(pmonto.toFixed(2)); 
			}  
				if (tipom==2){ 
			    var pesoresta =$("#resta").val();   
				$("#resta").val(pesoresta*valort);  
				$("#total_abono").text(pagototal*valort);
				    denomina=pmonto;
					pmonto=pmonto*valort;		
					acumpago[contp]=(pmonto.toFixed(2)); 
			}      	    
			pagototal=parseFloat(pagototal)+parseFloat(acumpago[contp]); 	
			tventa=$("#divtotal").val();
			tresta=(parseFloat(tventa)-parseFloat(pagototal));
            $("#resta").val(tresta.toFixed(2));
            $("#tdeuda").val(tresta.toFixed(2));	
            var fila='<tr  id="filapago'+contp+'"><td align="center"><span onclick="eliminarpago('+contp+');"><i class="fa fa-fw fa-eraser"></i></span></td><td><input type="hidden" name="tidpago[]" value="'+idpago+'"><input type="hidden" name="tidbanco[]" value="'+tpago+'">'+tpago+'</td><td><input type="hidden" name="denominacion[]" value="'+denomina+'">'+denomina+'</td><td><input type="hidden" name="tmonto[]" value="'+pmonto+'">'+pmonto.toLocaleString('de-DE', { style: 'decimal',  decimal: '2' })+'</td><td><input type="hidden" name="tref[]" value="'+pref+'">'+pref+'</td></tr>';
            contp++;
            document.getElementById('bt_pago').style.display="none";
			$("#pidpago").val('100');
			$("#pmonto").attr('placeholder','Esperando Seleccion');
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
        //resta=$("#resta").val();
        var1=$("#total_abono").text();
			resta=parseFloat(tventa)-parseFloat(var1);
        nv=(parseFloat(resta)+parseFloat(total));
        nc=(parseFloat(var1)-parseFloat(total));
		$("#resta").val(nv.toFixed(2));   
        $("#tdeuda").val(nv.toFixed(2));  
        $("#totala").val(nc.toFixed(2));
        pagototal=(parseFloat(pagototal)-parseFloat(total));
        $("#filapago" + index).remove();
        $("#total_abono").text(nc.toFixed(2));
		limpiarpago();	
    }
	function abrirespecial(idventa,saldo){  
      $('#divdesglose').fadeIn("fast");
      $("#divtotal").val(saldo);
      $("#auxtotal").val(saldo);
	   $("#tipop").val(0);
	   $("#tipodoc").val(1);
	  $("#resta").val(saldo);
      $("#venta").val(idventa); 
	  $("#total_venta").val(saldo); 
	 $("#pidpago").val('100');
}
function abrirespecial2(idventa,saldo){  

		$('#divnc').fadeOut("fast");
      $('#divdesglose').fadeIn("fast");
      $("#divtotal").val(saldo);
      $("#resta").val(saldo);
	    $("#tipop").val(2);
	   $("#tipodoc").val(2);
      $("#venta").val(idventa); 
	  $("#total_venta").val(saldo); 
	  $("#pidpago").val('100');
	}
	function abrirespecialg(idventa,saldo){  
      $('#divdesglose').fadeIn("fast");
      $("#divtotal").val(saldo);
      $("#tipop").val(1);
      $("#auxtotal").val(saldo);
	  $("#resta").val(saldo);
      $("#venta").val(idventa); 
	  $("#total_venta").val(saldo); 
	$("#pidpago").val('100');
}
function abrirdivnc(tipo,iddoc,pendiente,mnc){
	//alert(mnc);
	if (mnc>0){
	$('#divdesglose').fadeOut("fast");
	var auxmnc=mnc.toFixed(2); var auxpen=pendiente;
	$("#iddoc").val(iddoc);
	$("#tipo").val(tipo);
	$("#total_nc").val(auxmnc);
	$("#total_doc").val(pendiente);	
	if(parseFloat(auxmnc)>parseFloat(auxpen)){ 
	$("#total_abn").attr('max',auxpen);
	$("#total_abn").val(auxpen);
	 } else { 	
	 $("#total_abn").attr('max',auxmnc);
	$("#total_abn").val(auxmnc); }
      $('#divnc').fadeIn("fast");
	  document.getElementById('procesac').style.display="";
	if(tipo=="FAC"){
		document.getElementById('cflnc').style.display=""; 
	}
}
}
	function actmonedas(aux,id,t){
	var dato=$("#vm"+aux).val();
var nv=$("#valor"+aux).val();
var ndato=id+'_'+t+'_'+nv;	
$("#vm"+aux).val(ndato);
}
</script>
@endpush
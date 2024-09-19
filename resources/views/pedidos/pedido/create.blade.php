@extends ('layouts.master')
@section ('contenido')
<?php
$fserver=date('Y-m-d');
$nivel=Auth::user()->nivel;
$fecha_a=$empresa->fechavence;
function dias_transcurridos($fecha_a,$fserver)
{
$dias = (strtotime($fecha_a)-strtotime($fserver))/86400;
//$dias = abs($dias); $dias = floor($dias);
return $dias;
}
$vencida=0;
if (dias_transcurridos($fecha_a,$fserver) < 0){
  $vencida=1;
  echo "<div class='alert alert-danger'>
      <H2>LICENCIA DE USO DE SOFTWARE VENCIDA!!!</H2> contacte su Tecnico de soporte.
      </div>";
};
$ceros=5;
function add_ceros($numero,$ceros) {
  $numero=$numero+1;
$digitos=strlen($numero);
  $recibo=" ";
  for ($i=0;$i<8-$digitos;$i++){
    $recibo=$recibo."0";
  }
return $insertar_ceros = $recibo.$numero;
};
$idv=0;

?>     @foreach ($contador as $p)
              <?php  $idv=$p -> idpedido; ?>
              <option style="display: none">{{$p -> idpedido}} </option> 
          @endforeach
		
	<div class="row" style="background-color:#f3f4f4"> 
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<h3>Nuevo Pedido</h3>

			<button type="button" > <a id="calculo" href="" data-target="#modal_tasas" data-toggle="modal"> Referencia Monetaria </a></button>
			@include('pedidos.pedido.modal_tasas')
			@include('pedidos.pedido.modalcliente')
			<input type="hidden" value="{{$empresa->tc}}" id="valortasa" name="tc"></input>
		  <input type="hidden" value="{{$empresa->peso}}" id="valortasap" name="peso"></input>
        </div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<h4 id="nombrevendedor"></h4>
							    <div class="form-group">
            			             <label for="tipo_precio">Vendedor </label><br>
            			<select name="vpedido" id="vpedido" class="form-control">
            				@foreach ($vendedores as $cat)
            				<option value="{{$cat->id_vendedor}}_{{$cat->comision}}">{{$cat->nombre}}</option>
            				@endforeach
            			</select>
            			
            		</div>
		</div>
		
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
		<div class="small-box bg-green">
		<div class="inner">
           <h1 id="muestramonto" align="center"><sup style="font-size: 25px"><?php ?>$   0.00</sup></h1>
            </div>
             
            </div>
		</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
		<div class="small-box bg-blue">
		<div class="inner">
           <h1 id="muestramontobs" align="center"><sup style="font-size: 25px"><?php ?>Bs   0.00</sup></h1>
            </div>
             
            </div>
		</div>
    </div>
	<form action="{{route('guardarpedido')}}" method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
            <div class="row" style="background-color:#edefef">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
						<input type="hidden" value="{{$empresa->tc}}" id="valortasa" name="tc" class="form-control">
						 <input type="hidden" value="" id="nvendedor" name="nvendedor" class="form-control">
						<input type="hidden" value="{{$empresa->peso}}" id="valortasap" name="peso" class="form-control">
                    	<label for="cliente">Cliente <a href="" data-target="#modalcliente" data-toggle="modal"><span class="label label-success"> <i class="fa fa-fw  fa-user "> </i></span></a></label>
                    	<select name="id_cliente" id="id_cliente" class="form-control selectpicker" data-live-search="true">						
                           @foreach ($personas as $per)
                           <option value="{{$per -> id_cliente}}_{{$per -> tipo_precio}}_{{$per -> comision}}_{{$per -> nombrev}}_{{$per -> tipo_cliente}}">{{$per -> cedula}}-{{$per -> nombre}}</option> 
                           @endforeach
                        </select>
						<input type="hidden" value="" id="tipocli" name="tipocli">
                    </div>
                </div>
                
				<div  class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<table><tr><td>	<div class="form-group">
					<label for="serie_comprobante">Fecha Emision</label>
						<input type="date" name="fecha_emi" <?php if ($nivel=="L"){?> readonly <?php }  ?>  id="fecha_emi" value="<?php echo $fserver;?>" class="form-control control-sm">
						<input type="hidden" name="tipo_comprobante" class="form-control" value="PED">
					</div></td><td><div class="form-group">
						<label for="serie_comprobante">Serie</label>
						<input type="text" style="background-color:#edefef" name="serie_comprobante" value="A" size="5" class="form-control"placeholder="serie del comprobante" > 
					</div>	</td><td>	<div class="form-group">
						<label for="num_comprobante">Numero</label>
					 <input type="text" name="num_comprobante" style="background-color:#edefef"value="<?php echo add_ceros($idv,$ceros); ?>" class="form-control" placeholder="numero del comprobante" > 
					</div></td><td><div class="form-group">
						<label for="comision">Comision</label>
					 <input type="number" name="comision" style="background-color:#edefef" id="comision"  value="" class="form-control" placeholder="%" >
					</div></td></tr></table>
				
			
			</div>	
            </div>
            <div class ="row" id="divarticulos" style="display: true">
 
                    
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                             <label>Articulos </label></br>
                             <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true" >
                              <option value="5000" selected="selected">Seleccione..</option>
                             @foreach ($articulos as $articulo)
                              <option value="{{$articulo -> idarticulo}}_{{$articulo -> stock}}_{{$articulo -> precio_promedio}}_{{$articulo -> precio2}}_{{$articulo -> costo}}">{{$articulo -> articulo}}</option>
                             @endforeach
                              </select>
                        </div>
					</div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="pcantidad" id="pcantidad" min="0.001" class ="form-control" placeholder="Cantidad">
                    </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text"  name="pstock" id="pstock"  class ="form-control" disabled placeholder="Stock">
                    </div>
                    </div>

                      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="form-group">
                        <label for="precio_venta">Precio venta</label>
                        <input type="number" name="pprecio_venta" id="pprecio_venta"  class ="form-control" placeholder="Precio de Venta" <?php if ($nivel=="L"){?> disabled <?php }  ?> >
                    </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="form-group">
                        <label for="descuento">Descuento</label>
                        <input type="number" value="0" name="pdescuento" id="pdescuento" class ="form-control" placeholder="Descuento" min="0">
                        <input type="hidden" value="0" name="pcostoarticulo" id="pcostoarticulo"  class ="form-control" >
                    </div>
                    </div>

                       <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="form-group">
						<label>&nbsp;</label>		
						@if($rol->crearpedido==1)
					 	<button type="button" onmouseover="this.style.color='blue';" onmouseout="this.style.color='grey';"  id="bt_add" class="form-control" <?php if($vencida==1){?>style="display: none"<?php }?> > <i tabindex="1" class="fa fa-fw fa-plus-square"></i> </button>
						@endif
				   </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="table-responsive">
                  <table id="detalles" width="100%">
                      <thead style="background-color: #A9D0F5">
                          <th>Supr</th>
                          <th>Articulo</th>
                          <th>Cantidad</th>
                          <th>Precio Venta</th>
                           <th>Descuento</th>
                          <th>SubTotal</th>
						
                      </thead>
                      <tfoot style="background-color: #A9D0F5"> 
                      <th>Total</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th><h4 id="total">$.  0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
						 
                          </tfoot>
                      <tbody></tbody>
                  </table>
				  </div>
                    </div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="botones"  align="right">
						  <div class="form-group"></br>
								<button class="btn btn-primary" id="guardar" type="submit" accesskey="l">Gua<u>r</u>dar</button>
								<button class="btn btn-danger" type="button"  id="btncancelar">Cancelar</button>
								<div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
							</div>
						</div>
                </div>
                   
					</form>	  
@push ('scripts')
<script>
$(document).ready(function(){
		dato=document.getElementById('vpedido').value.split('_');
      var comi= dato[1];
      $("#comision").val(comi);
	  $("#nvendedor").val(dato[0]);
	  
	$('[data-mask]').inputmask();
	document.getElementById('pcantidad').addEventListener('keypress',function(e){ validar(e); });	
	document.getElementById('pprecio_venta').addEventListener('keypress',function(e){ validarno(e); });	
	document.getElementById('pdescuento').addEventListener('keypress',function(e){ validarno(e); });	
	//document.getElementById('bt_add').tabIndex="1";
	//oncontextmenu=new Function("return false");
	var count =document.getElementById('id_cliente').options.length;
	if(count ==1 ){
		dato=document.getElementById('id_cliente').value.split('_');
		var comi= dato[2];
		var vendedor= dato[3];
		$("#tipocli").val(dato[4]);
		$("#comision").val(comi);
		$("#nvendedor").html("<strong>Vendedor:</strong> "+ vendedor);
				if ($("#tipocli").val()==1){		
		document.getElementById('procesa').style.display="none"; } 
	}else{
		$("#id_cliente")
	.append( '<option value="0" selected>Seleccione...</option>')
	.selectpicker('refresh');
	}
	
    $('#bt_add').click(function(){
		if($("#id_cliente").val()==0){
			  toastr.error('¡Debe seleccionar un cliente para el Documento!.');
		}else{
			agregar();
		} 
	});
	$("#vpedido").change(function(){
		dato=document.getElementById('vpedido').value.split('_');
      var comi= dato[1];
      $("#comision").val(comi);
	  $("#nvendedor").val(dato[0]);
	});

	$('#closemodal').click(function(){		
	 $("#formulariocliente")[0].reset();
	});

    $('#guardar').click(function(){
		document.getElementById('btncancelar').style.display="none"; 
		document.getElementById('guardar').style.display="none"; 
		document.getElementById('loading').style.display=""; 
    })
	$('#calculo').click(function(){
		var tventa=$("#total_venta").val(); 	//alert(tventa);
			auxtventa=parseFloat(tventa.replace(/,/g, ""))
                    .toFixed(2);
                   // .toString()
                    //.replace(/\B(?=(\d{3})+(?!\d))/g, ",");	
					//alert(auxtventa); 
					//alert(auxtventa);
		var mon_tasa=($("#valortasa").val()*auxtventa);
		var mon_tasap=($("#valortasap").val()*auxtventa);
		$("#dvb").html(auxtventa.toLocaleString('de-DE', { style: 'decimal',  decimal: '2' }));
		$("#dvd").html(mon_tasa.toLocaleString('de-DE', { style: 'decimal',  decimal: '2' }));
		$("#dvp").html(mon_tasap.toLocaleString('de-DE', { style: 'decimal',  decimal: '2' }));
	})

   $('#btncancelar').click(function(){	
		total=0; 
		$("#total").html(" $  : " + total.toLocaleString('de-DE', { style: 'decimal',  decimal: '3' }));			  
	    $("#muestramonto").html(" $  : " + total.toLocaleString('de-DE', { style: 'decimal',  decimal: '3' }));
		$("#muestramontobs").html(" Bs  : " + total.toLocaleString('de-DE', { style: 'decimal',  decimal: '2' }));       
        $("#total_venta").val(total);
		for(var i=0;i<cont;i++){
		$("#fila" + i).remove(); subtotal[i]=0; }
    })
	// registro el cliente nuevo
	document.getElementById('Cenviar').style.display="none";
	
	$("#Cenviar").on("click",function(){ 
		document.getElementById('Cenviar').style.display="none";	
         var form1= $('#formulariocliente');
         var url1 = '{{route("almacenacliente")}}';
         var data1 = form1.serialize();
	vl=0;
		$.post(url1,data1,function(result){  
	    var resultado=result;
          console.log(resultado);	
        var id=resultado[0].id_cliente;  
        var nombre=resultado[0].nombre; 
		var ced=resultado[0].cedula; 		
        var tp=resultado[0].tipo_precio; 
		var idve=resultado[0].comision; 
		var nv=resultado[0].nombrev; 
		var tpc=resultado[0].tipo_cliente; 	
			$("#id_cliente")
			.append( '<option value="'+id+'_'+tp+'_'+idve+'_'+nv+'_'+tpc+'" selected >'+ced+'-'+nombre+'</option>')
			.selectpicker('refresh');	
			//$('.bootstrap-select .filter-option').text(ced+'-'+nombre)			
			$('select[name=id_cliente]').change();
			mostrarcomision();
			 alert('Cliente Registrado con exito');
			 $("#formulariocliente")[0].reset();
			
        });
    });
	  //fin registrar cliente
	  //valido cedula cliente nuevo
	$("#vidcedula").on("change",function(){
		var form2= $('#formulariocliente');
		var url2 = '{{route("validarcventa")}}';
		var data2 = form2.serialize();
		$.post(url2,data2,function(result2){  
			var resultado2=result2;
			console.log(resultado2); 
			rows=resultado2.length; 
			if (rows > 0){
			var nombre=resultado2[0].nombre;
			var cedula=resultado2[0].cedula; 
			var rif=resultado2[0].telefono;  
			alert ('Numero de identificacion ya existe, Nombre: '+nombre+' Cedula: '+cedula+' telefono: '+rif);   
			$("#vidcedula").val("");
			$("#vidcedula").focus();
			} else{
				$("#virif").val($("#vidcedula").val());
					document.getElementById('Cenviar').style.display="";
			}   
		});
	});
});
	function validar(e){
		let tecla = (document.all) ? e.keyCode : e.which;
			if(tecla==13) { 
				agregar();
				event.preventDefault();
			} }
	function validarno(e){
		let tecla = (document.all) ? e.keyCode : e.which;
			if(tecla==13) { 
				event.preventDefault();
				} }	
	var pagototal=0;
	var cont=0;
	total=0;
	subtotal=[];

	$("#botones").hide();
	$("#pidarticulo").change(mostrarvalores);
	$("#id_cliente").change(mostrarcomision);

    function mostrarvalores(){      
      tipo_precio=document.getElementById('id_cliente').value.split('_');
      var tpc= tipo_precio[1];
      if (tpc==1){ tpc=2;}else {tpc=3;}
      //de los articulos
	    document.getElementById('pcantidad').focus();
      datosarticulo=document.getElementById('pidarticulo').value.split('_');
      $("#pprecio_venta").val(datosarticulo[tpc]);
      $("#pstock").val(datosarticulo[1]);
	  $("#pcostoarticulo").val(datosarticulo[4]);
      $("#pcantidad").val("1");
      $("#pdescuento").val("0");
    }
	function mostrarcomision(){  
       //alert();
	   var cli=$("#id_cliente").val();
      dato=document.getElementById('id_cliente').value.split('_');
      var comi= dato[2];
	  var vendedor= dato[3];
      $("#comision").val(comi);
		$("#vpedido").val(vendedor+'_'+comi);
      $("#nvendedor").val(vendedor);
	  //$('select[name=vpedido]').change();
	  $("#tipocli").val(dato[4]);
      $("#nvendedor").html("Vendedor:"+vendedor);
  }
    function agregar(){
		vdolar=$("#valortasa").val();
      var cantidad=0; var stock=0;
        datosarticulo=document.getElementById('pidarticulo').value.split('_');
        idarticulo=datosarticulo[0];
        articulo= $("#pidarticulo option:selected").text();
        cantidad= $("#pcantidad").val();
        descuento=$("#pdescuento").val();
        precio_venta=$("#pprecio_venta").val();
        stock=$("#pstock").val();
		costoarticulo=datosarticulo[4];
		cantidad=cantidad*1;
        if (idarticulo!="" && cantidad != "" && cantidad > "0" &&  precio_venta!=""){

                subtotal[cont]=((cantidad*precio_venta)-descuento);
                total=parseFloat(total)+parseFloat(subtotal[cont].toFixed(2));

              var fila='<tr class="selected" id="fila'+cont+'" ><td><button class="btn btn-warning btn-xs"  onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" readonly="true" style="width: 60px" value="'+cantidad+'"></td><td><input type="number" readonly="true"  style="width: 80px" name="precio_venta[]" value="'+precio_venta+'"></td><td><input type="number"  name="descuento[]" readonly="true" style="width: 80px" value="'+descuento+'"></td><td>'+subtotal[cont].toFixed(2)+'<input type="hidden" name="costoarticulo[]" readonly="true" value="'+costoarticulo+'"></td></tr>';
              cont++;
              limpiar();
			 // alert(total);
			  var auxmbs=(parseFloat(total)*parseFloat(vdolar));
              $("#total").html(" $  : " + total.toFixed(2));			  
			  $("#muestramonto").html(" $  : " + total.toFixed(2));
			  $("#muestramontobs").html(" Bs  : " + auxmbs.toFixed(2));
              $("#total_venta").val(total);
              evaluar();
              $('#detalles').append(fila);
				$("#pidarticulo").selectpicker('toggle');

        }
        else{
			  toastr.error('Error al ingresar el Articulo en venta, revisar datos!.');
			
        }
    }
    function eliminar(index){
		vdolar=$("#valortasa").val();
        total=(total-subtotal[index]).toFixed(2);
        $("#total").html(total);
        $("#divtotal").val(total);
		$("#resta").val(total);
		var mon_tasad=(total);
		$("#muestramonto").html("$  : " + mon_tasad.toLocaleString('de-DE', { style: 'decimal',  decimal: '3' }));
		$("#muestramontobs").html("Bs  : " + (mon_tasad*vdolar).toLocaleString('de-DE', { style: 'decimal',  decimal: '2' }));
		if(total<0){total=0;}
        $("#total_venta").val(total);
        $("#tdeuda").val(total);
        $("#fila" + index).remove();
        evaluar();

    }
    function limpiar(){
		$("#pidarticulo").val('1000');
		$("#pidarticulo").selectpicker('refresh');
        $("#pcantidad").val("");
        $("#pdescuento").val("");
        $("#pstock").val("");
        $("#pprecio_venta").val("");
    }

    function evaluar(){
        if(total>0){
            $("#botones").show();
        }
        else
        {
            $("#botones").hide();
        }
    }
// calculo pago
  /* function mediopago(){
	   	document.getElementById('bt_pago').style.display="";		
	   var pesoresta =$("#resta").val();  
       var pesototal =$("#divtotal").val();
	   var tabono=$("#totala").val();
	   var debe=(pesototal-tabono);

	     moneda= $("#pidpago").val();
		 tm=moneda.split('_');
		 var idmoneda=tipom=tm[0];
		  tipom=tm[1];
		  valort=tm[2];
		   moneda= $("#pidpago option:selected").text();
		   //alert(tipom);
		   	if (tipom==0){   
				$("#resta").val(pesototal-tabono); 		
				$("#preferencia").val(""); 				
				}  
			if (tipom==1){ 
				$("#resta").val((debe*valort).toFixed(2));  
				$("#preferencia").val('Tc: '+valort);
			}
			if (tipom==2){   
				$("#resta").val((debe/valort).toFixed(2));  
				$("#preferencia").val('Tc: '+valort); 
				}  
				$("#pmonto").attr('placeholder','Monto '+moneda);
		t_pago=$("#pidpago").val();	   
    }
	//agrego tipo pago
	acumpago=[];var contp=0; var tresta=0;
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
			//	alert(acumpago[contp]);
			if (tipom==1){ 
			    var pesoresta =$("#resta").val();  
					//$("#resta").val(pesoresta/valort);  
					$("#total_abono").text(pagototal/valort);
				    denomina=pmonto;
					pmonto=(pmonto/valort);		
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
			//alert(pagototal);
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
			if($("#resta").val()== 0){ 		document.getElementById('procesa').style.display=""; $("#procesa").attr("accesskey","p"); }
			//  alert($("#totala").val());
           limpiarpago();		 
             $('#det_pago').append(fila);
		}else { alert('¡El monto indicado no debe se mayor al saldo pendiente!');
			limpiarpago();		
			}
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
        nv=(parseFloat(resta)+parseFloat(total));
        nc=(parseFloat(var1)-parseFloat(total));
        $("#resta").val(nv);   
        $("#tdeuda").val(nv);  
		$("#totala").val(nc);
        pagototal=(parseFloat(pagototal)-parseFloat(total));
        $("#filapago" + index).remove();
        $("#total_abono").text(nc.toFixed(2));
		$("#totala").val(nc.toFixed(2));
		document.getElementById('procesa').style.display="none"; 
    }*/
	function conMayusculas(field) {
            field.value = field.value.toUpperCase()
	}
	function round(num){
	 var n=Number((Math.abs(num)*100).toPrecision(3));
	 return Math.round(n)/100*Math.sign(num);
	}
 /*	$("#refresh").on("click",function(){
			$("#pidarticulo").empty();
			var form3= $('#formulariocliente');
			var url3 = '{{route("refrescar")}}';
			var data3 = form3.serialize();
			$.post(url3,data3,function(result3){  
				var r3=result3;
				console.log(r3); 
				rows=r3.length; 
				   $("#pidarticulo")
				.append('<option value="1000" selected="selected">Seleccione..</option>');
				for (j=0;j<rows;j++){
				$("#pidarticulo")
				.append( '<option value="'+r3[j].idarticulo+'_'+r3[j].stock+'_'+r3[j].precio_promedio+'_'+r3[j].precio2+'_'+r3[j].costo+'">'+r3[j].articulo+'</option>');
				}
				$("#pidarticulo").selectpicker('refresh');
				$("#pidarticulo").selectpicker('toggle');
			});
	});*/
</script>
@endpush
@endsection

@extends ('layouts.master')
@section ('contenido')
<?php
$fserver=date('Y-m-d');
$fechaini=$empresa->fechainicio;
$fecha_a=$empresa->fechavence;
$dato=$empresa->dato;
$nivel=Auth::user()->nivel;

function dias_transcurridos($fecha_a,$fserver)
{
$dias = (strtotime($fecha_a)-strtotime($fserver))/86400;
//$dias = abs($dias); $dias = floor($dias);
return $dias;
}
$vencida=$cntvend=$cntcli=0;
$diaslicencia=dias_transcurridos($fserver,$fechaini);
$diasuso=($dato-$diaslicencia);
if (dias_transcurridos($fserver,$fechaini)>$dato){
  $vencida=1;
  echo "<div class='alert alert-danger'>
      <H2 align='center'>LICENCIA DE USO DE SOFTWARE VENCIDA!!!</H2> Contacte su Tecnico de soporte.
      </div>";
}if (($diasuso>0) and ($diasuso<10)){
	  echo "<H5 align='center'><FONT color='red'>".$diasuso." Dias para Vencer Licencia de Uso del Software.</FONT> </H5>";
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
$cntvend=count($vendedores);
$cntcli=count($personas);
$idv=0;

?>  
   @foreach ($contador as $p)
		<?php  $idv=$p -> idventa; ?>
		<option style="display: none">{{$p -> idventa}} </option> 
	@endforeach
		
	<div class="row" style="background-color:#f3f4f4"> 
		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
			<h3>Nueva Venta</h3>
			<button type="button" > <a id="calculo" href="" data-target="#modal_tasas" data-toggle="modal"> Referencia Monetaria </a></button>
			@include('ventas.venta.modal_tasas')
			@include('ventas.venta.modalcliente')
			<input type="hidden" value="{{$empresa->tc}}" id="valortasa" name="tc"></input>
			<input type="hidden" value="{{$empresa->peso}}" id="valortasap" name="peso"></input>
			<input type="hidden" value="{{$empresa->fl}}" id="usafl" ></input>
        </div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
			<h4 id="nombrevendedor"></h4>
				<div class="form-group">
					<label for="tipo_precio">Vendedor </label> <?php if($cntvend==0){ echo "<span class='text-danger'>Debe Registrar Vendedor¡¡</span>";} ?> <br>
            			<select name="vpedido" id="vpedido" class="form-control">
            				@foreach ($vendedores as $cat)
            				<option value="{{$cat->id_vendedor}}_{{$cat->comision}}">{{$cat->nombre}}</option>
            				@endforeach
            			</select>            			
            	</div>
		</div>		
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12" align="center">	<label for="tipo_precio">Saldo </label> </br>
			<span class="badge bg-yellow"><label id="cxc" style="font-size: 20px" >0</label></span>
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
	<form action="{{route('guardarventa')}}" method="POST" id="formventa" enctype="multipart/form-data" >         
        {{csrf_field()}}
            <div class="row" style="background-color:#edefef">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
						<input type="hidden" value="{{$empresa->tc}}" id="valortasa" name="tc" class="form-control">
						<input type="hidden" value="{{$empresa->peso}}" id="valortasap" name="peso" class="form-control">
                    		 <input type="hidden" value="" id="nvendedor" name="nvendedor" class="form-control">
						<label for="cliente">Cliente <a href="" data-target="#modalcliente" data-toggle="modal"><span class="label label-success"> <i class="fa fa-fw  fa-user-plus "> </i></span></a></label><?php if($cntvend==0){ echo "<span class='text-danger'>Debe Registrar Cliente!!</span>";} ?>
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
							<input type="hidden" name="tipo_comprobante" class="form-control" value="FAC">
						</div></td><td><div class="form-group">
							<label for="serie_comprobante">#Control</label>
							<input type="hidden" style="background-color:#edefef" name="serie_comprobante" value="{{$empresa->serie}}" size="8" class="form-control"placeholder="serie del comprobante" > 
							<input type="text" style="background-color:#edefef" name="control" value="00-" size="8" class="form-control" placeholder="Num de Control" > 
						</div>	</td><td>	<div class="form-group">
							<label for="num_comprobante">Documento</label>
						 <input type="text" name="num_comprobante" style="background-color:#edefef"value="<?php echo add_ceros($idv,$ceros); ?>" class="form-control" placeholder="numero del comprobante" > 
						 <input type="hidden" name="comision" style="background-color:#edefef" id="comision"  value="" class="form-control">
						</div></td></tr>
					</table>		
				</div>	
            </div>
			<?php if($vencida==0){?>
            <div class ="row" id="divarticulos" style="display: true">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
						 <label>Articulos </label> <i class="fa fa-fw fa-refresh" id="refresh"></i></br>
						 <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true" >
						  <option value="5000" selected="selected">Seleccione Articulo..</option>
						 @foreach ($articulos as $articulo)
						  <option value="{{$articulo -> idarticulo}}_{{$articulo -> stock}}_{{$articulo -> precio_promedio}}_{{$articulo -> precio2}}_{{$articulo -> costo}}_{{$articulo -> iva}}_{{$articulo->serial}}">{{$articulo -> articulo}}</option>
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
                        <input type="number" name="pprecio_venta" id="pprecio_venta"  min="0.01" class ="form-control" placeholder="Precio de Venta" <?php if ($nivel=="L"){?> disabled <?php }  ?> >
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
						@if($rol->crearventa==1)
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
						  <th colspan="4">Total</th>
							 
							  <th style="display: none">Exe:<input type="number" style="width: 70px" readonly  name="totalexe" id="texe">Bs</th>
							  <th style="display: none">Iva:<input type="number" style="width: 70px" readonly  name="total_iva" id="total_iva">Bs</th> 
							  <th style="display: none">BI:<input type="number" style="width: 80px" readonly name="totalbase" id="totalbase">Bs</th>
							  <th colspan="2"><h4 id="total" align="right" >$.  0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
							 
							  </tfoot>
						  <tbody></tbody>
						</table>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="botones"  align="right">
				  <div class="form-group"></br>
						<button class="btn btn-primary" id="guardar" type="button" accesskey="l">Tota<u>l</u>izar</button>
						<button class="btn btn-danger" type="button"  id="btncancelar">Cancelar</button>

					</div>
				</div>
			</div> <?php } ?>
			@include('ventas.venta.modalseriales')			
			<div class ="row" id="divdesglose" style="display: none">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3 align="center">TOTAL <input type="number" id="divtotal" value="" disabled ><span id="pasapago" title="haz click para hacer cobro total">RESTA</span> <input type="number" id="resta" disabled value="">
					<input type="hidden" name="tdeuda" id="tdeuda" value=""  >		
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<select name="pidpago" id="pidpago" class="form-control">
					<option value="100" selected="selected">Selecione...</option>
					@foreach ($monedas as $m)
					 <option value="{{$m-> idmoneda}}_{{$m->tipo}}_{{$m->valor}}">{{$m -> nombre}}</option> 
					@endforeach
					</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<input type="number" class="form-control" name="pmonto" id="pmonto" placeholder="Esperando Seleccion"  min="1" step="0.01">
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
					<div class="table-responsive">
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
							
							  <th colspan="2"><h3>Total $</h3></th>
							  <th><h3 id="total_abono">$.  0.00</h3></th><input type="hidden" name="totala" id="totala" value="0.00">
							  </tfoot>
							<tbody></tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
				<div class="col-lg-4 ol-md-4 col-sm-4 col-xs-4" align="right" style="display: none" id="cfl">
							¿ Forma Libre ? <input type="checkbox" id="convertir" name="convertir" />							
							</div>
					<div class="col-lg-8 ol-md-8 col-sm-8 col-xs-8" align="right">
					<button type="button" class="btn btn-danger" id="regresar" data-dismiss="modal">Cancelar</button>
					<input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
					<button type="submit" id="procesa" class="btn btn-primary" ><u>P</u>rocesar</button>
					<div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
					</div>
				</div>	
				 
				</form>
			</div>
					  
@push ('scripts')
<script>
$(document).ready(function(){
	$('[data-mask]').inputmask();
	document.getElementById('pcantidad').addEventListener('keypress',function(e){ validar(e); });	
	document.getElementById('pprecio_venta').addEventListener('keypress',function(e){ validarno(e); });	
	document.getElementById('pdescuento').addEventListener('keypress',function(e){ validarno(e); });	
	var count =document.getElementById('id_cliente').options.length;
	if(count ==1 ){
		dato=document.getElementById('id_cliente').value.split('_');
		var comi= dato[2];
		var vendedor= dato[3];
		$("#tipocli").val(dato[4]);
		$("#comision").val(comi);
		$("#nvendedor").html("<strong>Vendedor:</strong> "+ vendedor);
		$("#nvendedor").val(vendedor);
				if ($("#tipocli").val()==1){		
		document.getElementById('procesa').style.display="none"; } 
		}else{
		
		$("#id_cliente")
		.append( '<option value="0" selected>Seleccione Cliente.</option>')
		.selectpicker('refresh');
		}
	 document.getElementById('bt_pago').style.display="none";
    $('#bt_add').click(function(){
		if($("#id_cliente").val()==0){
			  toastr.error('¡Debe seleccionar un cliente para el Documento!.');
		}else{
			agregar();
		} 
	});
	$('#vpedido').change(function(){
		dato=document.getElementById('vpedido').value.split('_');
      var comi= dato[1];
      $("#comision").val(comi);
	  $("#nvendedor").val(dato[0]);
	});
	$('#pasapago').click(function(){
		datosbanco=$("#pidpago").val();
		if(datosbanco==100){
		alert('¡Debe seleccionar un tipo de Pago!');}
		else{ $("#pmonto").val($("#resta").val());
		document.getElementById('bt_pago').style.display=""; 
		$("#preferencia").focus();}
	});
	
	$("#pidpago").change(mediopago);
	$('#bt_pago').click(function(){		
		agregarpago();
	});
	$('#btncloseserial').click(function(){		
	$(".accionada").fadeOut("fast");
	});
	$('#closemodal').click(function(){		
	 $("#formulariocliente")[0].reset();
	});
    $('#procesa').click(function(){	  
		abono= $("#totala").val();
        tv= $("#total_venta").val();
		var t1=parseFloat(abono);
		if (t1==tv){ 
		document.getElementById('loading').style.display=""; 
		document.getElementById('procesa').style.display="none"; 
		document.getElementById('regresar').style.display="none"; 
		}else{ 
		document.getElementById('regresar').style.display="none"; 
		document.getElementById('procesa').style.display="none"; 
		document.getElementById('loading').style.display=""; 
		}
    })
    $('#guardar').click(function(){
		var auxmonto=$("#divtotal").val();
		auxmonto=parseFloat(auxmonto.replace(/,/g, ""))
                    .toFixed(2);
		$("#resta").val(auxmonto);
		$("#divtotal").val(auxmonto);
		$('#divarticulos').fadeOut("fast");
		if ($("#tipocli").val()==1){		
		document.getElementById('procesa').style.display="none"; } 
		$('#divdesglose').fadeIn("fast");
		$("#pidpago").focus();
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
    $('#regresar').click(function(){	
		pagototal=0;	 $("#resta").val($("#total_venta").val());
	   $("#total_abono").text("0.0");
	   $("#tdeuda").val($("#total_venta").val());
	   $("#total").val(0);
	   $("#totala").val(0);
	    $("#total_iva").val(0);
       $('#divdesglose').fadeOut("fast");
       $('#divarticulos').fadeIn("fast");
		for(var i=0;i<10;i++){
		$("#filapago" + i).remove(); acumpago[i]=0;}
	})
   $('#btncancelar').click(function(){	
   	totalexe=0;
	totaliva=0;totalbase=0;
		total=0; 
		$("#total").html(" $  : " + total.toLocaleString('de-DE', { style: 'decimal',  decimal: '3' }));			  
	    $("#muestramonto").html(" $  : " + total.toLocaleString('de-DE', { style: 'decimal',  decimal: '3' }));
		$("#muestramontobs").html(" Bs  : " + total.toLocaleString('de-DE', { style: 'decimal',  decimal: '2' }));       
	   $("#divtotal").val(total);
	    $("#resta").val(total);
		$("#tdeuda").val(total);
		$("#totalbase").val(total);
		$("#totalexe").val(total);
		$("#total_iva").val(total);
        $("#total_venta").val(total);
		for(var i=0;i<cont;i++){
		$("#fila" + i).remove(); subtotal[i]=0; subiva[i]=0; base[i]=0; subexe[i]=0; }
    })
	// registro el cliente nuevo
	document.getElementById('Cenviar').style.display="none";
	
	$("#Cenviar").on("click",function(){ 
	if(($("#codpais").val()!= "")&($("#telefono").val()!= "")&($("#direccion").val()!= "") ){
		document.getElementById('Cenviar').style.display="none";	
         var form1= $('#formulariocliente');
         var url1 = '{{route("almacenacliente")}}';
         var data1 = form1.serialize();
		vl=0;
		//alert();
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
	}else{
		alert('Completar Campos Requeridos (*).')
	}
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
function trunc (x, posiciones = 0) {
  var s = x.toString()
  var l = s.length
  var decimalLength = s.indexOf('.') + 1
  var numStr = s.substr(0, decimalLength + posiciones)
  return Number(numStr)
}
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
	totalexe=0;
	var cont=0;
	total=0;
	totaliva=0;totalbase=0;
	subtotal=[];
	subiva=[];
	base=[];
	subexe=[];
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
			var formc= $('#formventa');
			var urlc = '{{route("ventacxc")}}';
			var datac = formc.serialize();
    //     alert(data1);
    $.post(urlc,datac,function(result){  
      var resultadoc=result;
          console.log(resultadoc);
		  		rows=resultadoc.length; 			
			if(rows>0){
				var ms=resultadoc[0].monto.toFixed(2);
        $("#cxc").html("$: " + ms);
			}else{ $("#cxc").html("$: 0");
}
            });
       //alert();
	   var cli=$("#id_cliente").val();
      dato=document.getElementById('id_cliente').value.split('_');
      var comi= dato[2];
	  var vendedor= dato[3];
		$("#comision").val(comi);
		$("#vpedido").val(vendedor+'_'+comi);
		$("#nvendedor").val(vendedor);
		$("#tipocli").val(dato[4]);
		$("#nvendedor").html("Vendedor:"+vendedor);
		if ($("#tipocli").val()==1){		
		document.getElementById('procesa').style.display="none"; }else{document.getElementById('procesa').style.display=""; }
		$("#id_cliente option[value="+cli+"]").attr("selected",true);   
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
		alicuota=datosarticulo[5];
		mserial=datosarticulo[6];
		
		cantidad=cantidad*1;
        if (idarticulo!="" && cantidad != "" && cantidad > "0" &&  precio_venta!=""){

                if (cantidad <= stock){
					if(alicuota>0){subexe[cont]=0;
						base[cont]=trunc(((precio_venta)/((alicuota/100)+1)), 2);
						auxb=trunc((base[cont]*vdolar),2);	
						base[cont]=trunc((cantidad*auxb),2);						
						subiva[cont]=trunc((base[cont]*(alicuota/100)), 2);						
						totalbase=trunc((totalbase+base[cont]),2);
						subiva[cont]=trunc(subiva[cont],2);
						}else{subiva[cont]=0; base[cont]=0; subexe[cont]=trunc(((precio_venta*vdolar)*cantidad),2);}				
					
				totaliva=trunc((totaliva+subiva[cont]),2);
				totalexe=parseFloat(totalexe)+parseFloat(subexe[cont]);
                subtotal[cont]=((cantidad*precio_venta)-descuento);
                total=parseFloat(total)+parseFloat(subtotal[cont].toFixed(2));

              var fila='<tr class="selected" id="fila'+cont+'" ><td><button class="btn btn-warning btn-xs"  onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" readonly="true" style="width: 60px" value="'+cantidad+'"></td><td><input type="number" readonly="true"  style="width: 80px" name="precio_venta[]" value="'+precio_venta+'"></td><td><input type="number"  name="descuento[]" readonly="true" style="width: 80px" value="'+descuento+'"></td><td>'+subtotal[cont].toFixed(2)+'<input type="hidden" name="costoarticulo[]" readonly="true" value="'+costoarticulo+'"></td></tr>';
              cont++;
              limpiar();
		
			  var auxmbs=(parseFloat(total)*parseFloat(vdolar));
				$("#total").html(" $  : " + total.toFixed(2));			  
				$("#muestramonto").html(" $  : " + total.toFixed(2));
				$("#muestramontobs").html(" Bs  : " + auxmbs.toFixed(2));
				$("#divtotal").val(total);
				$("#tdeuda").val(total);
				$("#resta").val(total);
				$("#total_iva").val(totaliva);
				$("#totalbase").val(totalbase);
				$("#texe").val(totalexe.toFixed(2));
				$("#total_venta").val(total);
              evaluar();
				$('#detalles').append(fila);
				$("#pidarticulo").selectpicker('toggle');
					if(mserial==1){ 
						var data = <?php echo json_encode($seriales);?>;
					for(var i=0;i<data.length;i++){
						if(data[i].idarticulo == datosarticulo[0]){
						var fila='<tr class="accionada" id="filaseriales'+i+'" ><td><div class="form-check"><input class="form-check-input" type="checkbox" name="pidserial[]" value="'+data[i].idserial+'" onclick="javascript:cntseriales('+i+');" id="defaultCheck'+i+'"><label class="form-check-label" for="defaultCheck1">Chasis -> '+data[i].chasis+' motor -> '+data[i].motor+' Placa-> '+data[i].placa+' Color-> '+data[i].color+' Año-> '+data[i].año+'</label></div></td></tr>';
    $('#lseriales').append(fila);
	}
					}
					$("#modalseriales").modal("show")};			 
				}else{
              alert("cantidad *"+cantidad+"* supera stock *"+stock+"*");
			  $("#pcantidad").val(1);
              }
        }else{
			  toastr.error('Error al ingresar el Articulo en venta, revisar datos!.');
			
        }
    }
    function eliminar(index){
		vdolar=$("#valortasa").val();
		totaliva=(parseFloat(totaliva) - parseFloat(subiva[index]));
		totalbase=(parseFloat(totalbase) - parseFloat(base[index]));
		totalexe=(parseFloat(totalexe) - parseFloat(subexe[index]));
        total=(total-subtotal[index]).toFixed(2);
        $("#total").html(total);
		//alert(totalexe);
        $("#texe").val(totalexe);
        $("#divtotal").val(total);
		$("#resta").val(total);
		var mon_tasad=(total);
		$("#muestramonto").html("$  : " + mon_tasad.toLocaleString('de-DE', { style: 'decimal',  decimal: '3' }));
		$("#muestramontobs").html("Bs  : " + (mon_tasad*vdolar).toLocaleString('de-DE', { style: 'decimal',  decimal: '2' }));
		if(total<0){total=0;}
        $("#total_venta").val(total);
        $("#total_iva").val(totaliva.toFixed(2));
        $("#totalbase").val(totalbase.toFixed(2));
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
   function mediopago(){
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
$("#pidpago").focus();		   
             $('#det_pago').append(fila);
			 if(($("#tdeuda").val()==0) && ($("#usafl").val()==1)){
				document.getElementById('cfl').style.display="";
				}
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
		if($("#tdeuda").val()==0){
				document.getElementById('cfl').style.display="";
				
				}else{ 
				//	$("#convertir").attr("checked",false);
					document.getElementById('convertir').checked=false; 
					document.getElementById('cfl').style.display="none"; } 
    }
	function conMayusculas(field) {
            field.value = field.value.toUpperCase()
	}
	var cntsele=0;
		function cntseriales(id){
		var miCheckbox = document.getElementById('defaultCheck'+id);
			if(miCheckbox.checked) {
				cntsele=cntsele+1;
				} else {
				cntsele=cntsele-1;
			}
     $("#seleccionados").html("Seleccionados: "+cntsele);
    }
	function round(num){
	 var n=Number((Math.abs(num)*100).toPrecision(3));
	 return Math.round(n)/100*Math.sign(num);
	}
 	$("#refresh").on("click",function(){
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
	});
</script>
@endpush
@endsection

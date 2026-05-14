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
?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<h3>Nueva Produccion </h3>
	</div> 
</div>
	<form action="{{route('guardaproduccion')}}" method="POST" id="formajuste" enctype="multipart/form-data" >         
		{{csrf_field()}} 
	<div class="row">
	        
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<div class="form-group">
                    <label for="concepto">Concepto</label>
                    <input type="text" name="concepto" id="concepto" value="{{old('concepto')}}" class="form-control"placeholder="Descripcion del Documento" > 
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<div class="form-group">
			<label for="responsable">Responsable</label>
			<input type="text"  name="responsable" id="responsable" value="{{old('responsable')}}" class="form-control" placeholder="Responsable">
	<input type="hidden"  name="totalaj" id="totalaj" value="" class="form-control"> 
			</div>
		</div>
	</div>
	<div class ="row">   

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="background-color:#8CF5B0">
			<table>
			<tr><td colspan="3" align="center"><b> Materia Prima</b></td></tr>
			<tr><td>
					<div class="form-group">
					<label>Articulo</label>
					<select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
					@foreach ($articulos as $articulo)<?php  if($articulo->mprima==1){?>
					<option value="{{$articulo -> idarticulo}}_{{$articulo -> costo}}">{{$articulo -> articulo}}</option> 
					<?php } ?>
					@endforeach
					</select>	</div> 
					</td>
					<td>
					<div class="form-group">
						<label for="cantidad">Cantidad</label>
						<input type="number" name="pcantidad" id="pcantidad" min="0" class ="form-control" placeholder="Cantidad">
					</div>
				</td>
				<td>
					<div class="form-group"><label></label>	
					<button type="button" id="bt_addout"  <?php if($vencida==1){?>style="display: none"<?php } ?> onmouseover="this.style.color='blue';" onmouseout="this.style.color='grey';"  class="form-control btn-sm"><i class="fa fa-fw fa-plus-square"></i></button>
				</div>
				</td></tr>
			</table>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
			<table id="detalles_out"  width="100%">
                      <thead style="background-color: #A9D0F5">
                          <th>Supr</th>
                          <th>Articulo</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                      </thead>
                      <tfoot> 
                      <th>Total</th>
                          <th></th>
                       
                          <th colspan="2" align="right"><h6 id="total">$.  0.00</h6><input type="hidden" name="totalo" id="totalo"></th>
                          </tfoot>
                      <tbody></tbody>
            </table>
			</div>
		</div>
		</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="background-color:#C8F8EC" >
			<table>
			<tr><td colspan="3" align="center"> <b>Producto Final</b></td></tr>
			<tr><td>
					<div class="form-group">
					<label>Articulo</label>
					<select name="pidarticulop" id="pidarticulop" class="form-control selectpicker" data-live-search="true">
					@foreach ($articulos as $articulo)<?php  if($articulo->mprima==0){?>
					<option value="{{$articulo -> idarticulo}}_{{$articulo -> costo}}">{{$articulo -> articulo}}</option> 
					<?php } ?>
					@endforeach
					</select>	</div> 
					</td>
					<td>
					<div class="form-group">
						<label for="cantidad">Cantidad</label>
						<input type="number" name="pcantidadp" id="pcantidadp" min="0" class ="form-control" placeholder="Cantidad">
					</div>
				</td>
				<td>
					<div class="form-group"><label></label>	
					<button type="button" id="bt_addin"  <?php if($vencida==1){?>style="display: none"<?php } ?> onmouseover="this.style.color='blue';" onmouseout="this.style.color='grey';"  class="form-control btn-sm"><i class="fa fa-fw fa-plus-square"></i></button>
				</div>
				</td></tr>
			</table>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
			<table id="detalles_in"  width="100%">
                      <thead style="background-color: #A9D0F5">
                          <th>Supr</th>
                          <th>Articulo</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                      </thead>
                      <tfoot> 
                      <th>Total</th>
                          <th></th>
                       
                          <th colspan="2" align="right"><h6 id="totalp">$.  0.00</h6><input type="hidden" name="totalop" id="totalop"></th>
                          </tfoot>
                      <tbody></tbody>
            </table>
			</div>
		</div>
		</div>

		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="guardar" align="right">
            	    <div class="form-group" <?php if($vencida==1){?>style="display: none"<?php } ?> >
                    <input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
                        <button class="btn btn-primary btn-sm" type="button" id="btnguardar" >Guardar</button>
            	       <button class="btn btn-danger btn-sm" type="reset" id="btncancelar">Cancelar</button>
					   <div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
                    </div>
  	
    </div>
   </form>
       </div>    
@push ('scripts')
<script>

$(document).ready(function(){
	
$("#pcantidad").change(validar); 
	document.getElementById('pcantidad').addEventListener('keypress',function(e){ validarno(e); });	
    $('#bt_addout').click(function(){  
		agregar();	
    });
	    $('#bt_addin').click(function(){  
		agregarp();	
    });
	$("#pidarticulo").change(function(){
		  document.getElementById('pcantidad').focus();
	})
		$("#pidarticulop").change(function(){
		  document.getElementById('pcantidadp').focus();
	})

 $('#btnguardar').click(function(){   
 $('#totalaj').val($('#totalo').val()); 
 if($("#concepto").val() == "" ){alert('Debe indicar Concepto.'); } else{
 if($("#responsable").val() == "" ){alert('Debe indicar Responsable.');}else{ 
		document.getElementById('loading').style.display=""; 
		document.getElementById('btnguardar').style.display="none"; 
		document.getElementById('btncancelar').style.display="none"; 
		document.getElementById('formajuste').submit(); }	 }
    })

})
	function validarenter(e){
		let tecla = (document.all) ? e.keyCode : e.which;
		if(tecla==13) { 
		agregar();
	event.preventDefault();
	} }
	    function evaluar(){
        if(total =! 0){
            $("#guardar").show();
        }
        else
        {
            $("#guardar").hide();
        }
    }

  function validar(){  
      pcanti=$("#pcantidad").val();	 
      datosarticulo= $("#pidarticulo option:selected").text();
      arti=datosarticulo.split('_');
	        dato=document.getElementById('pidarticulo').value.split('_');
          st=arti[2];
        if (pcanti>parseFloat(st)){
          alert('cantidad supera al stock!! \n existencia:'+arti[2]);
          $("#pcantidad").val("");
          $("#pcantidad").focus();
        } 
      }		

var cont=0;
var total=0;
subtotal=[];
$("#guardar").hide();
	function agregar(){
        total=$("#totalo").val();
        if (total >= 0){total=total*1;}if (total<0){total=total*1;}
		datosarticulo=document.getElementById('pidarticulo').value.split('_');
        idarticulo=datosarticulo[0];
        articulo= $("#pidarticulo option:selected").text();
        cantidad= $("#pcantidad").val();
        precio_compra=datosarticulo[1];
       tipo="Descargo";

        if (idarticulo!="" && cantidad != "" && tipo!="" & precio_compra!=""){
            
            if (tipo=="Cargo"){
            subtotal[cont]=(cantidad*precio_compra);
                }else{
                  subtotal[cont]=(-cantidad*precio_compra);
                }
                 
            total=(total)+(subtotal[cont]);
            
            var fila='<tr class="selected" id="fila'+cont+'"><td><button class="btn btn-warning btn-xs" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" readonly style="width: 80px" value="'+cantidad+'"></td><td>'+subtotal[cont].toFixed(2)+'</td></tr>';
            cont++;
            limpiar();
			auxtotal=(total*1).toFixed(2);
            $("#total").html("$ : " + auxtotal);
            $("#totalo").val(total); 
         	$("#pidarticulo").selectpicker('toggle');
            evaluar();
            $('#detalles_out').append(fila);
        }
        else{
            alert("Error al ingresar el articulo")
        }
    }
    function eliminar(index){
      total= $("#totalo").val();
        total=total-subtotal[index];
		auxtotal=(total*1).toFixed(2);
        $("#total").html("$" + auxtotal);
          $("#totalo").val(total);
        $("#fila" + index).remove();
        evaluar();

    }
    function limpiar(){
        $("#pcantidad").val("");
      
    }
	
	var contp=0;
	var totalp=0;
	subtotalp=[];
	function agregarp(){
        totalp=$("#totalop").val();
        if (totalp >= 0){totalp=totalp*1;}if (totalp<0){totalp=totalp*1;}
		datosarticulo=document.getElementById('pidarticulop').value.split('_');
        idarticulo=datosarticulo[0];
        articulo= $("#pidarticulop option:selected").text();
        cantidad= $("#pcantidadp").val();
        precio_compra=datosarticulo[1];
       tipo="Cargo";

        if (idarticulo!="" && cantidad != "" && tipo!="" & precio_compra!=""){
            
            if (tipo=="Cargo"){
            subtotalp[contp]=(cantidad*precio_compra);
                }else{
                  subtotalp[contp]=(-cantidad*precio_compra);
                }
                 
            totalp=(totalp)+(subtotalp[contp]);
            
            var filap='<tr class="selected" id="filap'+contp+'"><td><button class="btn btn-warning btn-xs" onclick="eliminarp('+contp+');">X</button></td><td><input type="hidden" name="idarticulop[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidadp[]" readonly style="width: 80px" value="'+cantidad+'"></td><td>'+subtotalp[contp].toFixed(2)+'</td></tr>';
            contp++;            
			auxtotalp=(totalp*1).toFixed(2);
            $("#totalp").html("$ : " + auxtotalp);
            $("#totalop").val(totalp); 
         	$("#pidarticulop").selectpicker('toggle');           
            $('#detalles_in').append(filap);
			 $("#pcantidadp").val("");
           $("#pcantidadp").focus();
        }
        else{
            alert("Error al ingresar el articulo")
        }
    }
	
	function eliminarp(index){
          totalp= $("#totalop").val(); 
        totalp=totalp-subtotalp[index];  
		auxtotalp=(totalp*1).toFixed(2); 
        $("#totalp").html("$" + auxtotalp);	
          $("#totalop").val(totalp);	
        $("#filap" + index).remove();	
    }
    function limpiarp(){
        $("#pcantidadp").val("");
      
    }

</script>
@endpush
@endsection
@extends ('layouts.master')
@section ('contenido')
<?php
$fserver=date('Y-m-d');
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
?>
<div class="row">
	@include('compras.ingreso.modalarticulo')
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<h3>Nuevo Ajuste </h3>
	</div> @include('compras.ajuste.modalcsv')
</div>
	<form action="{{route('guardaajuste')}}" method="POST" id="formajuste" enctype="multipart/form-data" >         
		{{csrf_field()}} 
	<div class="row">
	        
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<div class="form-group">
                    <label for="concepto">Concepto</label>
                    <input type="text" name="concepto" id="concepto" value="{{old('concepto')}}" class="form-control"placeholder="Descripcion del Documento" > 
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<div class="form-group">
			<label for="responsable">Responsable</label>
			<input type="text"  name="responsable" id="responsable" value="{{old('responsable')}}" class="form-control" placeholder="Responsable">
	<input type="hidden"  name="totalaj" id="totalaj" value="" class="form-control"> 
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" align="center">   

			<label for="responsable"> &nbsp; </label></br>
			<?php if($vencida==0){?>		  

			<a href="" title="Cargar Articulos desde Csv" data-target="#modalload" data-toggle="modal" ><i class="fa-sharp fa-solid fa-file-csv fa-2xl"></i></a>

			<?php } ?> 
        </div>	
	</div>
	<div class ="row">                    
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
			<label>Cod - Articulo - existencia</label> <a href="" data-target="#modalarticuloid" data-toggle="modal"><span class="label label-success"><i class="fa  fa-plus-circle"> </i></span></a>
			<select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
			@foreach ($articulos as $articulo)
			<option value="{{$articulo -> idarticulo}} - {{$articulo -> costo}}">{{$articulo -> articulo}}</option> 
			@endforeach
			</select>
			</div>
		</div>             
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
			<label for="tipo">Tipo</label>
			<select name="ptipo" id="ptipo" class="form-control">
				<option value="1" selected>Cargo</option>
				<option value="0">Descargo</option>                         
			</select>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="cantidad">Cantidad</label>
				<input type="number" name="pcantidad" id="pcantidad" min="0" class ="form-control" placeholder="Cantidad">
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="costo">Costo</label>
				<input type="number" name="pcosto" id="pcosto" class ="form-control" placeholder="Costo">
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group"><label></label>	
			<button type="button" id="bt_add"  <?php if($vencida==1){?>style="display: none"<?php } ?> onmouseover="this.style.color='blue';" onmouseout="this.style.color='grey';"  class="form-control"><i class="fa fa-fw fa-plus-square"></i></button>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                      <thead style="background-color: #A9D0F5">
                          <th>Supr</th>
                          <th>Articulo</th>
                          <th>Tipo Ajuste</th>
                          <th>Cantidad</th>
                          <th>Costo</th>
                          <th>Subtotal</th>
                      </thead>
                      <tfoot> 
                      <th>Total</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th><h4 id="total">$.  0.00</h4><input type="hidden" name="totalo" id="totalo"></th>
                          </tfoot>
                      <tbody></tbody>
            </table>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="guardar" align="right">
            	    <div class="form-group">
                    <input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
                        <button class="btn btn-primary btn-sm" type="button" id="btnguardar">Guardar</button>
            	       <button class="btn btn-danger btn-sm" type="reset" id="btncancelar">Cancelar</button>
					   <div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
                    </div>
		</div>
     </form>	
    </div>

       
@push ('scripts')
<script>
$("#pcantidad").change(validar);  
$(document).ready(function(){
	
			document.getElementById('Nenviarcsv').style.display="none"; 
		document.getElementById('pcosto').addEventListener('keypress',function(e){ validarenter(e); });
		document.getElementById('pcantidad').addEventListener('keypress',function(e){ validarno(e); });	
    $('#bt_add').click(function(){   
     agregar();
    });
	$("#pidarticulo").change(function(){
		  document.getElementById('ptipo').focus();
	})
		$("#ptipo").change(function(){
		  document.getElementById('pcantidad').focus();
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

	$("#Nenviar").on("click",function(){
		document.getElementById('Nenviar').style.display="none";
         var form1= $('#formarticulo');
        var url1 = form1.attr('action');
        var data1 = form1.serialize();

    $.post(url1,data1,function(result){  
	    var resultado=result;
          console.log(resultado);	
        var nombre=resultado[0].articulo;  
        var id=resultado[0].idarticulo;
		var costo=resultado[0].costo;		
	$("#pidarticulo")
	.append( '<option value="'+id+' - '+costo+'">'+nombre+'</option>')
	.selectpicker('refresh');
alert('Articulo Registrado con exito');
     $("#formarticulo")[0].reset();
        });
  
          });
		  	$("#Nenviarcsv").on("click",function(){
		document.getElementById('cancelarcsv').style.display="none"; 
		document.getElementById('Nenviarcsv').style.display="none"; 
		document.getElementById('loadingcsv').style.display=""; 
		});
		  			$("#capcsv").change(function(){
				var archivo=document.getElementById('capcsv').value.split('.');
				if(archivo[1]=="csv"){ 
				$("#responsablemodal").val($("#responsable").val());
				$("#conceptomodal").val($("#concepto").val());
				document.getElementById('Nenviarcsv').style.display=""; 
				} else{
					alert('El Archivo indicado no es un Archivo de tipo csv, verifique¡¡'); 
					$("#capcsv").val("");				}
	});
})
							function validarenter(e){
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
var cont=0;
var total=0;
subtotal=[];
$("#guardar").hide();

    function agregar(){
        total=$("#totalo").val();
        if (total>0){total=total*1;}if (total<0){total=total*1;}
		datosarticulo=document.getElementById('pidarticulo').value.split('-');
        idarticulo=datosarticulo[0];
        articulo= $("#pidarticulo option:selected").text();
        cantidad= $("#pcantidad").val();
        precio_compra=$("#pcosto").val();
       tipo= $("#ptipo option:selected").text();

        if (idarticulo!="" && cantidad != "" && tipo!="" & precio_compra!=""){
            
            if (tipo=="Cargo"){
            subtotal[cont]=(cantidad*precio_compra);
                }else{
                  subtotal[cont]=(-cantidad*precio_compra);
                }
                 
            total=(total)+(subtotal[cont]);
            
            var fila='<tr class="selected" id="fila'+cont+'"><td><button class="btn btn-warning btn-xs" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="text" readonly name="tipo[]" value="'+tipo+'"></td><td><input type="number" name="cantidad[]" readonly style="width: 80px" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]"  style="width: 80px" readonly value="'+precio_compra+'"></td><td>'+subtotal[cont].toFixed(2)+'</td></tr>';
            cont++;
            limpiar();
			auxtotal=(total*1).toFixed(2);
            $("#total").html("$ : " + auxtotal);
            $("#totalo").val(total); 
         	$("#pidarticulo").selectpicker('toggle');
            evaluar();
            $('#detalles').append(fila);
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
        $("#pprecio_compra").val("");
         $("#pcosto").val("");
      
    }

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
      arti=datosarticulo.split('-');
	        dato=document.getElementById('pidarticulo').value.split('-');
	  
      tipo= $("#ptipo option:selected").text();
      if (tipo=="Descargo"){
          st=arti[2];
        if (pcanti>parseFloat(st)){
          alert('cantidad supera al stock!! \n existencia:'+arti[2]);
          $("#pcantidad").val("");
          $("#pcosto").val("");
          $("#pcantidad").focus();
        } else {
            dato=document.getElementById('pidarticulo').value.split('-');
			 st1=dato[1];
             $("#pcosto").val(st1*1);
          }
      }if (tipo == "Cargo"){
         dato=document.getElementById('pidarticulo').value.split('-'); 
          st1=dato[1]; 
         $("#pcosto").val(st1*1);
        
        }

      }
</script>
@endpush
@endsection
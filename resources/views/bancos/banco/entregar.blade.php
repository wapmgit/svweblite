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
	<h3>Registrar Entrega {{$banco->nombre}}</h3>

</div>
</div>
	<form action="{{route('addcredito')}}" method="POST" id="formajuste" enctype="multipart/form-data" >         
		{{csrf_field()}} 
	<div class ="row">                    
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">		
			<div class="form-group">
				<label for="nombre">Observacion</label>
				<input type="text" name="concepto" id="concepto" maxlength="40" value="" class="form-control" placeholder="Concepto...">						
			</div>
		</div>             

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="cantidad">Entregado</label>
				<input type="number" name="pcantidad" id="pcantidad" min="0" class ="form-control" placeholder="Cantidad">
			</div>
		</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
			<label for="tipo">Moneda</label>
			<select name="moneda" id="moneda" class="form-control selectpicker" data-live-search="true">				                  
				                              <option value="Bs">Bolivares </option>                 
				                              <option value="Ps">Pesos </option>                 
				                              <option value="Eu">Dolares </option>                 
				                              <option value="Dt">USDT </option>                 
				                              <option value="Eu">Euro </option>                 
				                              </select>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="costo">Para $</label>
				<input type="number" name="monto" id="pmonto"  min="0" class ="form-control" placeholder="Monto">
				<input type="hidden" name="banco" id="banco"  class ="form-control" value="{{$banco->idbanco}}">
			</div>
		</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
			<label>fecha</label>	
				<input type="date" name="fecha" id="pfecha"  class="form-control" value="<?php echo $fserver; ?>">
			</div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
			<div class="form-group"><label></label>	
			<button type="button" id="bt_add"  <?php if($vencida==1){?>style="display: none"<?php } ?> onmouseover="this.style.color='blue';" onmouseout="this.style.color='grey';"  class="form-control"><i class="fa fa-fw fa-plus-square"></i></button>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                      <thead style="background-color: #82E0AA">
                          <th>Supr</th>
                          <th>Obs.</th>
                          <th>Entregado</th>
                          <th>Moneda</th>
                          <th>$</th>
                      </thead>
                      <tfoot> 
                      <th>Total</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th><h4 id="total">$.  0.00</h4><input type="hidden" name="totalo" value="0" id="totalo"></th>
                          </tfoot>
                      <tbody></tbody>
            </table>
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
$("#pcantidad").change(validar);  
$(document).ready(function(){
		document.getElementById('pmonto').addEventListener('keypress',function(e){ validarenter(e); });
		document.getElementById('pcantidad').addEventListener('keypress',function(e){ validarno(e); });	
    $('#bt_add').click(function(){   
     agregar();
    });

		$("#moneda").change(function(){
		  document.getElementById('pmonto').focus();
	})
 $('#btnguardar').click(function(){   
 if($("#totalo").val() == 0 ){alert('Debe Agregar Items.'); }else{ 
		document.getElementById('loading').style.display=""; 
		document.getElementById('btnguardar').style.display="none"; 
		document.getElementById('btncancelar').style.display="none"; 
		document.getElementById('formajuste').submit(); }	 
    })

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
        cantidad= $("#pcantidad").val();
        monto=$("#pmonto").val();
        obs=$("#concepto").val();
       moneda= $("#moneda").val();
       fecha= $("#pfecha").val();
	
        if (monto!="" && cantidad != "" ){
		 subtotal[cont]=(monto); 
		   total=(parseFloat(total)+parseFloat(subtotal[cont]));
            var fila='<tr class="selected" id="fila'+cont+'"><td><button class="btn btn-warning btn-xs" onclick="eliminar('+cont+');">X</button><input type="hidden" name="fecha[]" value="'+fecha+'"></td><td><input type="hidden" name="concepto[]" value="'+obs+'">'+fecha+'-'+obs+'</td><td><input type="hidden" name="cantidad[]" readonly style="width: 80px" value="'+cantidad+'">'+cantidad+'</td><td><input type="hidden" name="moneda[]"  style="width: 80px" readonly value="'+moneda+'">'+moneda+'</td><td><input type="hidden" name="monto[]"  style="width: 80px" readonly value="'+monto+'">'+monto+'</td></tr>';
            cont++;
            limpiar();
			auxtotal=(total*1).toFixed(2);
            $("#total").html("$ : " + total);
            $("#totalo").val(total); 
            evaluar();
            $('#detalles').append(fila);
        }
        else{
            alert("Error al ingresar Datos")
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
        $("#pmonto").val("");
         $("#concepto").val("");
      
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
      pmonto=$("#pmonto").val();	 
      if (pcanti < 0){
          alert('Error');

      }
	  if (pmonto < 0){
            alert('Error');
        
        }

      }
</script>
@endpush
@endsection
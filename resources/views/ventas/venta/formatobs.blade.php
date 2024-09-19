@extends ('layouts.master')
@section ('contenido')
<?php $acum=0; 
$ceros=5;  $acumnc=0; $cto=0;
function add_ceros($numero,$ceros) {
  $numero=$numero;
	$digitos=strlen($numero);
  $recibo=" ";
  for ($i=0;$i<8-$digitos;$i++){
    $recibo=$recibo."0";
  }
return $insertar_ceros = $recibo.$numero;
};
function truncar($numero, $digitos)
{
    $truncar = 10**$digitos;
    return intval($numero * $truncar) / $truncar;
}
?>
            <div class="invoice p-3 mb-3">
<div id="areaimprimir" >
<div id="margen">
<p id="encabezado" style="display:none"></br></br></br></p>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<table width="100%" BORDER="0">
	<tr><td><small><b>FACTURA N° : </small></b><?php if($empresa->usaserie==1){ echo "Serie".$empresa->serie; } ?><?php  $idv=$venta->idventa; echo add_ceros($idv,$ceros); ?></td><td><td><small><b>FECHA DE EMISION: </small></b><?php echo date("d-m-Y",strtotime($venta->fecha_emi)); ?></td><td><small><b>CONDICION: </small></b>Contado</td></tr>
	<tr><td colspan="4"><small><b>NOMBRE Y APELLIDO O RAZON SOCIAL: </b> </small>{{$venta->nombre}} <b>RIF: </b> {{$venta->cedula}}</td></tr>
	<tr><td colspan="4"  width="50%"><small><b>DOMICILIO FISCAL: </b> {{$venta->direccion}} </small><b>TELF: </b> {{$venta->telefono}}</td></tr>
	</table>
	</div>

<?php $des=$aux=$subbs=0; $acumsub=0; $cntline=$cntser=0;?>
</div>
<div class ="row">
                                              
        <div class="col-md-12">
	
            <table id="detalles" width="100%">
                      <thead>                    
							<th>Codigo</th>
                          <th>Descripcion</th>
                          <th>Cantidad</th>
                          <th>Unidad.</th>
                          <th>Descuento.</th>
                          <th>Costo Unit.</th>                    
                          <th>Subtotal</th>
                      </thead>
                 
                      <tbody>
                        @foreach($detalles as $det)
						<?php $cntline++; ?>
                        <tr >
						     <td>{{$det->codigo}}-{{$det->idarticulo}}</td>
                          <td>{{$det->articulo}} <?php if($det->iva>0){echo "(G)"; 
						  $aux=($det->precio_venta/(($det->iva/100)+1));
						  $aux=truncar($aux,2);
						  $cto=truncar(($aux*$venta->tasa),2);						
						  $des=truncar(($det->descuento*$venta->tasa),2);
						   $subbs=($cto*$det->cantidad)-$des;
						   $acumsub=$acumsub+$subbs;
						  }else { echo "(E)"; $cto=truncar(($det->precio_venta*$venta->tasa),2); 
						    $des=truncar(($det->descuento*$venta->tasa),2);
						    $subbs=($cto*$det->cantidad)-$des;
						   $acumsub=$acumsub+$subbs;
						  } ?></td>
                          <td>{{$det->cantidad}}</td>
                          <td>{{$det->unidad}}</td>
                          <td><?php echo number_format( ($des), 2,',','.'); ?></td>
                          <td><?php echo number_format( ($cto), 2,',','.'); ?></td>
                          <td><?php echo number_format( ($subbs), 2,',','.'); ?></td>
                        </tr>
								<?php if ($seriales <> NULL){?>
									@foreach($seriales as $ser) 
									<?php  if ($det->idarticulo == $ser->idarticulo){ $cntser++;?>
									<tr ><td colspan="6"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Chasis:</b> {{$ser->chasis}}
									<b>Motor:</b> {{$ser->motor}}
									<b>Color:</b> {{$ser->color}}
									<b>Año:</b> {{$ser->año}}</td>
									</tr>  
									<?php } ?>
									@endforeach
							<?php	} ?>
						
                        @endforeach
						<?php for($i=($cntline+$cntser);$i<16;$i++){ echo "<tr><td>&nbsp;</td></tr>"; }?>
                      </tbody>
					       <tfoot>                      
                          <th colspan="6">TOTAL:</th>
                          <th ><b><font size="4"><?php echo "Bs ".number_format(($acumsub), 2,',','.'); ?> </b></font></th>
                          </tfoot>
            </table>

										  <table width="100%"><tr>
	<td align="right"><b>Exento Bs: </b></td><td><b><font size="3"  align="center"><?php echo number_format(($venta->texe), 2,',','.'); ?> </b></td>			  
	<td align="right"><b>Base Imponible Bs:  </b></td><td><b><font size="3"  align="center"><?php echo number_format(($venta->base), 2,',','.'); ?> </b></td>	
	<td align="right"><b>Iva(16%) Bs: </b></td><td><b><font size="3"  align="center"><?php echo number_format(($venta->total_iva), 2,',','.'); ?> </b></td>
	<td  align="right"><b>Total Bs: </b></td><td><b><font size="3"  align="center"><?php echo number_format((($venta->texe+$venta->base+$venta->total_iva)), 2,',','.'); ?> </b></td>
	</tr>
	<tr><td colspan="4"><small>Relacionado con Pedido: {{$venta->idventa}}</small></td></tr>
	</table>
        </div>                   
		@if(Auth::user()->nivel=="A")
			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
					 <button type="button" id="regresar" class="btn btn-danger btn-sm" data-dismiss="modal" title="Presione Alt+flecha izq. para regresar">Regresar</button>
                     <button type="button" id="imprimir" onclick="printdiv('areaimprimir');" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>
                    </div>
			</div>  
		@else
			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
					 <button type="button" id="regresarvc" class="btn btn-danger btn-sm" data-dismiss="modal" title="Presione Alt+flecha izq. para regresar">Regresar</button>
                     <button type="button" id="imprimirvc" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>
                    </div>
			</div> 
			@endif
        </div>
        </div>
        </div>
	</div>
@push ('scripts')
<script>
$(document).ready(function(){

	
$('#regresar').on("click",function(){
  window.location="{{route('ventas')}}";
  
});		  
    $('#imprimirvc').click(function(){
  //  alert ('si');
  document.getElementById('imprimirvc').style.display="none";
  document.getElementById('regresarvc').style.display="none";
  window.print(); 
  window.location="{{route('ventacaja')}}";
    });
$('#regresarvc').on("click",function(){
  window.location="{{route('ventacaja')}}";
  
});
});
function printdiv(divname){
		document.getElementById('imprimir').style.display="none";
		document.getElementById('regresar').style.display="none";
		document.getElementById('encabezado').style.display="";
	 	var printcontenido =document.getElementById(divname).innerHTML;
		var originalcontenido = document.body.innerHTML;
		document.body.innerHTML =printcontenido;
	  	window.print();
		 window.location="{{route('ventas')}}";
	  	document.body.innerHTML=originalcontenido;
  }
</script>
@endpush
@endsection
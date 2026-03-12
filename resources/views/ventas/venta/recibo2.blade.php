@extends ('layouts.master')
@section ('contenido')    
<?php $acum=0; 
$ceros=5;  $acumnc=0;
function add_ceros($numero,$ceros) {
  $numero=$numero;
$digitos=strlen($numero);
  $recibo=" ";
  for ($i=0;$i<8-$digitos;$i++){
    $recibo=$recibo."0";
  }
return $insertar_ceros = $recibo.$numero;
};
$acumpeso=0;
$cntline=0;
?>   	 

<style>
@media print {
    /* Configuración general de la página */
    @page {
        size: 80mm auto; /* Ancho fijo de 80mm, altura automática */
        margin: 0mm;    /* Márgenes mínimos para aprovechar el espacio */
    }

    /* Estilos para el cuerpo del contenido */
    div {
        width: 80mm;
        padding: 0;
        margin: 0;
		 font: oblique bold 120% cursive;
        font-size: 10pt; /* Tamaño de fuente adecuado para ticket */
    }

    /* Ocultar elementos no deseados */
    header, nav, footer, aside, .no-print {
        display: none;
    }

    /* Estilos para tablas (tickets/facturas) */
    #tablecabecera {
        width: 130%;
        border-collapse: collapse; /* Une bordes de celdas */
        margin-top: 2px;
		font: oblique bold 120% cursive;
        font-size: 12pt; /* Tamaño de fuente adecuado para ticket */
    }
    #tablecentro {
        width: 130%;
        border-collapse: collapse; /* Une bordes de celdas */
        margin-top: 2px;
    }
}
.lista{
	font: bold 90% monospace;
	 font-size: 16pt;
	
}
.tabla-principal th, td {
     border: 0px solid #000; /* Bordes finos */
         padding: 1px 1px;
        text-align: center;
}
.tabla-secundaria th, td {
		border: 1px solid #000; /* Bordes finos */
		border-style: dotted;
        padding: 1px 1px;
        text-align: left;
}
</style>
<div>

<?php
function adjustext($textoin,$nc){
$texto = $textoin;
$ancho_maximo = $nc; // Caracteres por línea
$lineas = explode("\n", $texto);
$contenido_formateado = "";
foreach ($lineas as $linea) {
    $contenido_formateado .= wordwrap($linea, $ancho_maximo, "\n", true) . "\n";
}
return $contenido_formateado;
}

$acumpeso=0;
?>  
<table border="0" style="line-height:95%" align="center" id="tablecabecera" class="tabla-principal">
 <thead> <th><b><font size="4"><?Php echo nl2br(adjustext($empresa->nombre,30)); ?></font></b></th> </thead> 
<thead><th><b><font size="3"> <?php if($empresa->mrif==1){ echo $empresa->rif; }?></font></b></th></thead>
<thead><th><b><font size="2"> <?php if($empresa->mdireccion==1){ echo nl2br(adjustext($empresa->direccion,40)); } ?></font><small><?php if($empresa->mtel==1){?>{{$empresa->telefono}}<?php } ?></small></b></th></thead>
</table>			
<div align="left">				 
	<font size="4">{{$venta->cedula}} -> {{$venta->nombre}}</br></font>
	{{$venta->direccion}} </br>
	<font size="4"><b>Documento:  <?php $idv=$venta->num_comprobante; echo add_ceros($idv,$ceros); ?> </b></font> </br>
	  <font size="2"> <b>  <?php echo date("d-m-Y h:i:s a",strtotime($venta->fecha_hora)); ?></b></font></br>
	  </br>
	  </br>
</div>    
                  <table style="line-height:90%"  id="tablecentro" class="tabla-secundaria">
                      <thead>                 
						
                          <th width="80%" align="center"><b class="lista">Cantidad-Descripcion</b></th>
                          <th width="15%"><b class="lista">Subtotal</b></th>
                      </thead>
                  
                      <tbody>
                        @foreach($detalles as $det)<?php  $cntline++;?>
                        <tr height="10px"> 						
                         <td align="left"><span class="lista">
						   {{$det->cantidad}} -
						  <?php echo strtolower($det->articulo);?><?php if($det->iva>0){echo "(G)"; }else { echo "(E)"; } ?> - <?php echo number_format( $det->precio_venta, 2,',','.'); ?> </span></td>                       
                          <td><span class="lista"><?php echo "$ ".number_format( (($det->cantidad*$det->precio_venta)), 2,',','.'); ?></span></td>
                        </tr>
                        @endforeach
                      </tbody>
					     <tfoot>  
					  <th colspan="2" ><div align="center"><font size="4">
                       $: <?php echo number_format($venta->total_venta, 2,',','.'); ?> </font></div></th>                      
						</tfoot>
					 
                  </table>
				  <?php  if(count($recibos)>0){?>
                  <table class="tabla-secundaria" width="130%">
                      <thead>                  
                          <td>Tipo</td>
                          <td>Monto</td>
                          <td>Monto$</td>                        
                      </thead>                     
                      <tbody>                       
                        @foreach($recibos as $re) <?php  $acum=$acum+$re->monto;?>
                        <tr >
                          <td>{{$re->idbanco}}</small></font></td>
                          <td><?php echo number_format( $re->recibido, 2,',','.'); ?></td>
						  <td><?php echo number_format( $re->monto, 2,',','.'); ?></td>                       
                        </tr>
                        @endforeach
                    
                      </tbody>
                  </table>
				  <?php } ?>
</div></br><p></br></br>Gracias por su Compra...</p>
     <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
					 <button type="button" id="regresar" class="btn btn-danger btn-xs" data-dismiss="modal">Regresar</button>
                     <button type="button" id="imprimir" class="btn btn-primary btn-xs"  >Imprimir</button>
                    </div>
                </div>  
			
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  document.getElementById('regresar').style.display="none";
  window.print(); 
 
  window.location="{{route('newventa')}}";
    });
});

  $('#regresar').on("click",function(){
  window.location="{{route('newventa')}}";
  
});

</script>
@endpush
@endsection
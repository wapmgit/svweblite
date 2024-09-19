@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; ?>
<?php $acum=0; $idv=0;
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
function truncar($numero, $digitos)
{
    $truncar = 10**$digitos;
    return intval($numero * $truncar) / $truncar;
}

?>
<div class="row">
		@include('reportes.ventas.ventasf.search')
</div>
 <!-- Main content -->
	<div class="invoice p-3 mb-3">
		<div class="row">
                <div class="col-12">
                  <h4>
                   <img src="{{asset('dist/img/iconosistema.png')}}" title="NKS"> SysVent@s
                    <small class="float-right"></small>
                  </h4>
                </div>
                <!-- /.col -->
		</div>
              <!-- info row -->
		<div class="row invoice-info">
			@include('reportes.ventas.ventasf.empresa')
		</div>
<div class="row">
   <h4 align="center">REPORTE DE VENTAS FORMA LIBRE</h4> <p align="right">
    <span ><?php echo date("d-m-Y",strtotime($searchText)); ?> al <?php echo date("d-m-Y",strtotime($searchText2)); ?> </span></p>
    <div class="table-responsive">
    <table width="100%">
        <thead style="background-color: #E6E6E6">
          <th class="filap1">Anul.d </th>
          <th>Item </th>
		  <th>Cliente </th>
		  <th>Nro Factura </th>
		  <th>Fecha </th>
		  <th>Nro control </th>
          <th>Doc.</th>
          <th>Base</th>
          <th>Exento</th>
          <th>Iva</th>
          <th>Monto</th>
   
        </thead>
        <?php $acumbase= 0; $tv=0; $acumexe=0; $acumiva=0; $acumt=0; $contado=0; $count=0;?>

               @foreach ($datos as $q)
               <?php $count++; 
			   $tv=$q->texe+$q->total_iva+$q->base;
			   $acumt=$acumt+$tv;
			   $acumbase=$acumbase+$q->base;
			   $acumexe=$acumexe+$q->texe;
			   $acumiva=$acumiva+$q->total_iva;
			   ?> 
        <tr <?php if($mostrar==0){?> style="display:none" <?php } ?> >
          <td class="filap1"><?php if($q->anulado==0){ ?><a href="" data-target="#modal-anul{{$q->idForma}}" data-toggle="modal" title="Anular Documento"><i class="fa-solid fa-trash-can" style="color:red"></i></a><?php } else { echo "<i class='fa-solid fa-trash-can' tittle='Anulado'></i>"; } ?></td>
          <td><?php echo $count; ?></td>
		   <td><small><small>{{ $q->nombre}}</small></small></td>
		   <td><small><small><?php if($empresa->usaserie==1){ echo "Serie".$empresa->serie;} ?><?php $idv=$q->idForma; echo add_ceros($idv,$ceros); ?></small></small></td>
		     <td><small><small><?php echo date("d-m-Y",strtotime($q->fecha_hora)); ?></small></small></td>
		   <td><small><small>{{ $q->nrocontrol}}<?php if($q->anulado==1){ echo " Anulada";} ?></small></small></td>
          <td><small>{{ $q->tipo_comprobante}}-{{ $q->num_comprobante}} <?php if ($q->devolu>0){ echo "- Devuelta";}?></small></td>       
		  	  <td><small><?php  echo number_format($q->base, 2,',','.')." Bs"; ?></small></td>
		  	  <td><small><?php  echo number_format($q->texe, 2,',','.')." Bs"; ?></small></td>
		  	  <td><small><?php  echo number_format($q->total_iva, 2,',','.')." Bs"; ?></small></td>
		  	  <td><small><?php  echo number_format($tv, 2,',','.')." Bs"; ?></small></td>

        </tr>
       	@include('reportes.ventas.ventasf.modal')
        @endforeach
<tr>
<td class="filap1"></td><td><small><b colspan="3">Total: <?php echo $count; ?></b></small></td><td colspan="4"></td>
<td></td>
<td><small><b><?php  echo number_format($acumbase, 2,',','.')." Bs"; ?></b></small></td>
<td><small><b><?php  echo number_format($acumexe, 2,',','.')." Bs"; ?></b></small></td>
<td><small><b><?php  echo number_format($acumiva, 2,',','.')." Bs"; ?></b></small></td>
<td><small><b><?php  echo number_format($acumt, 2,',','.')." Bs"; ?></b></small></td>
</tr>
      </table>
</div>





	          <label>Usuario: {{ Auth::user()->name }}</label>       


                     <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary" data-dismiss="modal">Imprimir</button>
                    </div>
                </div>
                   
        
              </div><!-- /.box -->
              </div><!-- /.box -->
             

@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
		$(".filap1").remove();
  document.getElementById('imprimir').style.display="none";
 window.print(); 
 window.location="{{route('correlativof')}}";
    });

});

</script>

@endpush
@endsection
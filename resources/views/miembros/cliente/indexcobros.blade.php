@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; ?>
<div class="row" >
		@include('miembros.cliente.searchcobros')
</div>

<?php $acum=0;$tcobranza=0;$deb=0;$che=0;$tra=$tventas=$tingnd=0;$acumnc=0;
$cefe=0;
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
?>
 <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
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
			@include('miembros.cliente.empresa')
              </div>
			  
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
			   <div class="col-12 table-responsive">
				<table width="100%">
					<thead><th colspan="9">Detalle de Ingresos</th></thead>
					<thead style="background-color: #E6E6E6" >
						<th id="campo">Recibo</th>
						<th>Cliente</th>
						<th>Moneda</th>
						<th>Recibido</th>
						<th>Monto</th>
						<th>Referencia</th>
						<th>Fecha Rec.</th>
				
					</thead>
					@foreach ($cobranza as $cob)
					<?php  $tcobranza=$tcobranza+$cob->monto;?> 		 
					<tr>
						<td><?php $idv=$cob->idrecibo; echo add_ceros($idv,$ceros); ?></td>
						<td>{{$cob->nombre}}</td>
						<td><?php  echo$cob->idbanco; ?></td>
						<td><?php echo number_format($cob->recibido, 2,',','.'); ?></td>
						<td><?php  echo number_format($cob->monto, 2,',','.')." $"; ?></td>
						<td>{{$cob->referencia}}</td>

						<td><?php echo date("d-m-Y",strtotime($cob->fecharecibo)); ?></td>

					</tr>
					<tr>  
					@endforeach
					<tr>    
						<td colspan="4"><strong>Total Ingresos Cobranza</strong></td>
						<td colspan="3"><strong><?php  echo number_format($tcobranza, 2,',','.'); ?> $</strong></td></tr>
				</table>
		   
			
			</div>
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12"><h5 align="center">Desglose de Ingresos</h5>
	    <table width="100%">
			<thead style="background-color: #E6E6E6" >
				<th>Moneda</th>
				<th>Recibido</th>
				<th>Monto</th>
			</thead>
				@foreach ($comprobante as $co)
					<?php   if($co->tiporecibo=="P") {?>
				<tr>
				<td>{{$co->idbanco}}</td>
				<td><?php echo number_format($co->mrecibido, 2,',','.'); ?></td>
				<td><?php  echo number_format($co->mmonto, 2,',','.')." $"; ?></td>
				</tr>		 <?php } ?>
				@endforeach

		</table> 
	  </div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 		       
		<label>Usuario: </label>  {{ Auth::user()->name }}  
				<div class="form-group" align="center">
				<button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
				</div>

		</div><!-- /.box-body -->
</div><!-- /.box -->
    </div>        
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('reporteingresosm')}}";
    });
});

</script>
@endpush
@endsection
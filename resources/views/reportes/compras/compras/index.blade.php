@extends ('layouts.master')
@section ('contenido')
<div class="row">
		@include('reportes.compras.compras.search')
</div>
<?php $acum=0;$efe=0;$deb=0;$che=0;$tra=0;$ctra=0;$cche=0; $cdeb=0;
$cefe=0;?>
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
			@include('reportes.compras.compras.empresa')
              </div>
              <!-- /.row -->
              <!-- Table row -->
            <div class="row">
				<div class="col-12 table-responsive">
					<table width="100%">
					<thead style="background-color: #E6E6E6">
					  <th>Rif</th>
					  <th>Proveedor</th>
					  <th>Comprobante</th>
					  <th>Monto</th> 
					  <th>Base Imponible</th>
					  <th>M. Iva</th>
					  <th>Exento</th>
					  <th>Pagado</th>		
					</thead><?php $count=0; $deuda=0; $acump=0; $tmonto=0; $tdeuda=0;$tbase=$texento=$tmiva=0; ?>
					@foreach ($datos as $q)
						<tr> <?php $count++; ?> 
							<td>{{ $q->rif}}</td>
							<td>{{ $q->nombre}}</td>
							<td>{{$q->tipo_comprobante}} {{$q->num_comprobante}}</td>
							<td><?php $tmonto=($tmonto+$q->total);
								$tdeuda=($tdeuda+$q->saldo);
							echo number_format( $q->total,2,',','.')." $"; ?></td>
							 <td> <?php  $tbase=($tbase+$q->base); echo number_format( $q->base, 2,',','.')." $"; ?></td>
							 <td> <?php  $tmiva=($tmiva+$q->miva);  echo number_format( $q->miva, 2,',','.')." $"; ?></td>
							 <td> <?php  $texento=($texento+$q->exento);  echo number_format( $q->exento, 2,',','.')." $"; ?></td>
							<td><?php $deuda=($q->total-$q->saldo); echo number_format($deuda, 2,',','.')." $"; ?></td>	
						</tr>
					@endforeach
						<tr><td colspan="3"><strong>Total</strong></td><td><strong><?php echo number_format( $tmonto, 2,',','.'); ?></strong></td>
							<td><strong><?php echo number_format( $tbase, 2,',','.')." $"; ?></strong></td>
							<td><strong><?php echo number_format( $tmiva, 2,',','.')." $"; ?></strong></td>
							<td><strong><?php echo number_format( $texento, 2,',','.')." $"; ?></strong></td>
							<td><strong><?php echo "Por pagar: ".number_format( $tdeuda, 2,',','.')." $"; ?></strong></td>
						</tr>
					</table>
				</div>
				<div class="col-12 table-responsive">
					<table width="100%">
						<thead >      
							<tr><td colspan="3" style="background-color: #E6E6E6" align="center"><strong>DESGLOSE DE PAGOS<strong></td></tr>
							<th>Moneda</th>
							<th>Entregado</th>
							<th>Monto</th>     
						</thead>
						@foreach ($pagos as $q)
							<tr >
							<td>{{$q->idbanco}}</td>
							<td><?php echo number_format($q->recibido, 2,',','.'); ?></td>
							<td><?php $acump=$acump+$q->monto; echo number_format($q->monto, 2,',','.')." $"; ?></td>
							</tr>  
						@endforeach
						<tr><td align="center" colspan="3"> <strong> Total Pagos: <?php echo number_format($acump, 2,',','.')." $"; ?></strong></td></tr>
					</table>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 		       
					<label>Usuario: </label>  {{ Auth::user()->name }}  
					<div class="form-group" align="center">
					<button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
					</div>
				</div>
				
			</div> 
	@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('resumencompras')}}";
    });

});
</script>
@endpush
@endsection
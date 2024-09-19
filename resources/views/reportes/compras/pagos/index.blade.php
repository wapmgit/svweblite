@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; $tingnd=0; $acumegre=0; ?>
<div class="row">
		@include('reportes.compras.pagos.search')
	</div>
<?php $acum=0;$tcobranza=0;$deb=0;$che=0;$tra=0;
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
			@include('reportes.compras.pagos.empresa')
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
      <table width="100%">
      <thead style="background-color: #E6E6E6" >
	  <thead><th colspan="9" >Egresos por Pago Compras/Gastos</th></thead>
	  <th id="campo">Recibo</th>
	  <th>Usuario</th>
		<th>Proveedor</th>
		<th>Documento</th>
		<th>Moneda</th>
		<th>Recibido</th>
		<th>Monto</th>
		<th>Referencia</th>
		<th>Fecha Rec.</th>
		</thead>
         @foreach ($pagos as $cob)
		 <?php  $tcobranza=$tcobranza+$cob->monto; ?> 
        <tr>
		<td><?php if ($cob->monto>0){?>
<a href="" data-target="#modal-delete-{{$cob->idrecibo}}" data-toggle="modal" ><button class="btn btn-danger btn-xs" >X</button></a>	
		<?php } ?>
		{{$cob->idrecibo}}</td>
		<td>{{$cob->vendedor}}</td>
		<td>{{$cob->nombre}}</td>
		<td>{{$cob->num_comprobante}}</td>
          <td><?php  echo$cob->idbanco; ?></td>
          <td><?php echo number_format($cob->recibido, 2,',','.'); ?></td>
             <td><?php  echo number_format($cob->monto, 2,',','.')." $"; ?></td>
			 <td>{{$cob->referencia}}</td>
			 <td><?php echo date("d-m-Y h:i:s a",strtotime($cob->fecha)); ?></td>
        </tr>
			@include('reportes.compras.pagos.modal')
        @endforeach
		   @foreach ($gastos as $cob)
		 <?php  $tcobranza=$tcobranza+$cob->monto; ?> 
        <tr>
		<td><?php if ($cob->monto>0){?>
<a href="" data-target="#modal-delete-{{$cob->idrecibo}}" data-toggle="modal" ><button class="btn btn-danger btn-xs" >X</button></a>	
		<?php } ?>
		{{$cob->idrecibo}}</td>
		<td>{{$cob->vendedor}}</td>
		<td>{{$cob->nombre}}</td>
		<td>G:{{$cob->documento}}</td>
          <td><?php  echo$cob->idbanco; ?></td>
          <td><?php echo number_format($cob->recibido, 2,',','.'); ?></td>
             <td><?php  echo number_format($cob->monto, 2,',','.')." $"; ?></td>
			 <td>{{$cob->referencia}}</td>
			 <td><?php echo date("d-m-Y h:i:s a",strtotime($cob->fecha)); ?></td>
        </tr>
			@include('reportes.compras.pagos.modalg')
        @endforeach
		<tr><td colspan="6"><strong>Total Egresos</strong></td><td colspan="3"><strong><?php  echo number_format($tcobranza, 2,',','.'); ?> $</strong></td></tr>
      </table>
	  			<table width="100%">
					<thead><th colspan="9" >Egresos por Pago Notas de Debito</th></thead>
					<thead style="background-color: #E6E6E6" >
						<th id="campo">Recibo</th>
						<th>Usuario</th>
						<th>Porveedor</th>
						<th>Documento</th>
						<th>Moneda</th>
						<th>Recibido</th>
						<th>Monto</th>
						<th>Referencia</th>
						<th>Fecha Rec.</th>
					</thead>
					@foreach ($egresosnd as $ingnd)
						<?php $tingnd=$tingnd+$ingnd->monto;  ?> 
					<tr>
						<td><?php if ($ingnd->monto>0){?>
						<a href="" data-target="#modal-deletend-{{$ingnd->idrecibo}}" data-toggle="modal" ><button class="btn btn-danger btn-xs" >X</button></a>	
						<?php } ?>
						{{$ingnd->idrecibo}}</td>
						<td>{{$ingnd->vendedor}}</td>
						<td>{{$ingnd->nombre}}</td>
						<td>N/D-{{$ingnd->num_comprobante}}</td>
						<td><?php  echo $ingnd->idbanco; ?></td>
						<td><?php echo number_format($ingnd->recibido, 2,',','.'); ?></td>
						<td><?php  echo number_format($ingnd->monto, 2,',','.')." $"; ?></td>
						<td>{{$ingnd->referencia}}</td>
						<td><?php echo date("d-m-Y h:i:s a",strtotime($ingnd->fecha)); ?></td>
					</tr>
							@include('reportes.compras.pagos.modalnd')
					@endforeach
					<tr>    
						<td colspan="6"><strong>Total Egresos N/D</strong></td><td colspan="3"><strong><?php  echo number_format($tingnd, 2,',','.'); ?> $</strong></td></tr>
				</table>
	  </div>
	  </div>

	     <div class="col-12 table-responsive">
	    <table width="100%">
      <thead style="background-color: #E6E6E6" >
	  <th>Moneda</th>
		<th>Entregado</th>
		<th>Monto</th>
		</thead>
         @foreach ($comprobante as $co)
		 <?php $acumegre=$acumegre+$co->monto;?>
        <tr>
		<td>{{$co->idbanco}}</td>
		<td><?php echo number_format($co->recibido, 2,',','.'); ?></td>
    <td><?php  echo number_format($co->monto, 2,',','.')." $"; ?></td>
        </tr>
        @endforeach
		<tr><td colspan="2"><strong>Total Egresos</strong></td>
		  <td><strong><?php  echo number_format($acumegre, 2,',','.')." $"; ?></strong></td></tr>
      </table>
	  </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  		       
                     <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
					   <label>Usuario: </label>  {{ Auth::user()->name }}  
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
                    </div>
                </div>
                   
</div><!-- /.box-body -->
</div><!-- /.box -->
             

@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('detallegresos')}}";
    });

});

</script>

@endpush
@endsection
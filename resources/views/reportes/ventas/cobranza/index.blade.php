@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; ?>
<div class="row" >
		@include('reportes.ventas.cobranza.search')
</div>

<?php $acum=0;$tcobranza=0;$deb=0;$che=0;$tra=$tventas=$tingnd=0;$acumnc=0;
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
			@include('reportes.ventas.cobranza.empresa')
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
			   <div class="col-12 table-responsive">
				<table width="100%">
					<thead><th colspan="9">Cobranza</th></thead>
					<thead style="background-color: #E6E6E6" >
						<th id="campo">Recibo</th>
						<th>Vendedor</th>
						<th>Cliente</th>
						<th>Documento</th>
						<th>Moneda</th>
						<th>Recibido</th>
						<th>Monto</th>
						<th>Referencia</th>
						<th>Fecha Rec.</th>
					</thead>
					@foreach ($cobranza as $cob)
					<?php   if($cob->tiporecibo=="A") { $tcobranza=$tcobranza+$cob->monto;?> 		 
					<tr>
						<td><?php if ($cob->monto>0){?>
							<a href="" data-target="#modal-delete-{{$cob->idrecibo}}" data-toggle="modal" ><button class="btn btn-danger btn-xs" >X</button></a>	
							<?php } ?>
						{{$cob->idrecibo}}</td>
						<td>{{$cob->vendedor}}</td>
						<td>{{$cob->nombre}}</td>
						<td>{{$cob->tipo_comprobante}}-{{$cob->num_comprobante}}</td>
						<td><?php  echo$cob->idbanco; ?></td>
						<td><?php echo number_format($cob->recibido, 2,',','.'); ?></td>
						<td><?php  echo number_format($cob->monto, 2,',','.')." $"; ?></td>
						<td>{{$cob->referencia}}</td>
						<td><?php echo date("d-m-Y h:i:s a",strtotime($cob->fecha)); ?></td>
					</tr>
					@include('reportes.ventas.cobranza.modal')
					<tr>  <?php  } ?>
					@endforeach
					<tr>    
						<td colspan="6"><strong>Total Ingresos Cobranza</strong></td><td colspan="3"><strong><?php  echo number_format($tcobranza, 2,',','.'); ?> $</strong></td></tr>
				</table>
		       <table width="100%">
					<thead><th colspan="9" >Ventas</th></thead>
					<thead style="background-color: #E6E6E6" >
						<th id="campo">Recibo</th>
						<th>Vendedor</th>
						<th>Cliente</th>
						<th>Documento</th>
						<th>Moneda</th>
						<th>Recibido</th>
						<th>Monto</th>
						<th>Referencia</th>
						<th>Fecha Rec.</th>
					</thead>
		         @foreach ($cobranza as $cob)
					<?php   if($cob->tiporecibo=="P") { $tventas=$tventas+$cob->monto;?> 
					<tr>
						<td><?php if ($cob->monto>0){?>
						<a href="" data-target="#modal-delete-{{$cob->idrecibo}}" data-toggle="modal" ><button class="btn btn-danger btn-xs" >X</button></a>	
						<?php } ?>
						{{$cob->idrecibo}}</td>
						<td>{{$cob->vendedor}}</td>
						<td>{{$cob->nombre}}</td>
						<td>{{$cob->tipo_comprobante}}-{{$cob->num_comprobante}}</td>
						<td><?php  echo$cob->idbanco; ?></td>
						<td><?php echo number_format($cob->recibido, 2,',','.'); ?></td>
						<td><?php  echo number_format($cob->monto, 2,',','.')." $"; ?></td>
						<td>{{$cob->referencia}}</td>
						<td><?php echo date("d-m-Y h:i:s a",strtotime($cob->fecha)); ?></td>
					</tr>
					@include('reportes.ventas.cobranza.modal')
					<?php  } ?>
				@endforeach
					<tr>    
						<td colspan="6"><strong>Total Ingresos Ventas</strong></td><td colspan="3"><strong><?php  echo number_format($tventas, 2,',','.'); ?> $</strong></td></tr>
				</table>
				<table width="100%">
					<thead><th colspan="9" >Ingresos por Notas de Debito</th></thead>
					<thead style="background-color: #E6E6E6" >
						<th id="campo">Recibo</th>
						<th>Usuario</th>
						<th>Cliente</th>
						<th>Documento</th>
						<th>Moneda</th>
						<th>Recibido</th>
						<th>Monto</th>
						<th>Referencia</th>
						<th>Fecha Rec.</th>
					</thead>
					@foreach ($ingresosnd as $ing)
						<?php $tingnd=$tingnd+$ing->monto;  ?> 
					<tr>
						<td><?php if ($ing->monto>0){?>
						<a href="" data-target="#modal-delete-{{$ing->idrecibo}}" data-toggle="modal" ><button class="btn btn-danger btn-xs" >X</button></a>	
						<?php } ?>
						{{$ing->idrecibo}}</td>
						<td>{{$ing->vendedor}}</td>
						<td>{{$ing->nombre}}</td>
						<td>{{$ing->tipo_comprobante}}-{{$ing->num_comprobante}}</td>
						<td><?php  echo $ing->idbanco; ?></td>
						<td><?php echo number_format($ing->recibido, 2,',','.'); ?></td>
						<td><?php  echo number_format($ing->monto, 2,',','.')." $"; ?></td>
						<td>{{$ing->referencia}}</td>
						<td><?php echo date("d-m-Y h:i:s a",strtotime($ing->fecha)); ?></td>
					</tr>
						@include('reportes.ventas.cobranza.anularnd')
					@endforeach
					<tr>    
						<td colspan="6"><strong>Total Ingresos Ventas</strong></td><td colspan="3"><strong><?php  echo number_format($tingnd, 2,',','.'); ?> $</strong></td></tr>
				</table>
			</div>
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12"><h5 align="center">Desglose de Ingresos</h5>
	    <table width="100%">
			<thead style="background-color: #E6E6E6" >
				<th>Moneda</th>
				<th>Recibido</th>
				<th>Monto</th>
			</thead>
			<tr><td colspan="3" style="background-color: #E6E6E6"><strong> Cobranza </strong></td></tr>
				@foreach ($comprobante as $co)
				<?php   if($co->tiporecibo=="A") {?>
				<tr>
				<td>{{$co->idbanco}}</td>
				<td><?php echo number_format($co->mrecibido, 2,',','.'); ?></td>
				<td><?php  echo number_format($co->mmonto, 2,',','.')." $"; ?></td>
				</tr><?php } ?>
				@endforeach	  
		  		<tr><td colspan="3" style="background-color: #E6E6E6"><strong> Ventas </strong></td></tr>
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
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><h5 align="center">Nota de Credito Aplicada</h5>
			<table id="desglose" width="100%">
				<thead style="background-color: #E6E6E6" >
				 <th>#</th> 
					<th>fecha</th> 
					<th>Referencia</th>
					<th>Monto</th>						 
				</thead>                     
				<tbody>                        
					@foreach($recibonc as $renc) <?php  $acumnc=$acumnc+$renc->monto;?>
					<tr >
					<td><?php if($renc->monto>0){?><a href="" data-target="#modal-delete-{{$renc->id_mov}}" data-toggle="modal" ><button class="btn btn-danger btn-xs" >X</button></a><?php } ?>{{$renc->id_mov}}	</td>
						<td><?php echo date("d-m-Y",strtotime($renc->fecha)); ?></td>
						<td>{{$renc->tipodoc}}{{$renc->iddoc}}-{{$renc->referencia}}</td> 
						<td><?php echo number_format( $renc->monto, 2,',','.'); ?></td>						  
					</tr>
							@include('reportes.ventas.cobranza.anularnc')
					@endforeach
				<tfoot >                    
					<th colspan="3">Total</th>
					<th><?php echo "$ ".number_format( $acumnc, 2,',','.');?></th>
					<th ><h4 id="total"><b></b></h4></th>
				</tfoot>
				</tbody>
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
  window.location="{{route('detalleingresos')}}";
    });
});

</script>
@endpush
@endsection
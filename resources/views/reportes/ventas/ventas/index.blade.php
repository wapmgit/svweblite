@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; ?>
<div class="row">
	@include('reportes.ventas.ventas.search')
</div>
<?php $acum=0;$efe=0;$deb=0;$che=0;$tra=0;
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
			@include('reportes.ventas.ventas.empresa')
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
					<table width="100%">
					<thead style="background-color: #E6E6E6">
					<th>Item </th>
					<th>Cliente </th>
					<th>Vendedor </th>
					<th>Comprobante</th>
					<th>Estatus</th>
					<th>Monto</th>
					<th>Fecha Fac.</th>
					<th>Usuario</th>
					</thead>
						<?php $ctra= 0; $cche=0; $cdeb=0; $credito=0; $contado=0; $count=0;?>
					@foreach ($datos as $q)
						<?php $count++; 
						if($q->estado=="Credito"){$credito=$credito + $q->total_venta;}else{$contado=$contado + $q->total_venta;} ?> 
							<tr <?php if($mostrar==0){?> style="display:none" <?php } ?> >
							  <td><?php echo $count; ?></td>
							   <td>{{ $q->nombre}}</td>
							   <td>{{ $q->vendedor}}</td>
							  <td>{{ $q->tipo_comprobante}}-{{ $q->num_comprobante}} <?php if ($q->devolu>0){ echo "- Devuelta";}?></td>       
							  <td>{{$q->estado}}</td> 
							  <td><?php $acum=$acum+ $q->total_venta; echo number_format($q->total_venta, 2,',','.')." $"; ?></td>
							  <td><?php echo date("d-m-Y h:i:s a",strtotime($q->fecha_hora)); ?></td>
							  <td>{{$q->user}}</td>
							</tr>    
					@endforeach
							<tr>
								<td colspan="5"> <strong>TOTAL:</strong></td>
								<td><strong><?php echo number_format($acum, 2,',','.')." $"; ?></strong></td>
								<td colspan="2"></td>
							</tr>
					</table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
					<table width="100%">
						<thead>      
						<tr><td colspan="3" align="center" style="background-color: #E6E6E6"><strong>DESGLOSE DE VENTAS<strong></td></tr>
						<th>Moneda</th>
						<th>Recibido</th>
						<th>Monto</th> 
						</thead>
						@foreach ($pagos as $q)
						<tr >
						<td>{{$q->idbanco}}</td>
						<td><?php echo number_format($q->recibido, 2,',','.'); ?></td>
						<td><?php echo number_format($q->monto, 2,',','.')." $"; ?></td>
						</tr>   
						@endforeach
					</table>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead" align="center" style="background-color: #E6E6E6">Resumen</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Ventas  Contado:</th>
                        <td><?php echo number_format($contado, 2,',','.')." $"; ?></td>
                      </tr>
                      <tr>
                        <th>Ventas Credito</th>
                        <td><?php echo number_format($credito, 2,',','.')." $"; ?></td>
                      </tr>
						<tr>
                        <th>Monto Devoluciones:</th>
						         @foreach ($devolucion as $dev)
								<?php $devolu=$dev->totaldev;
								$caja=($acum-$devolu); ?>
								@endforeach
                        <td><?php echo number_format($devolu, 2,',','.')." $"; ?></td>
						</tr>
                      <tr>
                        <th>Total Ventas:</th>
                        <td><?php echo number_format($caja, 2,',','.')." $"; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
				<label>Usuario: {{ Auth::user()->name }}</label>  
                </div>
              </div>
				<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>
                    </div>
                </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
            
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('resumenventas')}}";
    });

});

</script>

@endpush
@endsection
@extends ('layouts.master')
@section ('contenido')
<div class="row" >
		@include('reportes.ventas.utilidad.search')
</div>
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
			@include('reportes.ventas.utilidad.empresa')
              </div>
              <!-- /.row -->

              <!-- Table row -->
            <div class="row">
			   <div class="col-12 table-responsive">
				<table width="100%">
					<thead style="background-color: #E6E6E6" >			
					  <th>Documento</th>
					  <th>Costo</th>
					  <th>Precio venta</th>
					  <th>Cantidad</th>
					  <th>Costo Neto</th>
					  <th>Venta Neta</th>
					  <th>Utilidad</th>
					</thead>
						<?php $tcosto= 0; $tutil=0; $tvn=0; $tcn=0; $tcant=0; $tpv=0;?>
						@foreach ($datos as $q)            
						<tr> 
						  <td>{{ $q->tipo_comprobante.':'.$q->serie_comprobante.'-'.$q->num_comprobante}}</td>
						  <td><?php $tcosto=$tcosto+$q->costo; echo number_format($q->costo, 2,',','.'); ?></td>
						  <td><?php $tpv=$tpv+$q->precio_venta; echo number_format($q->precio_venta, 2,',','.'); ?></td>
						  <td>
							 <?php $tcant=$tcant+$q->cantidad; echo number_format($q->cantidad, 2,',','.'); ?></td>
						  <td>
							 <?php $tcn=$tcn+$q->costoneto; echo number_format($q->costoneto, 2,',','.'); ?></td>
						  <td>
							 <?php $tvn=$tvn+$q->ventaneta;  echo number_format($q->ventaneta, 2,',','.'); ?></td>
							<td> <?php  echo number_format(($q->ventaneta-$q->costoneto), 2,',','.'); ?></td>						
						</tr>  
						@endforeach 
						<tr style="background-color: #E6E6E6" >
							<td colspan=""> <strong>TOTAL:</strong></td>
						  <td><strong><?php echo number_format($tcosto, 2,',','.')." $"; ?></strong></td>
						  <td><strong><?php echo number_format($tpv, 2,',','.')." $"; ?></strong></td>
						  <td><strong><?php echo number_format($tcant, 2,',','.')." $"; ?></strong></td>
						  <td><strong><?php echo number_format($tcn, 2,',','.')." $"; ?></strong></td>
						  <td><strong><?php echo number_format($tvn, 2,',','.')." $"; ?></strong></td>
						  <td><strong><?php echo number_format(($tvn-$tcn), 2,',','.')." $"; ?></strong></td>
        
						</tr>
				</table>
		   	   </div>
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
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('utilidadventas')}}";
    });

});

</script>

@endpush
@endsection
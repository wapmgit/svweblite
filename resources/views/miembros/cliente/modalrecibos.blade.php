<div class="modal fade" id="modalrecibos-{{$cliente->id_cliente}}">

	<div class="modal-dialog modal-xl">
		<div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle Recibos </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">
				  	<table id="ing" class="table table-striped ">
				<thead>
						<th width="15%">Documento</th>
                          <th>Moneda</th>
						  <th>Recibido</th>
                          <th>Monto</th>
                          <th>Fecha</th>
				</thead>
				<tbody>
               @foreach ($pagos as $p) <?php $acummonto=$acummonto+$p->monto;?>
				<tr>
					<td >{{ $p->tipo_comprobante}} {{ $p->num_comprobante}} <?php if ($p->monto==0) echo $p->referencia." $"; ?></td>
					<td>{{ $p->idbanco}}</td>					
					<td><?php echo number_format($p->recibido, 2,',','.'); ?></td>
					<td><?php echo number_format($p->monto, 2,',','.'); ?></td>		
					<td><small><?php echo date("d-m-Y h:i:s a",strtotime($p->fecha)); ?></small></td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
						<th>Documento</th>
                          <th>Moneda</th>
						  <th>Recibido</th>
                          <th>Monto</th>
                          <th>Fecha</th>
						  </tfoot>
			</table>
			<label> <button type="button" class="btn bg-navy btn-flat margin"><?php echo "Total Monto: ".$acummonto." $";?></button></label>
			</div>
			<div class="modal-footer">
				<button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>


</div>
<?php $count2=0;?>
      <div class="modal fade" id="modalm">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Actualizar Tasas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">
			<table align="center">
				@foreach ($monedas as $cat1)	<?php $count2++;
				if($cat1->tipo>0){
				?>			
				<tr>
				<td><input id="vmn<?php echo $count2; ?>" type="hidden" value="{{$cat1->idmoneda}}" name="idmoneda" class ="form-control"></input></td>
				<td><input  type="text" readonly value="{{$cat1->nombre}}" name="nombre" class ="form-control"></input></td>
				<td><input type="number" id="valor<?php echo $count2; ?>" value="{{$cat1->valor}}" name="valor" class ="form-control"></input>
				</td>
				<td><a href="javascript:actmonedas('<?php echo $count2; ?>',{{$cat1->idmoneda}},{{$cat1->tipo}});"> <button type="submit" class="btn btn-outline-light">Actualizar</button><a></td></tr>
				<?php } ?>
					@endforeach
			</table>
			</div>
            <div class="modal-footer center-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
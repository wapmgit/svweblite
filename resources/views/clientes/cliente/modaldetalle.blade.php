<div class="modal modal-success" aria-hidden="true"
role="dialog" tabindex="-1" id="modaldetalle" >

	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			       <div class="modal-header">
              <h4 class="modal-title">Detalle de Pago Documento : <label id="det_documento"></label></h4>
              <button type="button" id="btn-close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">
		       <table id="detalleventa" class="table table-striped table-bordered table-condensed table-hover">
                      <thead style="background-color: #54b279">
                          <th>#Recibo</th>
                          <th>Tipo</th>
						  <th>Moneda</th>
                          <th>Monto</th>
                          <th>Recibido</th>
						  <th>Referencia</th>
                          <th>Fecha</th>			
                      </thead>
                   
                      <tbody id="bodytablev"></tbody>
					  <tfoot> <th colspan="8"> <div align="center"> Total Documento: <label id="det_total"></label> </div></th> </tfoot>
                  </table>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn-cerrar" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>


</div>

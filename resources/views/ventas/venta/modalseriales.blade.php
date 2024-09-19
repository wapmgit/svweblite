<div class="modal fade" id="modalseriales">
	<div class="modal-dialog modal-lg">
	<div class="modal-content bg-primary">
		<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Indicar Serial</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                 <?php $nseriales=0;?> 
			    </div>
	    	</div>
			<div class="modal-body">
			<table id="lseriales">
			 <?php $nseriales=count($seriales); $cnts=0;?> 
			</table>
			</div>
					<div class="modal-footer right-content-between">
					  <label id="seleccionados"> 0 </label>
				<button type="button" id="btncloseserial" class="btn btn-outline-light" data-dismiss="modal">Ok</button>

			</div>

		</div>
			
	</div>
</div>

   
<div class="modal modal-warning" aria-hidden="true"
role="dialog" tabindex="-1" id="modal_tasas">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-primary">
					<div class="modal-header ">
						 <h5 class="modal-title">Referencia Divisas</h5>
						 <button type="button" class="close" data-dismiss="modal" 
							aria-label="Close">
						 <span aria-hidden="true">×</span>
						  </button>
					 
					</div>
			</div>
	<div class="modal-body">
	<div class="row">
		<div class="col-lg-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
			  <h4  id="dvb" ></h4>
              <p>Dolares</p>
            </div>
          </div>
        </div>
			<div class="col-lg-4">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
			  <h4  id="dvd" ></h4>
              <p>Bolivares</p>	
			  <i>{{$empresa->tc}}</i>
            </div>	
          </div>
        </div>
		<div class="col-lg-4">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
			  <h4  id="dvp" ></h4>
              <p>Pesos</p>	
			  <i>{{$empresa->peso}}</i>
            </div>	
          </div>
        </div>
	</div> 
	</div>
	<div class="modal-footer">
			 <div class="form-group">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>				
				</div>
	</div>
	</div>
</div>	
</div>


  
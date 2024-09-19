
<div class="modal modal-danger" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-deletend-{{$ingnd->idrecibo}}">
<form action="{{route('anulareciboc')}}" method="POST" enctype="multipart/form-data" >
{{csrf_field()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Anular Recibo</h5>
				     <button type="button" class="close" data-dismiss="modal" 
			        	aria-label="Close">
                     <span aria-hidden="true">×</span>
                      </button>
                 
			    </div>
	    	</div>
			<div class="modal-body">
		<p>¿Confirme si desea Anular el Recibo por N/D # {{$ingnd->idrecibo}}?
		<input type="hidden" name="id"  value="{{$ingnd->idrecibo}}" >
			<input type="hidden" name="tiporecibo" value="2"></input>
	</p>
		</div>  <!-- del modal body-->
			<div class="modal-primary">
			    <div class="modal-footer">
                    <div class="form-group">
                    <button type="button" class="btn btn-default btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary btn-outline pull-right">Confirmar</button>
                    </div>
		    	</div>
			</div>
	</div>
			
    </form>   
</div>
</div>
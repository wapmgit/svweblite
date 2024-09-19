
<div class="modal modal-danger" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$ing->idrecibo}}">
<form action="{{route('anularecibo')}}" method="POST" enctype="multipart/form-data" >
{{csrf_field()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Anular Recibo por Nota de  Debito</h5>
				     <button type="button" class="close" data-dismiss="modal" 
			        	aria-label="Close">
                     <span aria-hidden="true">×</span>
                      </button>
                 
			    </div>
	    	</div>
			<div class="modal-body">
		<p>¿Confirme si desea Anular el Recibo # {{$ing->idrecibo}}?
		<input type="hidden" name="id"  value="{{$ing->idrecibo}}" >
		<input type="hidden" name="tipo"  value="1" >
		<input type="hidden" name="doc"  value="N/D" >
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
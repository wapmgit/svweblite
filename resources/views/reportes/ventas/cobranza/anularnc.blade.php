<div class="modal modal-danger" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$renc->id_mov}}">

<form action="{{route('anularecibo')}}" method="POST" enctype="multipart/form-data" >
{{csrf_field()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Anular Movimiento de Nota de Credito</h5>
				     <button type="button" class="close" data-dismiss="modal" 
			        	aria-label="Close">
                     <span aria-hidden="true">×</span>
                      </button>
                 
			    </div>
	    	</div>
			<div class="modal-body">
		<p>¿Confirme si desea Anular Movimiento # {{$renc->id_mov}}?
		<input type="hidden" name="id"  value="{{$renc->id_mov}}" >
		<input type="hidden" name="tipo"  value="2" >
		
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
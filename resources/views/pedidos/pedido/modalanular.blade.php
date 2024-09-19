<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$ven->idpedido}}">
<form action="{{route('anularpedido')}}" method="POST" enctype="multipart/form-data" >
{{csrf_field()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Anular Pedido </h5>
				     <button type="button" class="close" data-dismiss="modal" 
			        	aria-label="Close">
                     <span aria-hidden="true">×</span>
                      </button>
                 
			    </div>
	    	</div>
			<div class="modal-body">

	<p>¿Confirme si desea Anular Pedido?
	{{ $ven->tipo_comprobante.':'.$ven->serie_comprobante.'-'.$ven->num_comprobante}}
		<input type="hidden" name="id"  value="{{$ven->idpedido}}" >
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
<div class="modal fade" id="modaldevolu-{{$cob->iddetalle_pedido}}">

	<form action="{{route('devolucionpedido')}}" method="post" enctype="multipart/form-data" >         
			{{csrf_field()}}
	<div class="modal-dialog">
		<div class="modal-content">
						    <div class="modal-header ">
                     <h5 class="modal-title">Indique cantidad para restar a pedido</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                 
			    </div>
			<div class="modal-body">
			<div class="row">
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<label>Articulo</label></br>
			<label>{{$cob->articulo}}</label>
			</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            		 <div class="form-group">
            			<label for="nombre">Cantidad</label>
            			<input type="number" step="any" name="cantidad" min="1" max="{{$cob->cantidad}}" required value="{{$cob->cantidad}}" class="form-control">
					<input type="hidden" name="idventa"  value="{{$cob->idpedido}}" >
						<input type="hidden" name="idarticulo"  value="{{$cob->idarticulo}}" >
						<input type="hidden" name="vendedor"  value="{{$cob->vendedor}}" >
					<input type="hidden" name="iddetalle"  value="{{$cob->iddetalle_pedido}}" >
            		</div>
            	</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	</fomr>

</div>
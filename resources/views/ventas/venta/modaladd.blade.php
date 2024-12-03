<div class="modal modal-danger" aria-hidden="true"
role="dialog" tabindex="-1" id="modaladd">
<form action="{{route('addarticuloventa')}}" method="POST" enctype="multipart/form-data" >
{{csrf_field()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Agregar Articulo</h5>
				     <button type="button" class="close" data-dismiss="modal" 
			        	aria-label="Close">
                     <span aria-hidden="true">×</span>
                      </button>
                 
			    </div>
	    	</div>
			<div class="modal-body">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            		 <div class="form-group">
					  <label>Articulo -> Stock -> Precio</label>
	<select name="pidarticulo" class="form-control selectpicker" data-live-search="true">
            				@foreach ($listarticulos as $cat)
            				<option value="{{$cat->idarticulo}}">{{$cat->articulo}} -> {{$cat->stock}} -> {{$cat->precio_promedio}}</option>
            				@endforeach
            			</select>
						</div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            		 <div class="form-group">
					 <label>Cantidad </label> <small><small>*No debe ser mayor al stock*</small></small>
						<input type="number" class="form-control" min="1" step="0.01" name="cantidad"  value="1" >
						<input type="hidden" name="idventa"  value="{{$venta->idventa}}" >
</div>
</div>
		</div>  <!-- del modal body-->
			<div class="modal-primary">
			    <div class="modal-footer">
                    <div class="form-group">
                    <button type="button" class="btn btn-default btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btnadd" class="btn btn-primary btn-outline pull-right">Confirmar</button>
                    </div>
		    	</div>
			</div>
	</div>
			
    </form>   
</div>
</div>
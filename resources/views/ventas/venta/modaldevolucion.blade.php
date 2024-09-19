
<div class="modal fade" id="modaldevolucion" >
<form action="{{route('devoluparcial')}}" id="formulario" method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
	<div class="modal-dialog" >	
		<div class="modal-content bg-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Devolucion Parcial</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                 
			    </div>
			<div class="modal-body">
		
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<label id="art"></label>
				</div>
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            		 <div class="form-group">
            			<label for="nombre">Nueva Cantidad</label>
            			<input type="number" step="any" name="cantidad" id="idcantidad" min="1"  required value="" class="form-control">
					<input type="hidden" name="idventa"  value="{{$venta->idventa}}" >
					<input type="hidden" name="tasa"  value="{{$venta->tasa}}" >
						<input type="hidden" name="idarticulo"  id="idarticulo" value >
					<input type="hidden" name="iddetalle" id="iddetalle"  value="" >
					<input type="hidden" name="plink"  value="1" >
            		</div>
            	</div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            		 <div class="form-group">
            			<label for="nombre">Nuevo Precio</label>
            			<input type="number" step="any" name="precio" id="idprecio" min="1" required value="" class="form-control">

            		</div>
            	</div>
			</div>
	
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit"  class="btn btn-primary">Confirmar</button>
			</div>
		</div>
			

	</div>
	</form>

</div>


  @push ('scripts')
<script> 

 $('#senddevolu').on("click",function(){ 

 document.getElementById('formulario').submit(); })

	</script>
@endpush
	
   
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-{{$venta->idpedido}}">
<form action="{{route('facpedido')}}" id="forimportar" method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header ">
                     <h5 class="modal-title">Importar documento a Factura</h5>
				     <button type="button" class="close" data-dismiss="modal" 
			        	aria-label="Close">
                     <span aria-hidden="true">×</span>
                      </button>
                 
			</div>
			<div class="modal-body">
			<div class="row">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<p>Confirma Convertir en factura el  Pedido {{$venta->idpedido}}?</p>
				</div>
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			           <div class="form-group">
					   <label for="serie_comprobante">Fecha Emision</label>
					<input type="date" name="fecha_emi"  id="fecha_emi" value="<?php echo $fserver; ?>" class="form-control">
					</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
<div class="form-group">
						<label for="serie_comprobante"># Control</label>
						<input type="text" style="background-color:#edefef" name="control" value="00-" size="12" class="form-control" > 
					</div>	
					</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            		 <div class="form-group">
            	
						<input type="hidden" name="idventa"  value="{{$venta->idpedido}}" >
						<input type="hidden" name="serie_comprobante"  value="A" >
                        @foreach($detalles as $cat1)
						<?php if($cat1->cantidad > 0 ){ ?>
                <input type="hidden" value="{{$cat1->idarticulo}}" name="idarticulo[]" class ="form-control"></input>
				<input type="hidden" value="{{$cat1->cantidad}}" name="cantidad[]" class ="form-control"></input>
                <input type="hidden" value="{{$cat1->costo}}" name="costo[]" class ="form-control"></input>
                <input type="hidden" value="{{$cat1->precio_venta}}" name="precio[]" class ="form-control"></input>
                <input type="hidden" value="{{$cat1->descuento}}" name="descuento[]" class ="form-control"></input>
						<?php } ?>
                        @endforeach
            		</div>
            	</div>
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			           <div class="form-group">
							<input type="hidden" value="<?php echo $acumexe; ?>" name="texe" >
						  <input type="hidden" value="<?php echo $acumiva; ?>" name="total_iva" >
						  <input type="hidden" value="<?php echo $acumbase; ?>" name="total_base" >
						  <input type="hidden" value=" {{$empresa->tc}}" name="tasa">
           </div>
		   </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
</form>

</div>

<div class="modal fade" id="modalaggart" >
<form action="{{route('addarticulo')}}" id="formularioadd" method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
	<div class="modal-dialog" >	
		<div class="modal-content bg-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Agregar Articulo a Pedido <?php $idv=$venta->num_comprobante; echo add_ceros($idv,$ceros); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                 
			    </div>
			<div class="modal-body">	
				<div class="row">	
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<table align="center" width="100%">
			<tr><td colspan="2">     <label>Articulo</label>
			<select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true" >
                              <option value="1000" selected="selected">Seleccione..</option>
                             @foreach ($articulos as $articulo)
                              <option value="{{$articulo -> idarticulo}}_{{$articulo -> stock}}_{{$articulo -> precio_promedio}}_{{$articulo -> precio2}}_{{$articulo -> costo}}">{{$articulo -> articulo}}</option>
                             @endforeach
                              </select></td></tr>
			<tr><td><label>Cantidad:</label>
			<input type="number" name="pcantidad" id="pcantidad" class ="form-control" placeholder="Cantidad"></td>
			<td><label>Precio:</label> <input type="number" name="pprecio_venta" id="pprecio_venta" step="0.001" class ="form-control" placeholder="Precio de Venta" ></td></tr>
			</table>
					</div>
   
			   </div>
			
				</div> 			
				<div class="modal-footer justify-content-between">
				<input type="hidden" value="0" name="pf" id="pf" class ="form-control" step="0.001" class ="form-control">
				<input type="hidden" value="0" name="pcostoarticulo" id="pcostoarticulo" step="0.001" class ="form-control" >
				<input type="hidden" value="0" name="idarticulo" id="idarticulo" class ="form-control" >
				<input type="hidden" value="{{$venta->idpedido}}" name="idpedido"  class ="form-control" >
				<button type="button"  class="btn btn-outline-light" id="btncerrar"  data-dismiss="modal">Cerrar</button>
				  <input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
				<button  style="display:none" type="submit" id="btnsubmit"  class="btn btn-outline-light" >Confirmar</button>
			</div>
			</div>

		</div>
			

	</form>

	</div>
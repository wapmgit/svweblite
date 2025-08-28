
<div class="modal fade" id="roles{{$q->id}}">
	<form action="{{route('updateuser')}}" method="post" enctype="multipart/form-data" >         
			{{csrf_field()}}
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Actualizar Privilegios de Usuario </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="modal-body">
				<p align="center">Usuario: <label>{{ $q->name}} </label> @if($q->nivel=="L") *Usuario Limitado para Ventas* @endif 
				</p>
				  <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab{{$q->id}}" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab{{$q->id}}" data-toggle="pill" href="#custom-tabs-one-home{{$q->id}}" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Archivo</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab{{$q->id}}" data-toggle="pill" href="#custom-tabs-one-profile{{$q->id}}" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Ingresos y Egresos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab{{$q->id}}" data-toggle="pill" href="#custom-tabs-one-messages{{$q->id}}" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Informes</a>
                  </li>
					<li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-sistema-tab{{$q->id}}" data-toggle="pill" href="#custom-tabs-one-sistema{{$q->id}}" role="tab" aria-controls="custom-tabs-one-sistema" aria-selected="false">Sistema</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home{{$q->id}}" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab{{$q->id}}">
					<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						 <div class="form-group">
						 <input type="hidden" value="{{$q->idrol}}" name="rol"></input>
						 <label>Crear Cliente: </label><label>
						  <input type="checkbox" name="op1" class="minimal" @if($q->newcliente==1) checked @endif ></label>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Editar Cliente: </label><label>
					  <input type="checkbox" name="op2" class="minimal" @if($q->editcliente==1) checked @endif ></label>
					</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Edo. Cta. Cliente: </label><label>
					  <input type="checkbox" name="op59" class="minimal" @if($q->edoctacliente==1) checked @endif ></label>
					</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Crear Proveedor:</label><label>
					  <input type="checkbox" name="op3" class="minimal" @if($q->newproveedor==1) checked @endif ></label>

					</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Editar Proveedor: </label><label>
					  <input type="checkbox" name="op4" class="minimal" @if($q->editproveedor==1) checked @endif ></label>
					</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Edo. Cta. Proveedor: </label><label>
					  <input type="checkbox" name="op60" class="minimal" @if($q->edoctaproveedor==1) checked @endif ></label>
					</div>
					</div>				
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Crear Vendedor: </label><label>
					  <input type="checkbox" name="op5" class="minimal" @if($q->newvendedor==1) checked @endif ></label>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Editar Vendedor: </label><label>
					  <input type="checkbox" name="op6" class="minimal"@if($q->editvendedor==1) checked @endif ></label>

					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Crear Articulo: </label><label>
					  <input type="checkbox" name="op7" class="minimal" @if($q->newarticulo==1) checked @endif ></label>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Editar Articulo: </label><label>
					  <input type="checkbox" name="op8" class="minimal" @if($q->editarticulo==1) checked @endif ></label>
					</div>
				</div>

                  </div>
				  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile{{$q->id}}" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab{{$q->id}}">
                   <div  class="row">
				   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Crear Compras: </label><label>
					  <input type="checkbox" name="op9" class="minimal" @if($q->crearcompra==1) checked @endif ></label>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Anular Compras: </label><label>
					  <input type="checkbox" name="op10" class="minimal" @if($q->anularcompra==1) checked @endif ></label>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Crear Venta: </label><label>
					  <input type="checkbox" name="op11" class="minimal" @if($q->crearventa==1) checked @endif ></label>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Anular Venta: </label><label>
					  <input type="checkbox" name="op12" class="minimal" @if($q->anularventa==1) checked @endif ></label>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Crear Gasto: </label><label>
					  <input type="checkbox" name="op13" class="minimal" @if($q->creargasto==1) checked @endif ></label>

					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Anular Gasto: </label><label>
					  <input type="checkbox" name="op14" class="minimal"@if($q->anulargasto==1) checked @endif ></label>
					</div>
				</div> 
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Abonar Compras: </label><label>
					  <input type="checkbox" name="op15" class="minimal" @if($q->abonarcxp==1) checked @endif ></label>			
					</div>
				</div>		
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Crear Ajuste: </label><label>
					  <input type="checkbox" name="op17" class="minimal" @if($q->crearajuste==1) checked @endif ></label>			
					</div>
				</div>		
				<!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Abonar Gastos: </label><label>
					  <input type="checkbox" name="op21" class="minimal" @if($q->abonargasto==1) checked @endif ></label>			
					</div>
				</div>		-->			
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Abonar Ventas: </label><label>
					  <input type="checkbox" name="op16" class="minimal" @if($q->abonarcxc==1) checked @endif ></label>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Ajustar Venta: </label><label>
						<input type="checkbox" name="op61" class="minimal" @if($q->ajustarventa==1) checked @endif ></label>
						</div>
						</div>
				<!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Crear Pedidos: </label><label>
					  <input type="checkbox" name="op20" class="minimal" @if($q->crearpedido==1) checked @endif ></label>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Anular Pedido: </label><label>
					  <input type="checkbox" name="op29" class="minimal" @if($q->anularpedido==1) checked @endif ></label>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Importar Pedido: </label><label>
					  <input type="checkbox" name="op30" class="minimal" @if($q->importarpedido==1) checked @endif ></label>
					</div>
				</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					 <div class="form-group">
					 <label>Modificar Pedido: </label><label>
					  <input type="checkbox" name="op31" class="minimal" @if($q->editpedido==1) checked @endif ></label>
					</div>
				</div> -->
				   </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-messages{{$q->id}}" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab{{$q->id}}">
						<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Resumen de Ventas: </label><label>
						<input type="checkbox" name="op23" class="minimal" @if($q->rventas==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Corte de Caja: </label><label>
						<input type="checkbox" name="op32" class="minimal" @if($q->ccaja==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Detalle de Ingresos: </label><label>
						<input type="checkbox" name="op24" class="minimal" @if($q->rdetallei==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Cuentas por Cobrar: </label><label>
						<input type="checkbox" name="op25" class="minimal" @if($q->rcxc==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Resumen de Compras: </label><label>
						<input type="checkbox" name="op26" class="minimal" @if($q->rcompras==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Detalle de Pagos: </label><label>
						<input type="checkbox" name="op27" class="minimal" @if($q->rdetallec==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Cuentas por Pagar: </label><label>
						<input type="checkbox" name="op28" class="minimal" @if($q->rcxp==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Reporte de Articulos: </label><label>
						<input type="checkbox" name="op36" class="minimal" @if($q->rarti==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Lista de Precios: </label><label>
						<input type="checkbox" name="op37" class="minimal" @if($q->rlistap==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Resumen Gerencial: </label><label>
						<input type="checkbox" name="op38" class="minimal" @if($q->rgerencial==1) checked @endif ></label>
						</div>
						</div>
						<!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Analisis Cientes: </label><label>
						<input type="checkbox" name="op39" class="minimal" @if($q->ranalisisc==1) checked @endif ></label>
						</div>
						</div>-->
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Utilidad en Ventas: </label><label>
						<input type="checkbox" name="op42" class="minimal" @if($q->rutilventa==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Ventas de un Articulo: </label><label>
						<input type="checkbox" name="op43" class="minimal" @if($q->rventasarti==1) checked @endif ></label>
						</div>
						</div>
						<!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Resumen Gastos: </label><label>
						<input type="checkbox" name="op44" class="minimal" @if($q->rgastos==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Retenciones: </label><label>
						<input type="checkbox" name="op45" class="minimal" @if($q->retenciones==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Anular Retencion: </label><label>
						<input type="checkbox" name="op47" class="minimal" @if($q->anularret==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Editar Correlativo Retencion: </label><label>
						<input type="checkbox" name="op48" class="minimal" @if($q->editret==1) checked @endif ></label>
						</div>
						</div>		-->				
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Compras de un Articulo: </label><label>
						<input type="checkbox" name="op46" class="minimal" @if($q->rcompraarti==1) checked @endif ></label>
						</div>
						</div>
						</div>
                  </div>
				<div class="tab-pane fade" id="custom-tabs-one-sistema{{$q->id}}" role="tabpanel" aria-labelledby="custom-tabs-one-sistema-tab{{$q->id}}">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Actualizar tasa: </label><label>
						<input type="checkbox" name="op19" class="minimal" @if($q->acttasa==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Actualizar Roles: </label><label>
						<input type="checkbox" name="op22" class="minimal" @if($q->actroles==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Actualizar Contraseñas: </label><label>
						<input type="checkbox" name="op33" class="minimal" @if($q->updatepass==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Crear Moneda: </label><label>
						<input type="checkbox" name="op40" class="minimal" @if($q->newmoneda==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Actualizar Moneda: </label><label>
						<input type="checkbox" name="op41" class="minimal" @if($q->editmoneda==1) checked @endif ></label>
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
						<label>Nivel de Usuario: </label><label>
						<select name="nivel" class="form-control">          			
            				<option value="L" @if($q->nivel=="L") selected @endif >Limitado</option>           			
            				<option value="A" @if($q->nivel=="A") selected @endif >Administracion</option>           			
            			</select>
						</div>
						</div>
					</div>
				</div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
				

			</div>
			<div class="modal-footer" >
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
</form>

</div>

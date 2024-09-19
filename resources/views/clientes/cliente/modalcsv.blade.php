     <div class="modal fade"  id="modalload">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Importar Clientes desde archivo CSV </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<form action="{{route('loadclientescsv')}}" method="post" enctype="multipart/form-data" >         
			{{csrf_field()}}
            <div class="modal-body">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						 <div class="form-group">
							<label for="nombre">Importar Archivo</label>
						<input type="file"  class="form-control"  name="sel_file" >
						</div>
						<p> formato CSV(ms-dos): Nombre;Cedula;rif;telefono;direccion;diascredito,vendedor, no incluir cabecera para las columnas</p>
					</div> 
				
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-dark" data-dismiss="modal" id="cancelarcsv">Cerrar</button>
              <button type="submit" class="btn btn-outline-dark" id="Nenviarcsv">Confirmar </button>
			  <div style="display: none" id="loadingcsv">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
            </div>
          </div>
		  </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      
  
